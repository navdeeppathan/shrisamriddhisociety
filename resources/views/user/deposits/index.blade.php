@extends('user.layouts.user')

@section('content')

<div class="container">

<h3 class="mb-4">My Deposits</h3>

<div class="row">

@forelse($deposits as $deposit)

<div class="col-md-4 col-sm-6 mb-4">

<div class="card shadow-sm h-100">

<div class="card-body">

<h5 class="card-title text-success">
₹{{ number_format($deposit->amount) }}
</h5>

<p class="mb-1">
<strong>Date:</strong>
{{ $deposit->deposit_date?->format('d M Y') }}
</p>

<p class="mb-1">
<strong>Month:</strong>
{{ $deposit->month }}
</p>

<p class="mb-1">
<strong>Year:</strong>
{{ $deposit->year }}
</p>

@if($deposit->note)

<p class="mb-1">
<strong>Note:</strong>
{{ $deposit->note }}
</p>

@endif

</div>

<div class="card-footer bg-white">

<span class="badge bg-primary">
Deposit Recorded
</span>

</div>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-info">
No deposits found.
</div>

</div>

@endforelse

</div>

</div>

@endsection