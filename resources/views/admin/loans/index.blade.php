@extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

<h3 class="mb-3">Loans</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


{{-- ADD LOAN --}}

<form method="POST" action="{{ route('admin.loans.store') }}">
@csrf

<div class="row g-2 mb-3">

<div class="col-12 col-md-3">
<select name="user_id" class="form-control" required>

<option value="">Select User</option>

@foreach($users as $user)
<option value="{{ $user->id }}">
{{ $user->name }}
</option>
@endforeach

</select>
</div>

<div class="col-6 col-md-2">
<input type="number"
name="loan_amount"
class="form-control"
placeholder="Loan Amount"
required>
</div>

<div class="col-6 col-md-2">
<input type="number"
step="0.01"
name="interest_rate"
class="form-control"
placeholder="Interest %"
required>
</div>

<div class="col-6 col-md-3">
<input type="date"
name="loan_date"
class="form-control"
required>
</div>

<div class="col-6 col-md-2">
<button class="btn btn-primary w-100">
Add Loan
</button>
</div>

</div>

</form>


{{-- LOAN LIST --}}

<div class="table-responsive">

<table class="table table-bordered align-middle">

<thead class="table-light">
<tr>
<th>#</th>
<th>User</th>
<th>Loan</th>
<th>Interest %</th>
<th>Remaining</th>
<th>Date</th>
<th width="260">Actions</th>
</tr>
</thead>

<tbody>

@foreach($loans as $loan)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $loan->user->name ?? '' }}</td>

<td>₹{{ $loan->loan_amount }}</td>

<td>{{ $loan->interest_rate }}%</td>

<td>₹{{ $loan->remaining_amount }}</td>

<td>{{ $loan->loan_date?->format('d M Y') }}</td>

<td>

{{-- UPDATE --}}

<form method="POST"
action="{{ route('admin.loans.update',$loan->id) }}"
class="mb-2">

@csrf
@method('PUT')

<div class="row g-1">

<div class="col-12">
<select name="user_id" class="form-control form-control-sm">

@foreach($users as $user)

<option value="{{ $user->id }}"
{{ $loan->user_id == $user->id ? 'selected' : '' }}>
{{ $user->name }}
</option>

@endforeach

</select>
</div>

<div class="col-12">
<input type="number"
name="loan_amount"
value="{{ $loan->loan_amount }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="number"
step="0.01"
name="interest_rate"
value="{{ $loan->interest_rate }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="number"
name="remaining_amount"
value="{{ $loan->remaining_amount }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="date"
name="loan_date"
value="{{ $loan->loan_date?->format('Y-m-d') }}"
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
action="{{ route('admin.loans.destroy',$loan->id) }}">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger w-100"
onclick="return confirm('Delete loan?')">
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