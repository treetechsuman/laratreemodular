@extends('backend.layouts.app')
@section('title')
	create
@endsection
@section('site_map')
	user/create
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">create</h3>
					<a href="{{url('admin/user/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/store')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="col-md-3">
								<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{old('name')}}" required>
								@if ($errors->has('name'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="email" {{ $errors->has('email') ? ' has-error' : '' }}>Email:</label>
							</div>
							<div class="col-md-9">
								<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{old('email')}}" required>
								@if ($errors->has('email'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('email') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="password" {{ $errors->has('password') ? ' has-error' : '' }}>Password:</label>
							</div>
							<div class="col-md-9">
								<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="{{old('password')}}" required>
								@if ($errors->has('password'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('password') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-flat btn-sm">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
