@extends('backend.layouts.app')
@section('title')
Category
@endsection
@section('site_map')
Setting/Category
@endsection
@section('content')
<div class="row">
	
	<div class="col-md-3">
		
		<div class="box box-primary">
			<form action="{{ url('admin/category/create') }}" method="post" role="form">
				{{ csrf_field() }}
				<div class="box-body">
					<div class="form-group">
						<label for="name">Category Name</label>
						<input type="text" name="name" class="form-control" id="name" placeholder="Category Name">
					</div>
					<div class="form-group">
						<label for="parent_id">Parent Category</label>
						<select name="parent_id" class="form-control" id="parent_id">
							<option value="0">none</option>
							@foreach($categories as $category)
							<option value="{{ $category['id'] }}">{{$category['name']}}</option>
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
	<div class="col-md-6">
		<div class="box box-primary">
			{!!$categorytree!!}
		</div>
	</div>
</div>

@endsection