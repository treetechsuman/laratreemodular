@extends('layouts.backend-master')
@section('menu')
Group Merge
@stop
@section('content')

<div class="row">
	<div class="col-md-4">
	@foreach($groups as $group)
	<div class="group" id="{{$group['id']}}" style="background: #3C8DBC; border-bottom:2px solid grey">
		<h3 style="color:#fff; padding-top: 5px;font-weight: 400">{{$group['name']}}</h3>
	</div>
	@endforeach
	</div>
	<div class="col-md-4">
		<form method="POST" action="{{url('/contact/group/mergeto')}}">
		{{csrf_field()}}
		<div class="toMerge">
		</div>
		<div id="merge-option" class="hidden">
			<div class="input-group">
		      
		      <input type="text" name="newGroup" id="new-group" class="form-control" placeholder="Merge these groups and create....">
		      <input type="text" name="groupId" id="group-ids" class="hidden" placeholder="Merge these groups and create....">
		      <span class="input-group-btn">
		        <button class="btn btn-primary" type="submit">Submit</button>
		      </span>
		    </div>
			<center><p>Or</p></center>
			<span>Merge to :</span><span id="selectedGroups"></span>
		</div>
		</form>
	</div>
</div>

@stop