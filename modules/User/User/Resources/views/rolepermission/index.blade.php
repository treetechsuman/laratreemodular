@extends('backend.layouts.app')
@section('title')
	index
@endsection
@section('site_map')
View	Role & permission
@endsection
@section('content')
	@include('user::layouts.nav')
	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Create Role</h3>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/role-permission/store')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="col-md-12">
								<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Role Name:</label>
							</div>
							<div class="col-md-12">
								<input type="text" class="form-control" id="name" placeholder="Enter Role Name." name="name" value="{{old('name')}}" required>
								@if ($errors->has('name'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-offset-0 col-sm-8">
							</br>
							<button type="submit" class="btn btn-primary btn-flat">Submit</button>
						</div>
						</div>
					</form>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Create Permission</h3>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/role-permission/permission/store')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="col-md-12">
								<label for="permissionname" {{ $errors->has('name') ? ' has-error' : '' }}>Permission Name:</label>
							</div>
							<div class="col-md-12">
								<input type="text" class="form-control" id="permissionname" placeholder="Enter Permission Name" name="name" value="{{old('name')}}" required>
								@if ($errors->has('name'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>



						<div class="form-group">

                                <div class="col-sm-offset-0 col-sm-8">
                                		</br>
                                    <button type="submit" class="btn btn-primary btn-flat" id="myBtn">Submit
                                    </button>
                                </div>
                            </div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Role List</h3>
				</div>
				<div class="box-body">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($roles as $role)
							<tr>
								<td>{{ucfirst($role['name'])}}</td>
								<td>
									<a href="{{url('admin/user/role-permission/'.$role['id'].'/edit')}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
									<a href="{{url('admin/user/role-permission/delete/'.$role['id'])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Permission List</h3>
				</div>
				<div class="box-body">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($permissions as $permission)
							<tr>
								<td>{{ucfirst($permission['name'])}}</td>
								<td>
									<a href="{{url('admin/user/role-permission/permission/'.$permission['id'].'/edit')}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
									<a href="{{url('admin/user/role-permission/permission/delete/'.$permission['id'])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

	<div class="col-md-4">
      <!-- general form elements -->
      
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Assign Permission</h3>
        </div>
        <div class="box-body">
          <table class="table table-condensed table-hover">
            <thead>
              
              <tr>
                <th>Role</th>
                <th>Actions</th>
              </tr>
              
            </thead>
            <tbody>
              @foreach($roles as $role)
              <tr>
                <td>{{ucfirst($role['name'])}}</td>
                <td>
                  <form action="{{url('admin/user/role-permission/assign-permission')}}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="role_id" value="{{$role['id']}}">
                    
                    @foreach($permissions as $permission)
                    
                    <input type="checkbox" name="permission_id[]" value="{{$permission['id']}}"
                    @if($rolePermissionRepo->checkRoleHasPermission($role['id'],$permission['id']))
                    checked="checked"
                    @endif
                    
                    >
                    <label class="label
                      @if($rolePermissionRepo->checkRoleHasPermission($role['id'],$permission['id']))
                      label-success
                      @else
                      label-default
                      @endif
                      ">
                      {{ucfirst($permission['name'])}}
                    </label>
                    
                    <br>
                    @endforeach
                    <input type="submit" value="Update" class="btn btn-primary btn-xs">
                  </form>
                </td>
              </tr>
              
              @endforeach
            </tbody>
            
          </table>
        </div>
        <div class="box box-footer">
        </div>
      </div>
    </div>

	</div>
@endsection
