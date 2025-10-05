@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="text-success">✅ Payment Successful</h2>
    <p>Thank you, your payment for <strong>{{ $submission->examForm->title }}</strong> has been received.</p>

    <h4>Receipt</h4>
    @if($submission->pdf_path)
        <a href="{{ asset('storage/app/public/'.$submission->pdf_path) }}" target="_blank" class="btn btn-primary">
            Download Receipt (PDF)
        </a>
    @else
        <p>No receipt available.</p>
    @endif

    <br><br>
    <a href="{{ route('index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
