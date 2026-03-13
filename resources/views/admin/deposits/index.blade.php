@extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

<h3 class="mb-3">Deposits</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


{{-- ADD DEPOSIT --}}

<form method="POST" action="{{ route('admin.deposits.store') }}">
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
<input type="number" name="amount" class="form-control" placeholder="Amount" required>
</div>

<div class="col-6 col-md-2">
<input type="date" name="deposit_date" class="form-control" required>
</div>

<div class="col-6 col-md-2">
<input type="text" name="month" class="form-control" placeholder="Month">
</div>

<div class="col-6 col-md-1">
<input type="number" name="year" class="form-control" placeholder="Year">
</div>

<div class="col-12 col-md-2">
<button class="btn btn-primary w-100">
Add Deposit
</button>
</div>

</div>

<div class="row mb-3">
<div class="col-12">
<textarea name="note" class="form-control" placeholder="Note"></textarea>
</div>
</div>

</form>


{{-- DEPOSIT LIST --}}

<div class="table-responsive">

<table class="table table-bordered align-middle">

<thead class="table-light">

<tr>
<th>#</th>
<th>User</th>
<th>Amount</th>
<th>Date</th>
<th>Month</th>
<th>Year</th>
<th width="260">Actions</th>
</tr>

</thead>

<tbody>

@foreach($deposits as $deposit)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $deposit->user->name ?? '' }}</td>

<td>₹{{ $deposit->amount }}</td>

<td>{{ $deposit->deposit_date?->format('d M Y') }}</td>

<td>{{ $deposit->month }}</td>

<td>{{ $deposit->year }}</td>

<td>

{{-- UPDATE --}}

<form method="POST"
action="{{ route('admin.deposits.update',$deposit->id) }}"
class="mb-2">

@csrf
@method('PUT')

<div class="row g-1">

<div class="col-12">
<select name="user_id" class="form-control form-control-sm">

@foreach($users as $user)
<option value="{{ $user->id }}"
{{ $deposit->user_id == $user->id ? 'selected' : '' }}>
{{ $user->name }}
</option>
@endforeach

</select>
</div>

<div class="col-12">
<input type="number"
name="amount"
value="{{ $deposit->amount }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="date"
name="deposit_date"
value="{{ $deposit->deposit_date?->format('Y-m-d') }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="text"
name="month"
value="{{ $deposit->month }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="number"
name="year"
value="{{ $deposit->year }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<textarea name="note"
class="form-control form-control-sm">{{ $deposit->note }}</textarea>
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
action="{{ route('admin.deposits.destroy',$deposit->id) }}">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger w-100"
onclick="return confirm('Delete deposit?')">
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