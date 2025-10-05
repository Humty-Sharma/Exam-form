@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="text-danger">❌ Payment Failed</h2>
    <p>Sorry, your payment could not be completed. Please try again.</p>

    <a href="{{ route('index') }}" class="btn btn-primary">Back</a>
</div>
@endsection
