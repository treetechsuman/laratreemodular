@extends('backend.layouts.app')
@section('title')
	show
@endsection
@section('site_map')
	user/show
@endsection
@section('content')
	@include('user::layouts.nav')
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">show</h3>
					<a href="{{url('admin/user/user/create')}}" data-toggle="tooltip" title="Create!" class="btn btn-primary btn-xs pull-right"><i class="glyphicon glyphicon-plus"></i></a>
				</div>
				<div class="box-body">
					this is show 
				</div>
			</div>
		</div>
	</div>
@endsection
