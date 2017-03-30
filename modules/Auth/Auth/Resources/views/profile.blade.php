@extends('layouts.backend-master')
@section('menu')
Profile
@stop
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
	
		@if($userRepo->isEmailVerified($user['id']))
			<label class="label label-warning"><a href="{{url('auth/sendverification')}}">Email is not verified</a></label>
		@endif
		<h2>{{$user['name']}}'s Profile</h2>
		<table class="table table-responsive">
			<tr><td>Name</td><td>{{$user['name']}}</td></tr>
			<tr><td>Email</td><td>{{$user['email']}}</td></tr>
			<tr><td>Account Create At</td><td>{{$user['created_at']}}</td></tr>
		</table>		
	</div>
</div>
@stop