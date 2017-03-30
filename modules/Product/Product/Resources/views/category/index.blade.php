@extends('backend.layouts.app')
@section('title')
index
@endsection
@section('site_map')
category/index
@endsection
@section('content')
@include('product::layouts.nav')

<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">index</h3>
				<a href="{{url('admin/product/category/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
			</div>
			<div class="box-body">
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Parent</th>
							<th>Display Order</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categorys as $category)
						<tr>
							<td>
								<a href="{{asset($category['image'])}}" data-toggle="lightbox" >
	    							<img src="{{asset($category['image'])}}" height="50" width="50" class="img-fluid">
								</a>
							</td>
							<td>{{$category['name']}}</td>
							<td>{{$category['parent']}}</td>
							<td>{{$category['display_order']}}</td>
							<td>{{$category['status']}}</td>
							<td>
								<a href="{{url('admin/product/category/'.$category['id'].'/edit')}}" data-toggle="tooltip" title="Edit" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
								<a href="{{url('admin/product/category/delete/'.$category['id'])}}" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></a></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@include("product::category.category_tree")
</div>
@endsection