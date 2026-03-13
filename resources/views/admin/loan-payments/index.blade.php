@extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

<h3 class="mb-3">Loan Payments</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


{{-- ADD PAYMENT --}}

<form method="POST" action="{{ route('admin.loan.payments.store') }}">
@csrf

<div class="row g-2 mb-3">

<div class="col-12 col-md-3">
<select name="loan_id" class="form-control" required>
<option value="">Select Loan</option>

@foreach($loans as $loan)

<option value="{{ $loan->id }}">
{{ $loan->user->name }} - ₹{{ $loan->loan_amount }}
</option>

@endforeach

</select>
</div>

<div class="col-6 col-md-2">
<input type="number"
name="installment"
class="form-control"
placeholder="Installment"
required>
</div>

<div class="col-6 col-md-2">
<input type="number"
name="interest"
class="form-control"
placeholder="Interest">
</div>

<div class="col-6 col-md-3">
<input type="date"
name="date"
class="form-control"
required>
</div>

<div class="col-6 col-md-2">
<button class="btn btn-primary w-100">
Add Payment
</button>
</div>

</div>

</form>


{{-- PAYMENT LIST --}}

<div class="table-responsive">

<table class="table table-bordered align-middle">

<thead class="table-light">

<tr>
<th>#</th>
<th>User</th>
<th>Loan</th>
<th>Installment</th>
<th>Interest</th>
<th>Total Paid</th>
<th>Date</th>
<th width="260">Actions</th>
</tr>

</thead>

<tbody>

@foreach($payments as $payment)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $payment->loan->user->name ?? '' }}</td>

<td>₹{{ $payment->loan->loan_amount }}</td>

<td>₹{{ $payment->installment }}</td>

<td>₹{{ $payment->interest }}</td>

<td><strong>₹{{ $payment->total_paid }}</strong></td>

<td>{{ $payment->date?->format('d M Y') }}</td>

<td>

{{-- UPDATE --}}

<form method="POST"
action="{{ route('admin.loan.payments.update',$payment->id) }}"
class="mb-2">

@csrf
@method('PUT')

<div class="row g-1">

<div class="col-12">
<select name="loan_id" class="form-control form-control-sm">

@foreach($loans as $loan)

<option value="{{ $loan->id }}"
{{ $payment->loan_id == $loan->id ? 'selected' : '' }}>
{{ $loan->user->name }} - ₹{{ $loan->loan_amount }}
</option>

@endforeach

</select>
</div>

<div class="col-12">
<input type="number"
name="installment"
value="{{ $payment->installment }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="number"
name="interest"
value="{{ $payment->interest }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="date"
name="date"
value="{{ $payment->date?->format('Y-m-d') }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<button class="btn btn-sm btn-warning w-100">
Update
</button>
</div>

</div>

</form>


{{-- DELETE --}}

<form method="POST"
action="{{ route('admin.loan.payments.destroy',$payment->id) }}">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger w-100"
onclick="return confirm('Delete payment?')">
Delete
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection