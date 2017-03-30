@extends('layouts.backend-master')
@section('menu')
Update Option
@stop
@section('content')
<div class="row">
  <div class="col-md-6">
    @include('form::layouts.form_nav')
    <h3>Create Option For fields And done</h3>
    <form  action="{{ url('form/update-option/'.$option['id']) }}" method="post">
    {{csrf_field()}}
    
    <h4>Update Option</h4>
    
    <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Value</th>
            <th>Order</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="name" class="form-control" value=" {{$option['name']}}" required="required"></td>
            <td><input type="text" name="value" class="form-control" value=" {{$option['value']}}" required="required"></td>
            <td><input type="number" name="order" class="form-control" value="{{$option['order']}}" required="required"></td>
            <td>       
              <a  class="btn btn-danger btn-xs" >X</a>
            </td>
          </tr>
        </tbody>       
      </table>
    <input class="btn btn-success btn-xs" name="submit_btn" type="submit" value="Save">
    </form> 
  </div>
  
</div>


@stop