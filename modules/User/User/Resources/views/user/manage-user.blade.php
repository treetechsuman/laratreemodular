@extends('backend.layouts.app')
@section('title')
	Mange user
@endsection
@section('site_map')
	User/ManageUser
@endsection
@section('content')
	@include('user::layouts.nav')
	<div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Assign Role</h3>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/assign-role')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<input type="hidden" name="user_id" value="{{$myuser}}">
		                    
		                    @foreach($roles as $role)
		                    
		                    <input type="checkbox" name="role_id[]" value="{{$role['id']}}"
		                    @if($userRepo->checkUserHasRole($myuser,$role['id']))
		                    checked="checked"
		                    @endif
		                    
		                    >
		                    <label class="label
		                      @if($userRepo->checkUserHasRole($myuser,$role['id']))
		                      label-success
		                      @else
		                      label-default
		                      @endif
		                      ">
		                      {{$role['name']}}
		                    </label>
		                    
		                    <br>
		                    @endforeach
						<div class="box-footer">
							<button type="submit" class="btn btn-primary  btn-xs">Update</button>
						</div>
					</form>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Change Passowrd</h3>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/user/change-password')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
								<div class="col-md-5">
									<label for="password" {{ $errors->has('password') ? ' has-error' : '' }}>New Passowrd:</label>
								</div>
								<div class="col-md-7">
									<input type="hidden" name="user_id" value="{{$myuser}}">
									<input type="text" class="form-control" id="password" placeholder="Enter New Passowrd" name="password"  required>
									@if ($errors->has('password'))
										<span class="help-block" style="color: #cc0000">
											<strong> * {{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary  btn-xs">Update</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		@if(count($userDetail)>0)
			<div class="col-md-5">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Edit</h3>
					</div>
					<div class="box-body">
						<form role="form" action="{{url('admin/user/userDetail/update/'.$userDetail['id'])}}" method="post" enctype="multipart/form-data">
							{!! csrf_field() !!}
							<div class="form-group">
								<div class="col-md-3">
									<label for="mobile" {{ $errors->has('mobile') ? ' has-error' : '' }}>Mobile:</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile" value="{{$userDetail['mobile']}}" required>
									@if ($errors->has('mobile'))
										<span class="help-block" style="color: #cc0000">
											<strong> * {{ $errors->first('mobile') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label for="gender" {{ $errors->has('gender') ? ' has-error' : '' }}>Gender:</label>
								</div>
								<div class="col-md-9">
									<select name="gender" class="form-control">
										<option value="Male" @if($userDetail['gender']=='Male') selected="selected" @endif >Male</option>
										<option value="Female" @if($userDetail['gender']=='Female') selected="selected" @endif >Female</option>
										<option value="Other" @if($userDetail['gender']=='Other') selected="selected" @endif >Other</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label for="dob" {{ $errors->has('dob') ? ' has-error' : '' }}>Dob:</label>
								</div>
								<div class="col-md-9">
									<input type="date" class="form-control" id="dob" placeholder="Enter dob" name="dob" value="{{$userDetail['dob']}}" required>
									@if ($errors->has('dob'))
										<span class="help-block" style="color: #cc0000">
											<strong> * {{ $errors->first('dob') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label for="address" {{ $errors->has('address') ? ' has-error' : '' }}>Address:</label>
								</div>
								<div class="col-md-9">
									<input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{$userDetail['address']}}" required>
									@if ($errors->has('address'))
										<span class="help-block" style="color: #cc0000">
											<strong> * {{ $errors->first('address') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label >Image:</label>
								</div>
								<div class="col-md-9">
									<img src="{{asset($userDetail['image'])}}" class="img-responsive">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label for="image" {{ $errors->has('image') ? ' has-error' : '' }}>Change:</label>
								</div>
								<div class="col-md-9">
									<input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
									@if ($errors->has('image'))
										<span class="help-block" style="color: #cc0000">
											<strong> * {{ $errors->first('image') }}</strong>
										</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label for="status" {{ $errors->has('status') ? ' has-error' : '' }}>Status:</label>
								</div>
								<div class="col-md-9">
								<input type="hidden"  name="user_id" value="{{$myuser}}" >
								<input type="hidden"  name="type" value="{{$userDetail['type']}}" >
									<select name="status" class="form-control">
										<option value="Active" @if($userDetail['status']=='Active') selected="selected" @endif >Active</option>
										<option value="Inactive" @if($userDetail['status']=='Inactive') selected="selected" @endif >Inactive</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-3">
									<label for="type" {{ $errors->has('type') ? ' has-error' : '' }}>User Type:</label>
								</div>
								<div class="col-md-9">
									<select name="type" class="form-control">
										<option value="fornt" @if($userDetail['type']=='fornt') selected="selected" @endif >Front</option>
										<option value="back" @if($userDetail['type']=='back') selected="selected" @endif >Back</option>
									</select>
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary btn-flat btn-sm">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		@else
			<div class="col-md-5">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Create</h3>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/user/userDetail/store')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="col-md-3">
								<label for="mobile" {{ $errors->has('mobile') ? ' has-error' : '' }}>Mobile:</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile" value="{{old('mobile')}}" required>
								@if ($errors->has('mobile'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('mobile') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="gender" {{ $errors->has('gender') ? ' has-error' : '' }}>Gender:</label>
							</div>
							<div class="col-md-9">
								<select name="gender" class="form-control">
									<option value="Male" @if(old('gender')=='Male') selected="selected" @endif >Male</option>
									<option value="Female" @if(old('gender')=='Female') selected="selected" @endif >Female</option>
									<option value="Other" @if(old('gender')=='Other') selected="selected" @endif >Other</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="dob" {{ $errors->has('dob') ? ' has-error' : '' }}>Dob:</label>
							</div>
							<div class="col-md-9">
								<input type="date" class="form-control" id="dob" placeholder="Enter dob" name="dob" value="{{old('dob')}}" required>
								@if ($errors->has('dob'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('dob') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="address" {{ $errors->has('address') ? ' has-error' : '' }}>Address:</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" id="address" placeholder="Enter address" name="address" value="{{old('address')}}" required>
								@if ($errors->has('address'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('address') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="image" {{ $errors->has('image') ? ' has-error' : '' }}>Image:</label>
							</div>
							<div class="col-md-9">
								<input type="file" class="form-control" id="image" placeholder="Enter image" name="image" value="{{old('image')}}" required>
								@if ($errors->has('image'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('image') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3">
								<label for="status" {{ $errors->has('status') ? ' has-error' : '' }}>Status:</label>
							</div>
							<div class="col-md-9">
							<input type="hidden"  name="user_id" value="{{$myuser}}" >
							<input type="hidden"  name="type" value="back" >
								<select name="status" class="form-control">
									<option value="Active" @if(old('status')=='Active') selected="selected" @endif >Active</option>
									<option value="Inactive" @if(old('status')=='Inactive') selected="selected" @endif >Inactive</option>
								</select>
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-flat btn-sm">Create</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		@endif
	</div>
@endsection
