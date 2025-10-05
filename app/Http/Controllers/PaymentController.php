<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ExamForm,Submission};
use Illuminate\Support\Str;
use Razorpay\Api\Api as RazorpayApi; 
use Dompdf\Dompdf;

class PaymentController extends Controller 
{ 

    public function success($submissionId)
    {
        $submission = Submission::with('examForm','user','payments')->findOrFail($submissionId);

        return view('payments.success', compact('submission'));
    }

    public function error()
    {
        return view('payments.error');
    }

    public function createIntent(Request $req)
    { 
        $req->validate([
            'submission_id'=>'required|exists:submissions,id',
            'gateway'=>'required|in:razorpay'
        ]); 

        $submission = Submission::findOrFail($req->submission_id); 
        $amount = (int)round($submission->amount_due * 100); 
        
        $api = new RazorpayApi('rzp_test_KqcqwizctIhzgD', 'CVTB7tAxeiZX1fEc3GRK6F5Q'); 

        $order = $api->order->create([ 'amount'=>$amount, 'currency'=>$submission->currency, 'receipt'=>$submission->reference_id, 'notes'=>['submission_id'=>$submission->id] ]); 

        return response()->json([ 'order'=>$order, 'key'=>'CVTB7tAxeiZX1fEc3GRK6F5Q' ]); 
    
    } 

    public function razorpay(Request $request)
    { 
        $payload = $request->getContent(); 
        $signature = $request->header('X-Razorpay-Signature'); 
        $secret = config('services.razorpay.webhook_secret') ?? config('services.razorpay.secret'); 
        
        try { 
            RazorpayUtils::verifyWebhookSignature($payload, $signature, $secret); 
        } catch(\Exception $e){ 
            return response('Invalid signature',400); 
        } 
        
        $data = json_decode($payload, true); 
        
        if(($data['event'] ?? '') === 'payment.captured' || ($data['event'] ?? '') === 'payment.failed')
        { 
            $payloadObj = $data['payload']['payment']['entity'] ?? null; 
            if($payloadObj)
            { 
                $notes = $payloadObj['notes'] ?? []; 
                $submissionId = $notes['submission_id'] ?? null; 
                if(!$submissionId)
                { 
                    $submissionId = null; 
                } 
                
                if($data['event'] === 'payment.captured' && $submissionId)
                { 
                    $this->markPaymentSucceeded($submissionId,'razorpay',$payloadObj['id'],$payloadObj); 
                     return redirect()->route('payments.success', $submissionId);
                }else{
                    return redirect()->route('payments.error'); 
                } 
            } 
        } 
        return redirect()->route('payments.error');
    } 
    
    protected function markPaymentSucceeded($submissionId, $gateway, $gatewayPaymentId, $raw)
    { 
        DB::transaction(function() use($submissionId,$gateway,$gatewayPaymentId,$raw)
        { 
        
            $submission = Submission::find($submissionId); 
            
            if(!$submission) return; 
            
            $exists = Payment::where('gateway',$gateway)->where('gateway_payment_id',$gatewayPaymentId)->exists();
            if($exists) return;

             $payment = Payment::create(
                [ 
                    'submission_id'=>$submission->id, 
                    'user_id'=>$submission->user_id, 
                    'gateway'=>$gateway, 
                    'gateway_payment_id'=>$gatewayPaymentId, 
                    'amount'=>$submission->amount_due, 
                    'currency'=>$submission->currency, 
                    'status'=>'succeeded', 
                    'raw_response'=>json_decode(json_encode($raw), true), 
                    'captured_at'=>now() 
                ]); 
             
             $submission->update(['status'=>'paid']); 

             $submission = Submission::with('examForm','user','payments')->find($submissionId); 

             if(!$submission) return;

             $html = view('receipts.receipt', compact('submission'))->render(); 
             $dompdf = new Dompdf(); 
             $dompdf->loadHtml($html); 
             $dompdf->setPaper('A4','portrait'); 
             $dompdf->render(); 
             $output = $dompdf->output(); 
             $path = 'receipts/receipt_'.$submission->id.'.pdf'; 
             Storage::put($path, $output); 
             $submission->update(['pdf_path'=>$path]); 
             return 'storage/app/public/'.$path; 
        }); 
    }
}