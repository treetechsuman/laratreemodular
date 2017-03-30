@extends('layouts.backend-master')
@section('menu')
Email Template Edit
@stop
@section('content')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
   <div class="row">

   	<div class="col-md-12 input">
   	<div class="panel panel-primary">
			<div class="panel-heading">Add New Group</div>
			<div class="panel-body" style="background-color: #f9f9f9;">
				<form method="post" action="{{url('email/template/update/'.$template['id'])}}" id="form1" name="form1">
			   		{!! csrf_field() !!}
					  <div class="form-group">
					    <label for="template_id">*Template Id:</label>
					    <input type="text" class="form-control" name="template_id" id="template_id" value="{{$template['template_id']}}" required>
					    @if ($errors->has('template_id'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('template_id') }}</strong>
			               </span>
			            @endif
					  </div>
					  <div class="form-group">
					    <label for="subject">*Subject:</label>
					    <input type="text" class="form-control" name="subject" id="template_id" value="{{$template['subject']}}" required>
					    @if ($errors->has('subject'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('subject') }}</strong>
			               </span>
			            @endif
					  </div>
					  <div class="form-group">
					    <label for="message">*Message:</label>
					    <textarea class="form-control" name="message" rows="5" required>{{$template['message']}}</textarea>
					    @if ($errors->has('message'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('message') }}</strong>
			               </span>
			            @endif
					  </div>
				        <script>
				            CKEDITOR.replace( 'message' );
				        </script>
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
   		
   	</div>
</div>
@stop
