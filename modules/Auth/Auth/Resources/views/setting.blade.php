@extends('auth::layouts.master')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		
		@if($userRepo->isEmailVerified($user['id']))
		<label class="label label-warning"><a href="{{url('auth/sendverification')}}">Email is not verified</a></label>
		@endif
		<h2>{{$user['name']}}'s Setting</h2>
		<form class="form-inline" action="{{url('auth/update')}}" method="post">
		{{csrf_field()}}
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" name="name" value="{{$user['name']}}" class="form-control" id="name">
			</div>
			<button type="submit" class="btn btn-success">Change</button>
		</form>
		<h2>Password Setting</h2>
		<form class="form-horizontal" action="{{url('auth/change-password')}}" method="post">
		{{csrf_field()}}
			<div class="form-group">
				<label for="current_password">Current Password:</label>
				<input type="text" name="current_password" class="form-control" id="current_password">
			</div>
			<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="new_password">New Password:</label>
				<input type="text" name="password" class="form-control" id="password">
				@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
			</div>
			<div class="form-group">
				<label for="password_confirmation">Confirm Password:</label>
				<input type="text" name="password_confirmation" class="form-control" id="password_confirmation">
			</div>
			<button type="submit" class="btn btn-success">Change</button>
		</form>
	</div>
</div>
@stop