@extends('backend.layouts.app')
@section('title')
	profile
@endsection
@section('site_map')
	user/profile
@endsection
@section('content')
	@include('user::layouts.nav')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Profile</h3>
				</div>
				<div class="box-body">
					<ul>
						<li>Name: {{ $profile['name'] }}</li>
						<li>Email: {{ $profile['email'] }}</li>
						<li><a  id="change_password" class="btn btn-success btn-xs">Change Password</a></li>
					</ul>
					<div id="change_form">
						<form class="form-horizontal" method="post" action="{{url('admin/user/change-profile-password')}}" enctype="multipart/form-data">
				            {!! csrf_field() !!}
				                    <!-- Default box -->
				            <div class="box">
				                <div class="box-header with-border">
				                    <h3 class="box-title">Change Password</h3>
				                </div>
				                <div class="shadow">
				                    <div class="row">
				                        <div class="col-md-8">
				                			<div class="form-group">
				                                <label for="pass1" class="col-sm-6 control-label">Old Password<span class=help-block"
				                                    style="color: #b30000">&nbsp;* </span></label>

				                                <div class="col-sm-6">
				                                    <input type="password" class="form-control" id="pass1"
				                                           placeholder="Enter Password." name="oldpassword" required>
				                                </div>
				                            </div>
				                            <div class="form-group">
				                                <label for="pass1" class="col-sm-6 control-label">Password<span class=help-block"
				                                    style="color: #b30000">&nbsp;* </span></label>

				                                <div class="col-sm-6">
				                                    <input type="password" class="form-control" id="password"
				                                           placeholder="Enter Password." name="password" required>
				                                           @if ($errors->has('password'))
						                                    <span class="help-block" style="color: red">
						                                        <strong> * {{ $errors->first('password') }}</strong>
						                                    </span>
						                                    @endif
				                                </div>
				                            </div>
				                            <div class="form-group">
				                                <label for="pass2" class="col-sm-6 control-label">Re-Password<span class=help-block"
				                               style="color: #b30000">&nbsp;* </span></label>

				                                <div class="col-sm-6">
				                                    <input type="password" name="password_confirmation" id="rpassword" class="form-control" placeholder="Re Type Initial Password." required>
				                                </div>
				                            </div>

				                            <div class="form-group">
				                                <div class="col-sm-offset-6 col-sm-6">
				                                    <button type="submit" class="btn btn-success btn-flat">Save
				                                    </button>
				                                    <button type="reset" class="btn btn-default btn-flat">Reset</button>
				                                </div>
				                            </div>
				                        </div>
				                    </div>

				                </div>
				                <!-- /.box -->
				            </div>
				        </form>
						
					</div>	
				</div>
			</div>
		</div>
		
	</div>
@endsection