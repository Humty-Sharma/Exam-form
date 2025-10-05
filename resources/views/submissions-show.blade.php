@extends('layouts.app')

@section('content')
<link href="{{ asset('css/detail.css') }}" rel="stylesheet">
    <div class="blog-single gray-bg">
        <div class="container"> 
            <h3>Submission #{{ $submission->id }} — Amount: {{ $submission->amount_due }} {{ $submission->currency }}</h3> 
        @if($submission->status === 'paid') 
            <div class="alert alert-success">Already paid. 
                <a href="{{ Storage::url($submission->pdf_path) }}">Download receipt</a>
            </div> 
        @else 
            <button id="payBtn" class="btn btn-success">Pay with {{ ucfirst($submission->payment_method) }}</button> @endif 
        </div> 

        <script>
        // Make sure the DOM is ready before adding event listener
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('payBtn').addEventListener('click', async function () {
                const gateway = "{{ $submission->payment_method }}"; 
                const submissionId = "{{ $submission->id }}";  

                const res = await fetch("{{ route('payments.createIntent',$submission->id) }}", { 
                    method: 'POST', 
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }, 
                    body: JSON.stringify({ submission_id: submissionId, gateway }) 
                });

                const json = await res.json();

                const options = { 
                    key: json.key, 
                    amount: json.order.amount,  
                    order_id: json.order.id, 
                    handler: function (resp) {
                        alert("Payment success; we'll verify on server.");
                    }, 
                    prefill: {
                        name: "{{ auth()->user()->name ?? '' }}", 
                        email: "{{ auth()->user()->email ?? '' }}"
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            });
        });
    </script>

        
</div>
@endsection