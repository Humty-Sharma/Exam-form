
@extends('backend.layouts.master')

@section('title')
Submission Details - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Submission Details</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.exam_forms.index') }}">All Submission Details</a></li>
                    <li><span>Submission Details</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    Submission #{{ $submission->id }}
                </div>
                <div class="card-body">
                    <p><strong>Reference ID:</strong> {{ $submission->reference_id }}</p>
                    <p><strong>User:</strong> {{ optional($submission->user)->name }}</p>
                    <p><strong>Exam Form:</strong> {{ optional($submission->examForm)->title }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($submission->status) }}</p>
                    <p><strong>Amount Due:</strong> {{ $submission->currency }} {{ number_format($submission->amount_due,2) }}</p>
                    <p><strong>Created At:</strong> {{ $submission->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            <h5>Payments</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gateway</th>
                        <th>Payment ID</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Captured At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submission->payments as $payment)
                        <tr>
                            <td>{{ $payment->gateway }}</td>
                            <td>{{ $payment->gateway_payment_id }}</td>
                            <td>{{ ucfirst($payment->status) }}</td>
                            <td>{{ $payment->currency }} {{ number_format($payment->amount,2) }}</td>
                            <td>{{ $payment->captured_at }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No payments recorded</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection