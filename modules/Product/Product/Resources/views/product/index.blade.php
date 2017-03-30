@extends('backend.layouts.app')
@section('title')
index
@endsection
@section('site_map')
product/index
@endsection
@section('content')
@include('product::layouts.nav')
<div class="row">
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Category</h3>
				<a href="{{url('admin/product/category/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
			</div>
			<div class="box-body">
				{!!$category_tree!!}
			</div>
		</div>
		
	</div>
	<div class="col-md-2">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Product</h3>
				<a href="{{url('admin/product/product/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
			</div>
			<div class="box-body">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Product</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $product)
						<tr>
							<td>
								<a href="{{url('admin/product/product/pushproduct/'.$product['id'])}}"
									@if(Session::get('product_id')==$product['id'])
									class="btn  btn-success btn-xs"
									@else
									class="btn  btn-default btn-xs"
									@endif
									>
									{{$product['name']}}
								</a>
							</td>
							<td>
								<a href="{{url('admin/product/product/'.$product['id'].'/edit')}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
								<a href="{{url('admin/product/product/delete/'.$product['id'])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		
		
	</div>
	<div class="col-md-2">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Create Product</h3>
				<a href="{{url('admin/product/product/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
			</div>
			<div class="box-body">
				<form role="form" action="{{url('admin/product/product/store')}}" method="post" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-group">
						<div class="col-md-12">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{old('name')}}" required>
							@if ($errors->has('name'))
							<span class="help-block" style="color: #cc0000">
								<strong> * {{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
						</div>
						<div class="col-md-12">
							<select  name="category_id" class="form-control">
								@foreach($categories as $category)
								<option value="{{$category['id']}}"
									@if($category['id']==Session::get('category_id'))
									selected="selected"
									@endif>
									{{$category['name']}}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary btn-xs">Submit</button>
					</div>
				</form>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Add Image</h3>
				
			</div>
			<form action="{{ url('admin/product/product/create-image') }}" method="post" role="form" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="image">Select Image</label>
						<input type="file" name="image[]" class="form-control" id="image" multiple>
					</div>
					<div class="form-group">
						<label for="product_id">Product</label>
						<select name="product_id" class="form-control" id="product_id">
							@foreach($products as $product)
							<option value="{{ $product['id'] }}"
								@if($product['id']==Session::get('product_id'))
								selected="selected"
								@endif>
								{{$product['name']}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary btn-xs">Submit</button>
				</div>
			</form>
			
		</div>
	</div>
	<div class="col-md-2">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Create Attirbute</h3>
			</div>
			<div class="box-body">
				<form role="form" action="{{url('admin/product/product/store-attribute')}}" method="post" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="form-group">
						<div class="col-md-12">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Name:</label>
						</div>
						<div class="col-md-12">
							<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{old('name')}}" required>
							@if ($errors->has('name'))
							<span class="help-block" style="color: #cc0000">
								<strong> * {{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<label for="name" {{ $errors->has('name') ? ' has-error' : '' }}>Product:</label>
						</div>
						<div class="col-md-12">
							<select  name="product_id" class="form-control">
								@foreach($products as $product)
								<option value="{{ $product['id'] }}"
									@if($product['id']==Session::get('product_id'))
									selected="selected"
									@endif>
									{{$product['name']}}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-primary btn-xs">Submit</button>
					</div>
				</form>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Add Value</h3>
			</div>
			<form action="{{ url('admin/product/product/store-attribute-value') }}" method="post" role="form">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="value">Value</label>
						<input type="text" name="value" class="form-control" id="value" placeholder="Attribute Name" required="required">
					</div>
					<div class="form-group">
						<label for="product_attribute_id">Attribute</label>
						<select name="product_attribute_id" class="form-control" id="product_attribute_id">
							@foreach($productattributes as $productattribute)
							<option value="{{ $productattribute['id'] }}"
								@if($productattribute['id']==Session::get('product_attribute_id'))
								selected="selected"
								@endif>
								{{$productattribute['name']}}
							</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary btn-xs">Submit</button>
				</div>
			</form>
			
		</div>
		
	</div>
	<div class="col-md-3">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">{{$productdetails['name']}} Details</h3>
			</div>
			<div class="box-body">
				@foreach($productdetails['images'] as $image)
				<div class="col-md-4">
					<a href="{{url('admin/product/product/delete-image/'.$image['id'])}}" data-toggle="tooltip" title="Delete imgae" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash-o"></i></a>
					<img src="{{asset($image['name'])}}" class="img-responsive thumbnail" alt="product image">
					
				</div>
				@endforeach
				<table class="table table-hover">
					<tr>
						<th>Attribute</th>
						<th>Value</th>
					</tr>
					@foreach($productdetails['attributes'] as $attribute)
					<tr>
						<td>{{$attribute['name']}}</td>
						<td>
							@foreach($productdetails['attributevalues'] as $value)
							@if($value['product_attribute_id']==$attribute['id'])
							{{$value['value']}},
							@endif
							@endforeach
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Product Attribute Value</h3>
			</div>
			<div class="box-body">
				<table class="table table-hover">
					<tr>
						<th>Attribute</th>
						<th>Value</th>
						<th>Action</th>
					</tr>
					
					@foreach($productattributes as $productattribute)
					<tr>
						<td>
							<a href="{{url('admin/product/product/pushattribute/'.$productattribute['id'])}}"
								@if(Session::get('product_attribute_id')==$productattribute['id'])
								class="btn  btn-success btn-xs"
								@else
								class="btn  btn-default btn-xs"
								@endif
								>
								{{$productattribute['name']}}
							</a>
						</td>
						<td>
							@foreach($attributevalues as $attributevalue)
							@if($attributevalue['product_attribute_id']==$productattribute['id'])
							{{$attributevalue['value']}}
							<a href="{{url('admin/product/product/delete-attribute-value/'.$attributevalue['id'])}}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Attribute Value"><i class="fa fa-fw fa-trash-o"></i></a>
							@endif
							@endforeach
						</td>
						<td>
							<div class="btn-group">
								<a href="{{url('admin/product/product/edit-attribute/'.$productattribute['id'])}}" class="btn  btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
								<a href="{{url('admin/product/product/delete-attribute/'.$productattribute['id'])}}" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Attribute"><i class="fa fa-fw fa-trash-o"></i></a>
							</div>
						</td>
					</tr>
					@endforeach
					
				</table>
			</div>
		</div>
	</div>
</div>
@endsection