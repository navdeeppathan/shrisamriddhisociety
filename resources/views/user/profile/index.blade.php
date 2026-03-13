@extends('user.layouts.user')

@section('content')

<div class="container">

<h3 class="mb-4">My Profile</h3>

<div class="card shadow-sm">

<div class="card-body">

<div class="row">

<div class="col-md-3 text-center">

@if($user->profile_img)

<img src="{{ asset('images/'.$user->profile_img) }}"
width="120"
height="120"
style="border-radius:50%;object-fit:cover">

@else

<img src="https://via.placeholder.com/120"
class="rounded-circle">

@endif

</div>

<div class="col-md-9">

<table class="table">

<tr>
<th>Name</th>
<td>{{ $user->name }}</td>
</tr>

<tr>
<th>Email</th>
<td>{{ $user->email }}</td>
</tr>

<tr>
<th>Mobile</th>
<td>{{ $user->mobile }}</td>
</tr>

<tr>
<th>Address</th>
<td>{{ $user->address }}</td>
</tr>

<tr>
<th>Joining Date</th>
<td>{{ $user->joining_date?->format('d M Y') }}</td>
</tr>

<tr>
<th>Monthly Deposit</th>
<td>₹{{ $user->monthly_deposit }}</td>
</tr>

</table>

</div>

</div>

</div>

</div>

</div>

@endsection