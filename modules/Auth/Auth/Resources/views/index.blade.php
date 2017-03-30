@extends('layouts.backend-master')
@section('menu')
Auth 
@stop
@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('auth.name') !!}
    </p>
@stop
