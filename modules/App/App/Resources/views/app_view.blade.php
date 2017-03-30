@extends('layouts.backend-master')
@section('menu')
App View
@stop
@section('content')
<div class="row">

   <div class="col-md-12">
   		<a type="button" href="{{url('app/create')}}" class="btn btn-success pull-right">Add New App </a>
   		<table class="table table-bordered" style="background-color: #f9f9f9;">
			<thead>
			    <tr>
			        <th>Name</th>
			        <th>App Key</th>
			        <th>App Secret</th>
			        <th>Permission</th>
			        <th>Acton</th>
			    </tr>
			    </thead>
			    <tbody>
			    @foreach($apps as $app)
			    
				<tr>
			      	<td>{{$app['name']}}</td>
			        <td>{{$app['app_key']}}</td>
			        <td>{{$app['app_secret']}}</td>
			        <td>
			        	<a href="{{url('/app/permission/'.$app['id'])}}" type="button" class="btn btn-success btn pull-right"><span class="glyphicon glyphicon-user"></span>Add Permission</a>
			        </td>
			        <td >
			        	<div class="button-group">
			        	
			        	<a href="{{url('/app/delete/'.$app['id'])}}" type="button" class="btn btn-danger btn pull-right"><span class="glyphicon glyphicon-trash"></span></a>
			        	<a href="{{url('/app/edit/'.$app['id'])}}" type="button" class="btn btn-primary btn pull-right"><span class="glyphicon glyphicon-edit"></span></a>
			        	</div>
					</td>
		        </tr>
				@endforeach
		    </tbody>
		</table>
   </div>
</div>
@stop