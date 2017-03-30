@extends('layouts.backend-master')
@section('menu')
Contact Single View
@stop
@section('submenu')
Contact Single View
@stop
@section('content')

   <div class="row">
   	<div class="col-md-12 output">
   		<table class="table table-bordered">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Nick Name</th>
		        <th>Group Id</th>
		        <th>Email</th>
		        <th>Phone</th>
		        <th>DOB</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tbody>
			      <tr>
			      	<td>{{$contact['first_name']}} {{$contact['middle_name']}} {{$contact['last_name']}}</td>
			      	<td>{{$contact['nick_name']}}</td>
			      	<td>{{$contact['group_id']}}</td>
			        <td>{{$contact['email']}}</td>
			        <td>{{$contact['phone']}}</td>
			        <td>{{$contact['dob']}}</td>
			        <td>
			        	<a  type="button" href="{{url('/contact/edit/'.$contact['id'])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
			        	
			        	<a href="{{url('/contact/delete/'.$contact['id'])}}" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
			        </td>
			      </tr>
			  
		    </tbody>
		</table>
		
	</div>
</div>


@stop
