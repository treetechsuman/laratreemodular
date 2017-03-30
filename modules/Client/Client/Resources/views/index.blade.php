@extends('layouts.backend-master')
@section('menu')
Client
@stop
@section('content')
<div class="row">
	<div class="col-md-12">	
	<a href="{{url('/client/create')}}" class="btn btn-success">Add new Client</a>	
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Password</th>
					<th>Mobile</th>
					<th>Address</th>
					<th>Expire on</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($clients as $client)
				<tr>
					<td>{{$client['name']}}</td>
					<td>{{$client['email']}}</td>
					<td>{{$client['password']}}</td>
					<td>{{$client['mobile']}}</td>
					<td>{{$client['address']}}</td>
					<td>{{$client['expire_on']}}</td>
					<td>{{$client['status']}}</td>					
					<td>
						<div class="btn-group">
							<a href="{{('/client/permission/'.$client['id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Add Permission"><span class="glyphicon glyphicon-plus"></span></a>

							<a href="{{url('client/edit/'.$client['id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Update Client info"><span class="glyphicon glyphicon-plus"></span></a>
							
							<a href="{{url('client/delete/'.$client['id'])}}" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Client"><span class="glyphicon glyphicon-remove"></span></a>
						</div>
					</td>
						
					</tr>
			@endforeach
			</tbody>
			</table>		
	</div>
</div>
@stop