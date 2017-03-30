@extends('layouts.backend-master')
@section('menu')
Email Template View
@stop
@section('content')
<div class="row">

   <div class="col-md-12">
   		<a type="button" href="{{url('email/template/add')}}" class="btn btn-success pull-right">Add New Template </a>
   		<table class="table table-bordered" style="background-color: #f9f9f9;">
			<thead>
			    <tr>
			        <th>Template</th>
			        <th>Subject</th>
			        <th>Message</th>
			        <th>Acton</th>
			    </tr>
			    </thead>
			    <tbody>
			    @foreach($templates as $template)
			    
				<tr>
			      	<td>{{$template['template_id']}}</td>
			        <td>{{str_limit($template['subject'],40)}}</td>
			        <td>{!! str_limit($template['message'],50) !!}</td>
			        <td width="100">
			        	
			        	<a href="{{url('/email/template/delete/'.$template['id'])}}" type="button" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-trash"></span></a>
			        	<a href="{{url('/email/template/edit/'.$template['id'])}}" type="button" class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-edit"></span></a>
			        	
			        	<a href="{{url('/email/template/single/view/'.$template['id'])}}" type="button" class="btn btn-info btn-xs pull-right"><span class="glyphicon glyphicon-eye-open"></span></a>

					</td>
		        </tr>
				@endforeach
		    </tbody>
		</table>
   </div>
</div>
@stop