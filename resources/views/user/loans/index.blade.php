@extends('user.layouts.user')

@section('content')

<div class="container">

<h3 class="mb-4">My Loans</h3>

<div class="row">

@forelse($loans as $loan)

<div class="col-md-4 col-sm-6 mb-4">

<div class="card shadow-sm h-100">

<div class="card-body">

<h5 class="card-title">
Loan Amount
</h5>

<h4 class="text-primary">
₹{{ number_format($loan->loan_amount) }}
</h4>

<hr>

<p class="mb-1">
<strong>Interest Rate:</strong>
{{ $loan->interest_rate }}%
</p>

<p class="mb-1">
<strong>Remaining:</strong>
₹{{ number_format($loan->remaining_amount) }}
</p>

<p class="mb-1">
<strong>Date:</strong>
{{ $loan->loan_date?->format('d M Y') }}
</p>

</div>

<div class="card-footer bg-white">

@if($loan->remaining_amount > 0)

<span class="badge bg-warning">
Active Loan
</span>

@else

<span class="badge bg-success">
Paid
</span>

@endif

</div>

</div>

</div>

@empty

<div class="col-12">
<div class="alert alert-info">
No loans found.
</div>
</div>

@endforelse

</div>

</div>

@endsection