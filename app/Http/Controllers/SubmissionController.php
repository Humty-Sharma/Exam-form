<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ExamForm,Submission};
use Illuminate\Support\Str;

class SubmissionController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function create(ExamForm $examForm)
    { 
        return view('submissions.create', compact('examForm')); 
    }

    public function store(Request $request,ExamForm $examForm)
    { 
        $request->validate([ 
            'exam_form_id'=>'required|exists:exam_forms,id', 
            'gateway'=>'required|in:razorpay' 
        ]); 
        
        // $examForm = ExamForm::findOrFail($request->exam_form_id); 
        
        $data = $request->input('data', []); 
        
        foreach ($examForm->fields as $field){ 
            if($field->type === 'file' && $request->hasFile($field->field_key)){ 
                $path = $request->file($field->field_key)->store('uploads','public'); 
                $data[$field->field_key] = $path; 
            } 
        } 
        $submission = Submission::create([ 
            'user_id' => auth()->id(), 
            'exam_form_id' => $examForm->id, 
            'data' => $data, 
            'status' => 'pending_payment', 
            'amount_due' => $examForm->fees, 
            'currency' => 'INR', 
            'reference_id' => 'SUB-'.Str::upper(Str::random(8)), 
            'payment_method' => $request->gateway, 
        ]);

        return redirect()->route('submissions.show', $submission->id); 
    }

    public function show(Submission $submission){ 
        $submission->load('examForm'); 
        return view('submissions-show', compact('submission')); 
    }
}
