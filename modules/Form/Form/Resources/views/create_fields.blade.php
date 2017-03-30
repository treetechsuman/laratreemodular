@extends('layouts.backend-master')
@section('menu')
Add Form Field
@stop
<script
src="https://code.jquery.com/jquery-3.1.1.min.js"
integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>
@section('content')
<div class="row">
  <div class="col-md-12">
    @include('form::layouts.form_nav')
    <h4> Fields Already in {{$form['title']}}</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Field name</th>
            <th>Name Key</th>
            <th>Type</th>
            <th>element type</th>
            <th>validation</th>
            <th>Regex</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        @foreach($formFields as $formField)
          <tr>
          <td>{{$formField['name']}}</td>
          <td>{{$formField['name_key']}}</td>
          <td>{{$formField['type']}}</td>
          <td>{{$formField['element_type']}}</td>
          <td>{{$formField['validation']}}</td>
          <td>{{$formField['regex']}}</td>
          <td>
            <div class="btn-group">
              <a href="{{url('form/update-field-option/'.$formField['id'])}}" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="update option for this field"><span class="glyphicon glyphicon-edit"></span></a>
              <a href="{{url('form/delete-field/'.$formField['id'])}}" type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete Field"><span class="glyphicon glyphicon-remove"></span></a>
            </div>
          </td>
          </tr>
        @endforeach
        </tbody>
        
      </table>
    </form>
  </div>
  <div class="col-md-10">
    
    <h4> Insert Fields for {{$form['title']}} form</h4>
    <form  action="{{ url('form/store-field') }}" method="post">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Select</th>
            <th>Field name</th>
            <th>Name Key</th>
            <th>Type</th>
            <th>element type</th>
            <th>validation</th>
            <th>Regex</th>
          </tr>
        </thead>
        
        {{csrf_field()}}
        <input type="hidden" name="form_id" value="{{$form['id']}}">
        <tbody id="mytable">
          
          
          <div class="btn-group">
            <a id="add" onclick="myfunction()" class="btn btn-primary btn-xs" >add One Fields</a>
            <input class="btn btn-success btn-xs" name="submit_btn" disabled="disabled" type="submit" value="Save">
          </div>
        </tbody>
        
      </table>
    </form>
  </div>
  
  
</div>
@stop
<script type="text/javascript">
//$('#add').on('click',function(){
 /* <select class="form-control" id="sel1">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
  <input type="text" name="type[]" class="form-control" id="type" placeholder="Enter type">*/
  var mycount = 0;
function myfunction(){
  mycount = mycount+1;
//alert('cliked');
var htmlelement='<tr>';
  htmlelement += '<td><a onclick="mycheck(event)" class="btn btn-danger btn-xs" >X</a></td>';
  htmlelement += '<td>';
    htmlelement += '<input type="text" name="name[]" class="form-control" id="name" placeholder="Enter name" required>';
  htmlelement += '</td>';
  htmlelement += '<td>';
    htmlelement += '<input type="text" name="name_key[]" class="form-control" id="name_key" placeholder="Enter name_key" required>';
  htmlelement += '</td>';
  htmlelement += '<td>';
    htmlelement += '<select class="form-control"  name="type[]">';
    htmlelement += '<option value="text">Text</option>';
    htmlelement += '<option value="number">Number</option>';
    htmlelement += '<option value="email">Email</option>';
    htmlelement += '<option value="radio">Radio</option>';
    htmlelement += '<option value="checkbox">Checkbox</option>';
    htmlelement += '<option value="password">Password</option>';
    htmlelement += '</select>';
  htmlelement += '</td>';
  htmlelement += '<td>';
    htmlelement += '<select class="form-control" name="element_type[]" required>';
    htmlelement += '<option value=""></option>'; 
    htmlelement += '<option value="input">Input</option>';
    htmlelement += '<option value="select">Select </option>';
    htmlelement += '<option value="textarea">Textarea</option>';
    htmlelement += '</select>';
  htmlelement += '</td>';
  htmlelement += '<td>';
    
    htmlelement += '<select class="form-control" name="validation[]" required>';
    htmlelement += '<option value="">no validation</option>';
    htmlelement += '<option value="required">Required</option>';
    htmlelement += '<option value="email,required">Email and required</option>';
   
    htmlelement += '</select>';
  htmlelement += '</td>';
  htmlelement += '<td>';
    htmlelement += '<input type="text" name="regex[]" class="form-control" id="regex" placeholder="Enter regex">';
  htmlelement += '</td>';
htmlelement += '</tr>';
$('#mytable').last().append($(htmlelement));

$(':input[type="submit"]').prop('disabled', false);
}

function mycheck(event){
  //alert('this is done');
  //$(this).parent().parent().remove();
  console.log($(event.target).parent().parent().remove());
  mycount = mycount-1;
  if(mycount==0){
    $(':input[type="submit"]').prop('disabled', true);
  }
}

</script>

  
    
