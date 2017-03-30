@extends('layouts.backend-master')
@section('menu')
Contact Edit
@stop
@section('content')
<div class="row">
	
   	<div class="col-md-6 input">
   		<form method="post" action="{{url('contact/update/'.$contact['id'].'/'.$contact['group_id'])}}">
					   		{!! csrf_field() !!}
							  <div class="form-group">
							    <label for="first_name">*First Name:</label>
							    <input type="text" class="form-control" name="first_name" id="first_name" value="{{$contact['first_name']}}" required>
							    @if ($errors->has('first_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('first_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="middle_name">Middle Name:</label>
							    <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{$contact['middle_name']}}">
							    @if ($errors->has('middle_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('middle_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="last_name">*Last Name:</label>
							    <input type="text" class="form-control" name="last_name" id="last_name" value="{{$contact['last_name']}}">
							    @if ($errors->has('last_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('last_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="nick_name">*Nick Name :</label>
							    <input type="text" class="form-control" name="nick_name" id="nick_name" value="{{$contact['nick_name']}}" >
							    @if ($errors->has('nick_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('nick_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="dob">D O B :</label>
							    <input type="date" class="form-control" id="dob" name="dob" placeholder="(optional)" value="{{$contact['dob']}}">
							  </div>
							  <div class="form-group">
							    <label for="email">*Email:</label>
							    <input type="text" class="form-control" name="email" id="email" value="{{$contact['email']}}"> 
							    @if ($errors->has('email'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('email') }}</strong>
					               </span>
					            @endif
							  </div><div class="form-group">
							    <label for="phone">*Phone No.:</label>
							    <input type="number" class="form-control" name="phone" id="phone" placeholder="Ex:9843408895" value="{{$contact['phone']}}">  
							    @if ($errors->has('phone'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('phone') }}</strong>
					               </span>{{$contact['middle_name']}}
					            @endif
							  </div>
							  <button type="submit" class="btn btn-default">Submit</button>
						</form>
   	</div>
  
   </div>

@stop
