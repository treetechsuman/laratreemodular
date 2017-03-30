@extends('backend.layouts.app')
@section('title')
	User/Assign Role
@endsection
@section('site_map')
	User/Assign Role
@endsection
@section('content')
	@include('user::layouts.nav')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Assign Role</h3>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/assign-role')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<input type="hidden" name="user_id" value="{{$myuser}}">
		                    
		                    @foreach($roles as $role)
		                    
		                    <input type="checkbox" name="role_id[]" value="{{$role['id']}}"
		                    @if($userRepo->checkUserHasRole($myuser,$role['id']))
		                    checked="checked"
		                    @endif
		                    
		                    >
		                    <label class="label
		                      @if($userRepo->checkUserHasRole($myuser,$role['id']))
		                      label-success
		                      @else
		                      label-default
		                      @endif
		                      ">
		                      {{$role['name']}}
		                    </label>
		                    
		                    <br>
		                    @endforeach
						<div class="box-footer">
							<button type="submit" class="btn btn-primary  btn-xs">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
