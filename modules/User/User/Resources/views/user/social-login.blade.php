@extends('backend.layouts.app')
@section('title')
Social login
@endsection
@section('site_map')
Social login
@endsection
@section('content')
@include('user::layouts.nav')
<div class="row">
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Social login</h3>
			</div>
			<div class="box-body">
				<div class="btn-group">
					<a href="{{url('admin/user/facebook')}}" class="btn btn-primary">Faceboook</a>
					<a href="{{url('admin/user/google')}}" class="btn btn-danger">Google</a>	
				</div>
				<p>
					<h3>To integrate facebook and google login</h3>
					 Follow following step<br>
				</p>
				<p>
					<h3>composer.json</h3>
					 "laravel/socialite": "^2.0"<br>
				</p>
				<p>
					<h3>config/app.php</h3>
					 Laravel\Socialite\SocialiteServiceProvider::class,<br>
					 'Socialite' => Laravel\Socialite\Facades\Socialite::class,
				</p>
				<p>
					<h3>config/service.php</h3>
					'facebook' => [ <br>
				        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'client_id' => env('F_CID'),<br>
				        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'client_secret' => env('F_CS'),<br>
				        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'redirect' => env('F_CBU'),<br>
				    ],<br>
				    'google' => [<br>
				        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'client_id' => env('G_CID'),<br>
				        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'client_secret' => env('G_CS'),<br>
				        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'redirect' => env('G_CBU'),<br>
				    ],<br>
				</p>
				<p>
					<h3>.env</h3>
					F_CID=face book client id<br>
					F_CS=secret key<br>
					F_CBU=Call back url<br><br><br>


					G_CID=google client id<br>
					G_CS=secret key<br>
					G_CBU=Call back url<br>
				</p>
			</div>
		</div>
	</div>
</div>
@endsection