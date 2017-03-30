@extends('layouts.backend-master')
@section('menu')
APP Add
@stop
@section('content')
   <div class="row">

   	<div class="col-md-12 input">
   	<div class="panel panel-primary">
			<div class="panel-heading">Add New APP</div>
			<div class="panel-body" style="background-color: #f9f9f9;">
				<form method="post" action="{{url('app/store')}}">
			   		{!! csrf_field() !!}
					  <div class="form-group">
					    <label for="name">App Name:</label>
					    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" required>
					    @if ($errors->has('name'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('name') }}</strong>
			               </span>
			            @endif
					  </div>
					  <!-- <div class="form-group">
					    <label for="app_key">App Key:</label>
					    <input type="text" class="form-control" name="app_key" id="app_key" value="{{old('app_key')}}" required>
					    @if ($errors->has('app_key'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('app_key') }}</strong>
			               </span>
			            @endif
					  </div>
					  <div class="form-group">
					    <label for="app_secret">App secret:</label>
					    <input type="text" class="form-control" name="app_secret" id="app_secret" value="{{old('app_secret')}}" required>
					    @if ($errors->has('app_secret'))
			               <span class="help-block" style="color: red;">
			                   <strong>{{ $errors->first('app_secret') }}</strong>
			               </span>
			            @endif
					  </div> -->
					  
					  <button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
   		
   	</div>
</div>
@stop
