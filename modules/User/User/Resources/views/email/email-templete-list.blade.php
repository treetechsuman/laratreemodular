@extends('backend.layouts.app')
@section('title')
Email templete
@endsection
@section('site_map')
Email templete
@endsection
@section('content')
@include('user::layouts.nav')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Email templete</h3>
			</div>
			<div class="box-body">
				<div class="btn-group">
					<a href="{{url('admin/user/email-templete/')}}" class="btn btn-default">Welcome</a>
					<a href="{{url('admin/user/email-templete/survey')}}" class="btn btn-default">Survey</a>
					<a href="{{url('admin/user/email-templete/password-reset')}}" class="btn btn-default">Password Reset</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Email layout</h3>
			</div>
			<div class="box-body">
				 @include('user::email.'.$templete_name)
			</div>
		</div>
	</div>
</div>
@endsection