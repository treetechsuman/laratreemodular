@extends('backend.layouts.app')
@section('title')
Role & Permission Setup
@endsection
@section('site_map')
Role & Permission Setup
@endsection
@section('content')
<div class="row">
  <div class="col-md-2">
    
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Create Roles</h3>
      </div>
      <div class="box-body">
        <form role="form" action="{{url('role-permission/role/create')}}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group">
            <label for="exampletextinput1" {{ $errors->has('name') ? ' has-error' : '' }}>Role Name:</label>
            <input type="text" class="form-control" id="exampletextinput1"
            placeholder="Enter Name" name="name" value="{{old('name')}}" required>
            @if ($errors->has('name'))
            <span class="help-block" style="color: #cc0000">
              <strong> * {{ $errors->first('name') }}</strong>
            </span>
            @endif
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat btn-sm">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Create Permission</h3>
      </div>
      <div class="box-body">
        <form role="form" action="{{url('role-permission/permission/create')}}" method="post" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group">
            <label for="exampletextinput1" {{ $errors->has('name') ? ' has-error' : '' }}>Role Name:</label>
            <input type="text" class="form-control" id="exampletextinput1"
            placeholder="Enter Name" name="name" value="{{old('name')}}" required>
            @if ($errors->has('name'))
            <span class="help-block" style="color: #cc0000">
              <strong> * {{ $errors->first('name') }}</strong>
            </span>
            @endif
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-flat btn-sm">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <!-- general form elements -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Role</h3>
      </div>
      <div class="box-body">
        <table class="table table-condensed table-hover">
          <thead>
            <tr>
              <th>Role</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
              <td>{{$role['name']}}</td>
              <td>
                <a href="{{url('role-permission/role/edit/'.$role['id'])}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{{url('role-permission/role/delete/'.$role['id'])}}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
          
        </table>
      </div>
      <div class="box box-footer">
      </div>
    </div>
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Permission</h3>
      </div>
      <div class="box-body">
        <table class="table table-condensed table-hover">
          <thead>
            
            <tr>
              <th>Permission</th>
              <th>Action</th>
            </tr>
            
          </thead>
          <tbody>
            @foreach($permissions as $permission)
            <tr>
              <td>{{$permission['name']}}</td>
              <td>
                <a href="{{url('role-permission/permission/edit/'.$permission['id'])}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{{url('role-permission/permission/delete/'.$permission['id'])}}" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Assgin Permission</h3>
      </div>
      <div class="box-body">
        <table class="table table-condensed table-hover">
          <thead>            
            <tr>
              <th>role</th>
              <th>Action</th>
            </tr>            
          </thead>
          <tbody>
            @foreach($roles as $role)
            <tr>
              <td>{{$role['name']}}</td>
              <td>
                <form action="{{url('role-permission/role/assignpermission')}}" method="post">
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
                    {{$permission['name']}}
                  </label>
                  
                  <br>
                  @endforeach
                  <input type="submit" value="Assgin" class="btn btn-primary btn-xs">
                </form>
              </td>
            </tr>
            
            @endforeach
          </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
