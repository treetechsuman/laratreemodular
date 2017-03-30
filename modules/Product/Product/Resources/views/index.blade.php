@extends('backend.layouts.app')
@section('title')
	Product
@endsection
@section('site_map')
	Product
@endsection
@section('content')
@include('product::layouts.nav')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('product.name') !!}
    </p>
@stop
