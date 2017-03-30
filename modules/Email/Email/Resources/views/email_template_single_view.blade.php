@extends('layouts.backend-master')
@section('menu')
Email Template Single View
@stop
@section('content')
<div class="row">

   <div class="col-md-12">
   		<table class="table table-bordered" style="background-color: #f9f9f9;">
			<thead>
			    <tr>
			        <th>Template</th>
			        <th>Subject</th>
			        <th>Message</th>
			        
			    </tr>
			    </thead>
			    <tbody>
			   
			    
				<tr>
			      	<td>{{$template['template_id']}}</td>
			        <td>{{$template['subject']}}</td>
			        <td>{!! $template['message'] !!}</td>
		        </tr>
			
		    </tbody>
		</table>
   </div>
</div>
@stop