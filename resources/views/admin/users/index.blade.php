@extends('admin.layouts.admin')

@section('content')

<div class="container-fluid">

<h3 class="mb-3">Users</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


{{-- ADD USER --}}

<form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
@csrf

<div class="row g-2 mb-3">

<div class="col-12 col-md-3">
<input type="text" name="name" class="form-control" placeholder="Name" required>
</div>

<div class="col-12 col-md-3">
<input type="email" name="email" class="form-control" placeholder="Email" required>
</div>

<div class="col-12 col-md-3">
<input type="password" name="password" class="form-control" placeholder="Password" required>
</div>

<div class="col-12 col-md-3">
<input type="text" name="mobile" class="form-control" placeholder="Mobile">
</div>

</div>


<div class="row g-2 mb-3">

<div class="col-12 col-md-4">
<input type="text" name="address" class="form-control" placeholder="Address">
</div>

<div class="col-6 col-md-2">
<input type="date" name="joining_date" class="form-control">
</div>

<div class="col-6 col-md-2">
<input type="file" name="profile_img" class="form-control">
</div>

<div class="col-6 col-md-2">
<input type="number" name="monthly_deposit" class="form-control" placeholder="Monthly Deposit">
</div>

<div class="col-6 col-md-2">
<button class="btn btn-primary w-100">
Add User
</button>
</div>

</div>

</form>


{{-- USER LIST --}}

<div class="table-responsive">

<table class="table table-bordered align-middle">

<thead class="table-light">
<tr>
<th>#</th>
<th>User</th>
<th>Mobile</th>
<th>Deposit</th>
<th width="250">Actions</th>
</tr>
</thead>

<tbody>

@foreach($users as $user)

<tr>

<td>{{ $loop->iteration }}</td>

<td>
<div class="d-flex align-items-center gap-2">

@if($user->profile_img)
<img src="{{ asset('images/'.$user->profile_img) }}"
width="45"
height="45"
style="object-fit:cover;border-radius:50%;">
@endif

<div>
<strong>{{ $user->name }}</strong><br>
<small>{{ $user->email }}</small>
</div>

</div>
</td>

<td>{{ $user->mobile }}</td>

<td>{{ $user->monthly_deposit }}</td>

<td>

{{-- UPDATE --}}

<form method="POST"
action="{{ route('admin.users.update',$user->id) }}"
enctype="multipart/form-data"
class="mb-2">

@csrf
@method('PUT')

<div class="row g-1">

<div class="col-12">
<input type="text" name="name" value="{{ $user->name }}" class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="email" name="email" value="{{ $user->email }}" class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="file" name="profile_img" class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="text" name="address" value="{{ $user->address }}" class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="date" name="joining_date"
value="{{ $user->joining_date?->format('Y-m-d') }}"
class="form-control form-control-sm">
</div>

<div class="col-12">
<input type="number" name="monthly_deposit"
value="{{ $user->monthly_deposit }}"
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
action="{{ route('admin.users.destroy',$user->id) }}">

@csrf
@method('DELETE')

<button class="btn btn-sm btn-danger w-100"
onclick="return confirm('Delete user?')">
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