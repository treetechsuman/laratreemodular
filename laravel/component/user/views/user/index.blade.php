@extends('backend.layouts.app')
@section('title')
	index
@endsection
@section('site_map')
	user/index
@endsection
@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">index</h3>
					<a href="{{url('admin/user/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
				</div>
				<div class="box-body">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>
								<th>Id</th>
								<th>Name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td>{{$user['id']}}</td>
								<td>{{$user['name']}}</td>
								<td>{{$user['email']}}</td>
								<td>
									<a href="{{url('admin/user/'.$user['id'].'/edit')}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
									<a href="{{url('admin/user/delete/'.$user['id'])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a></i></a>
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
