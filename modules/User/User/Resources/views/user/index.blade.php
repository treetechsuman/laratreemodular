@extends('backend.layouts.app')
@section('title')
User List
@endsection
@section('site_map')
User List
@endsection
@section('content')
@include('user::layouts.nav')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Users List</h3>
				<a href="{{url('admin/user/user/create')}}" data-toggle="tooltip" title="Add Users" class="btn btn-primary btn-xs pull-right">
					<i class="glyphicon glyphicon-plus"></i></a>
			</div>
			<div class="box-body">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Roles</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{$user['name']}}</td>
							<td>{{$user['email']}}</td>
							<td>
								<?php $isSuperAdmin =false; ?>
								@foreach($userRepo->getRoleByUserId($user['id']) as $role)
								{{$role['name']}},
								<?php
									if($role['name']=="SuperAdmin"){
										$isSuperAdmin =true;
									}
								?>
								@endforeach
							</td>
							<td>
								<div class="btn-group">
								<a href="{{url('admin/user/user/manage-user/'.$user['id'])}}" data-toggle="tooltip" title="Manage" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i></a>

								<a href="{{url('admin/user/user/'.$user['id'].'/edit')}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
								@if(!$isSuperAdmin)
								<a href="{{url('admin/user/user/delete/'.$user['id'])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a>
								@endif
								</div>
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