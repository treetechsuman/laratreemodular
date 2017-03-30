@extends('layouts.backend-master')
@section('menu')
Contact View
@stop
@section('submenu')
{{$submenu['name']}}
@stop
@section('content')

   <div class="row">
   <div class="col-md-8 output">
   		<table class="table table-bordered">
		    <thead>
		      <tr>
		      <th>#</th>
		        <th>Name</th>
		        <th>Email</th>
		        <th>Phone</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tbody>

		    @if(isset($contacts))
			    @foreach($contacts as $contact)
			      <tr>
			      <td>
			        {{ (($contacts->currentPage() - 1 ) * $contacts->perPage() ) + $loop->iteration }}
				  </td>
			      	<td>{{$contact['first_name']}} {{$contact['middle_name']}} {{$contact['last_name']}}</td>
			        <td>{{$contact['email']}}</td>
			        <td>{{$contact['phone']}}</td>
			        <td>
			        	<a  type="button" href="{{url('/contact/edit/'.$contact['id'])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
			        	<a href="{{url('/contact/delete/'.$contact['id'])}}" type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
			        	<a href="{{url('/contact/single/view/'.$contact['id'])}}" type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>

			        </td>
			      </tr>
			      @endforeach
		      @endif
		    </tbody>
		</table>
		{{$contacts->links()}}

		<!-- <div class="col-md-3">
			<div class="panel panel-primary"  style="background-color: #f9f9f9;">
				<div class="panel-heading">Import Contact From CSV</div>
				<div class="panel-body">
					<form method="POST" action="{{url('contact/upload/'.$id)}}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
					  	<input type="file" id="contacts" name="contacts" class="form-control" required/><br/>
					  	<button type="submit" class="btn btn-success btn-sm">Add To DB</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-danger"  style="background-color: #f9f9f9;">
				<div class="panel-heading">Export Contact To CSV</div>
				<div class="panel-body">

					  	<a href="{{url('contact/export')}}" type="button" class="btn btn-success btn-sm">Export To Excel</a>

				</div>
			</div>
		</div> -->
	</div>
   <div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading">Add New Contact</div>
					<div class="panel-body" style="background-color: #f9f9f9;">
						<form method="post" action="{{url('contact/store/'.$id)}}">
					   		{!! csrf_field() !!}
							  <div class="form-group">
							    <label for="first_name">First Name:</label>
							    <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}">
							    @if ($errors->has('first_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('first_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="middle_name">Middle Name:</label>
							    <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{old('middle_name')}}">
							    @if ($errors->has('middle_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('middle_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="last_name">Last Name:</label>
							    <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}">
							    @if ($errors->has('last_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('last_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="nick_name">Nick Name :</label>
							    <input type="text" class="form-control" name="nick_name" id="nick_name" value="{{old('nick_name')}}" >
							    @if ($errors->has('nick_name'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('nick_name') }}</strong>
					               </span>
					            @endif
							  </div>
							  <div class="form-group">
							    <label for="dob">D O B :</label>
							    <input type="date" class="form-control" id="dob" name="dob" placeholder="(optional)" value="{{old('dob')}}">
							  </div>
							  <div class="form-group">
							    <label for="email">*Email:</label>
							    <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
							    @if ($errors->has('email'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('email') }}</strong>
					               </span>
					            @endif
							  </div><div class="form-group">
							    <label for="phone">*Mobile:</label>
							    <input type="number" class="form-control" name="phone" id="phone" placeholder="Ex:9843408895" value="{{old('phone')}}">
							    @if ($errors->has('phone'))
					               <span class="help-block" style="color: red;">
					                   <strong>{{ $errors->first('phone') }}</strong>
					               </span>
					            @endif
							  </div>
							  <button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div>
				</div>
	</div>

</div>


@stop
