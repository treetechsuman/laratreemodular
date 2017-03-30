@extends('layouts.backend-master')
@section('menu')
Update Field
@stop
@section('content')
<div class="row">
  
  <div class="col-md-12">
    
    <h3> Edit Fields in {{$form['title']}}</h3>
    <form  action="{{ url('form/update-field/'.$form['id']) }}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="form_id" value="{{$form['id']}}">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Field name</th>
            <th>Name Key</th>
            <!-- <th>Type</th>
            <th>element type</th> -->
            <th>validation</th>
            <th>Regex</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($formFields as $formField)
          <tr>
          <input type="hidden" name="field_id[]" value="{{$formField['id']}}">
          
          <td><input type="text" name="name[]" value="{{$formField['name']}}" class="form-control" id="name" placeholder="Enter name" required></td>
              <td><input type="text" name="name_key[]" value="{{$formField['name_key']}}" class="form-control" id="name_key" placeholder="Enter name_key" required></td>
              <!-- <td>
                <select class="form-control" name="type[]">
                  <option value="text" @if($formField['type']=='text') selected="selected" @endif>Text</option>
                  <option value="number" @if($formField['type']=='number') selected="selected" @endif>Number</option>
                  <option value="email" @if($formField['type']=='email') selected="selected" @endif>Email</option>
                  <option value="radio" @if($formField['type']=='radio') selected="selected" @endif>Radio</option>
                  <option value="checkbox" @if($formField['type']=='checkbox') selected="selected" @endif>Checkbox</option>
                  <option value="password" @if($formField['type']=='password') selected="selected" @endif>Password</option>
                </select>
              </td> -->
              <!-- <td>
                <select class="form-control" name="element_type[]" required>
                  <option value=""></option>
                  <option value="input" @if($formField['element_type']=='input') selected="selected" @endif>Input</option>
                  <option value="select" @if($formField['element_type']=='select') selected="selected" @endif>Select </option>
                  <option value="textarea" @if($formField['element_type']=='textarea') selected="selected" @endif>Textarea</option>
                </select>
              </td> -->
              <td>
                <select class="form-control" name="validation[]">
                  <option value="" @if($formField['validation']=='') selected="selected" @endif>no validation</option>
                  <option value="required" @if($formField['validation']=='required') selected="selected" @endif >Required</option>
                  <option value="email,required" @if($formField['validation']=='email,required') selected="selected" @endif>Email and required</option>
                </select>
              </td>
              <td><input type="text" name="regex[]" value="{{$formField['regex']}}" class="form-control" id="regex" placeholder="Enter regex"></td>
              <td>
            <div class="btn-group">
              <a href="{{url('form/delete-field/'.$formField['id'])}}" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Field"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
          </td>
          
          </tr>
        @endforeach
          <div class="btn-group">
            <input class="btn btn-success btn-xs" name="submit_btn" type="submit" value="Save">
          </div>
        </tbody>
        
      </table>
      </form>
    </form>
  </div>
  
  
</div>
@stop
