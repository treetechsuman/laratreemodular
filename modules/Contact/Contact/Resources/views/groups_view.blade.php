@extends('layouts.backend-master')
@section('menu')
Group View
@stop
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="button-inline pull-right" style="margin-right: 130px">
			<a type="button" href="{{url('contact/group/add')}}" class="btn btn-success ">Add New Group </a>
			<a type="button" href="{{url('contact/group/merge')}}" class="btn btn-warning">Merge Groups </a>
		</div>
		<h3>Groups:</h3>
		@foreach($groups as $group)
		<div class="row" style="background-color: #f4f4f4;border-bottom: 3px solid white">
			<div class="col-md-4"><h2 style="color:#019da5;font-weight: 800">{{$group['name']}}</h2></div>
			<div class="col-md-4" style="padding-top: 15px">
				<form method="POST" action="{{url('contact/uploadCSV/'.$group['id'])}}" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="col-sm-10">
								<input type="file" accept=".csv" id="contacts" name="contacts" class="form-control" style="float: left" required/><br/></div>
							<div class="col-sm-2" >
								<button type="submit" class="btn btn-success btn-sm pull-right">Add</button>
							</div>


						</form>
			</div>
			<div class="col-md-4" style="padding-top: 15px">
				<div class="button-group">
					<a  type="button" href="{{url('/contact/group/singleView/'.$group['id'])}}" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span> View</a>

			        <a href="{{url('/contact/group/edit/'.$group['id'])}}" type="button" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span> Edit</a>

			        <a href="{{url('/contact/group/delete/'.$group['id'])}}" type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
				</div>
			</div>

		</div>
		@endforeach
	</div>
</div>
@stop
