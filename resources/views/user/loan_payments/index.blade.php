@extends('user.layouts.user')

@section('content')

<div class="container">

<h3 class="mb-4">Loan Payments</h3>

<div class="row">

@forelse($payments as $payment)

<div class="col-md-4 col-sm-6 mb-4">

<div class="card shadow-sm h-100">

<div class="card-body">

<h5 class="card-title text-primary">
₹{{ number_format($payment->total_paid) }}
</h5>

<p class="mb-1">
<strong>Installment:</strong>
₹{{ number_format($payment->installment) }}
</p>

<p class="mb-1">
<strong>Interest:</strong>
₹{{ number_format($payment->interest) }}
</p>

<p class="mb-1">
<strong>Loan Amount:</strong>
₹{{ number_format($payment->loan->loan_amount ?? 0) }}
</p>

<p class="mb-1">
<strong>Date:</strong>
{{ $payment->date?->format('d M Y') }}
</p>

</div>

<div class="card-footer bg-white">

<span class="badge bg-success">
Payment Recorded
</span>

</div>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-info">
No loan payments found.
</div>

</div>

@endforelse

</div>

</div>

@endsection