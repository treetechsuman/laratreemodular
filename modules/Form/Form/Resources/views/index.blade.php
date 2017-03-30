@extends('layouts.backend-master')
@section('menu')
Form
@stop
@section('content')
<div class="row">
	<div class="col-md-12">
	<a href="{{url('form/create')}}" class="btn btn-success">Add new form</a>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Form Title</th>
					<th>Slag</th>
					<th>Email</th>
					<th>Email Templete</th>
					<th>Auto Responder</th>
					<th>Notification</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($forms as $form)
				<tr>
					<td>{{$form['title']}}</td>
					<td>{{$form['slag']}}</td>
					<td>{{$form['email']}}</td>
					<td>{{$form['email_template_name']}}</td>
					<td>{{$form['auto_responder']}}</td>
					<td>{{$form['notification']}}</td>
					<td>
						<div class="btn-group">
							<a href="{{url('form/create-field/'.$form['id'])}}" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="Add fiels of this form"><span class="glyphicon glyphicon-plus"></span></a>
							<a href="{{url('form/edit/'.$form['id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Update From"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="{{url('form/edit-field/'.$form['id'])}}" type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Update fields"><span class="glyphicon glyphicon-edit"></span></a>
							<a href="{{url('form/form-preview/'.$form['id'])}}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="preview form"><span class="glyphicon glyphicon-eye-open"></span></a>
							<a href="{{url('form/submitted-from-value/'.$form['id'])}}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" title="Form value"><span class="glyphicon glyphicon-eye-open"></span></a>
							<a href="{{url('form/delete/'.$form['id'])}}" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete From"><span class="glyphicon glyphicon-remove"></span></a>
						</div>
					</td>
						
					</tr>
			@endforeach		
			</tbody>
			</table>
		</div>
		
	</div>
	@stop