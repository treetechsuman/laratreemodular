@extends('backend.layouts.app')
@section('title')
Edit User
@endsection
@section('site_map')
Edit User
@endsection
@section('content')
@include('user::layouts.nav')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Edit User</h3>
			</div>
			<div class="box-body">
				<form role="form" action="{{url('admin/user/user/update/'.$myuser['id'])}}" method="post" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-group">
						<div class="col-md-3">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$myuser['name']}}" required>
							@if ($errors->has('name'))
							<span class="help-block" style="color: #cc0000">
								<strong> * {{ $errors->first('name') }}</strong>
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