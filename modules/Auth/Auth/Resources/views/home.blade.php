@extends('layouts.backend-master')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
	
		@if($userRepo->isEmailVerified($user['id']))
			<label class="label label-warning"><a href="{{url('auth/sendverification')}}">Email is not verified</a></label>
		@endif
		<h2>Wel Come {{$user['name']}}</h2>
		<h3>This is home view</h3>
		<p>This view is only for logined users</p>
		@if($userRepo->isEmailVerified($user['id']))
			<p>Email is not verified</p>
		@endif
	</div>
</div>
@stop