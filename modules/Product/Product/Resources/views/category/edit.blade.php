@extends('backend.layouts.app')
@section('title')
edit
@endsection
@section('site_map')
category/edit
@endsection
@section('content')
@include('product::layouts.nav')
<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">edit</h3>
				<a href="{{url('admin/product/category/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
			</div>
			<div class="box-body">
				<form role="form" action="{{url('admin/product/category/update/'.$category['id'])}}" method="post" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-group">
						<div class="col-md-3">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
						</div>
						<div class="col-md-9">
							<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$category['name']}}" required>
							@if ($errors->has('name'))
							<span class="help-block" style="color: #cc0000">
								<strong> * {{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label for="image" {{ $errors->has('image') ? ' has-error' : '' }}>Image:</label>
						</div>
						<div class="col-md-9">							
							<img src="{{asset($category['image'])}}" class="img-responsive">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label for="image" {{ $errors->has('image') ? ' has-error' : '' }}>Change Image:</label>
						</div>
						<div class="col-md-9">							
							<input type="file" name="image" class="form-control" id="image" value="{{old('image')}}">
							@if ($errors->has('image'))
							<span class="help-block" style="color: #cc0000">
								<strong> * {{ $errors->first('image') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Parent:</label>
						</div>
						<div class="col-md-9">
							<select name="parent_id" class="form-control">
								<option value="0">none</option>
								@foreach($categories as $categorylist)
								<option value="{{$categorylist['id']}}" @if($category['parent_id']==$categorylist['id']) selected="selected" @endif>{{$categorylist['name']}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-3">
							<label for="display_order" {{ $errors->has('display_order') ? ' has-error' : '' }}>Display Order:</label>
						</div>
						<div class="col-md-9">							
							<input type="number" class="form-control" id="display_order" placeholder="Display Order" name="display_order" value="{{$category['display_order']}}" required>
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
								<option value="Active" @if($category['status']=='Active') selected="selected" @endif >Active</option>
								<option value="Inactive" @if($category['status']=='Inactive') selected="selected" @endif >Inactive</option>
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
	@include("product::category.category_tree")
</div>
@endsection