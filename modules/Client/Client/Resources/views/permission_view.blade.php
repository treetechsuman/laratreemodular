@extends('layouts.backend-master')
@section('menu')
Permission View
@stop
@section('content')
<div class="row">
   <div class="col-md-3">
   		<span><h3>client</h3></span>
   		<hr>
   		<div style="font-weight: 700;font-size:30px ;color: #3C8DBC">{{$client['name']}}</div>
   </div>
   <div class="col-md-3">
   		<span><h3>Available Permissions</h3></span>
   		<hr>
   		<form method="post" action="{{url('/client/permission/add/'.$client['id'])}}">
   		{!! csrf_field() !!}
   		@foreach($permissions as $permission)
   			<div style="background-color: #abd8d6;font-weight: 800; font-size: 16px; padding: 10px 10px;color:red;">
   				{{$permission['name']}}
   				<input type="checkbox" value="{{$permission['id']}}" name="check_list[]" class="pull-right">
   			</div>
   			
   			<br/>
   		@endforeach
   		<hr>
   			<button type="submit" class="btn btn-primary pull-right">Grant</button>
   		</form>

   </div>
   <div class="col-md-3">
   		<span><h3>Granted Permissions</h3></span>
   		<hr>
   		<form method="post" action="{{url('/client/permission/remove/'.$client['id'])}}">
   		{!! csrf_field() !!}
   		@foreach($grantedPermissions as $permission)
   			<div style="background-color: #abd8d6;font-weight: 800; font-size: 16px; padding: 10px 10px;color:green;">
   				{{$permission['name']}}
   				<input type="checkbox" value="{{$permission['id']}}" name="check_list1[]" class="pull-right">
   			</div>
   			
   			<br/>
   		@endforeach
   		<hr>
   			<button type="submit" class="btn btn-primary pull-right">Remove</button>
   		</form>
   </div>
   </div>
</div>
@stop