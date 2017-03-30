@extends('auth::layouts.master')
@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form action="{{url('auth/send-verification-email')}}" method="post" class="form-inline">
		{{csrf_field()}}
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" name="email" value="{{$user['email']}}"class="form-control" id="email" required>
			</div>
			<button type="submit" class="btn btn-success">Send me verification link</button>
		</form>
	</div>
</div>
@stop