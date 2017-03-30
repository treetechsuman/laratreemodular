@extends('backend.layouts.app')
@section('title')
	create
@endsection
@section('site_map')
	unit/create
@endsection
@section('content')
	@include('product::layouts.nav')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">create</h3>
					<a href="{{url('admin/product/unit/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
				</div>
				<div class="box-body">
					<form role="form" action="{{url('admin/product/unit/store')}}" method="post" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="col-md-3">
								<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{old('name')}}" required>
								@if ($errors->has('name'))
									<span class="help-block" style="color: #cc0000">
										<strong> * {{ $errors->first('name') }}</strong>
									</span>
								@endif
							</div>
						</div>
						<div class="form-group">
						<div class="col-md-3">
							<label for="display_order" {{ $errors->has('display_order') ? ' has-error' : '' }}>Display Order:</label>
						</div>
						<div class="col-md-9">							
							<input type="number" class="form-control" id="display_order" placeholder="Display Order" name="display_order" value="{{old('display_order')}}" required>
							@if ($errors->has('display_order'))
							<span class="help-block" style="color: #cc0000">
								<strong> * {{ $errors->first('display_order') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label for="status" {{ $errors->has('status') ? ' has-error' : '' }}>status:</label>
						</div>
						<div class="col-md-9">
							<select name="status" class="form-control">
								<option value="Active" @if(old('status')=='Active') selected="selected" @endif >Active</option>
								<option value="Inactive" @if(old('status')=='Inactive') selected="selected" @endif >Inactive</option>
							</select>							
						</div>
					</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary btn-flat btn-sm">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
