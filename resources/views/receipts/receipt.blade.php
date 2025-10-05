<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
            color: #333;
        }
        .receipt-container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            max-width: 700px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details, .payment {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details td, .payment td, .payment th {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .details td:first-child, .payment th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <h2>Exam Payment Receipt</h2>
            <p><strong>{{ config('app.name') }}</strong></p>
        </div>

        <!-- Student / Submission Details -->
        <table class="details">
            <tr>
                <td>Student Name</td>
                <td>{{ $submission->user->name ?? 'Guest User' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $submission->user->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>Exam Form</td>
                <td>{{ $submission->examForm->title }}</td>
            </tr>
            <tr>
                <td>Reference ID</td>
                <td>{{ $submission->reference_id }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ ucfirst($submission->status) }}</td>
            </tr>
        </table>

        <!-- Payment Info -->
        <table class="payment">
            <thead>
                <tr>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>Payment ID</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @if($submission->payment)
                <tr>
                    <td>{{ ucfirst($submission->payment->gateway) }}</td>
                    <td>{{ number_format($submission->payment->amount, 2) }}</td>
                    <td>{{ strtoupper($submission->payment->currency) }}</td>
                    <td>{{ $submission->payment->gateway_payment_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($submission->payment->captured_at)->format('d M Y, h:i A') }}</td>
                </tr>
                @else
                <tr>
                    <td colspan="5" style="text-align:center;">No payment record found.</td>
                </tr>
                @endif
            </tbody>
        </table>

        <div class="footer">
            <p>This is a system-generated receipt. No signature required.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
