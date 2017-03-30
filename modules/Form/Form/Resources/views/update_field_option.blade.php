@extends('layouts.backend-master')
@section('menu')
Update Field
@stop
@section('content')
<div class="row">

  <div class="col-md-6">
    @include('form::layouts.form_nav')
    <h3>Create Option For fields And done</h3>
    <form  action="{{ url('form/store-option') }}" method="post">
    @if($field['type']!='text'&&$field['element_type'])
    <h4>Add options for {{$field['name']}}</h4>
    
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
        <?php $options = $formRepo->getOptionByFieldId($field['id']); ?>
        @foreach($options as $option)
          <tr>
            <td>{{$option['name']}}</td>
            <td>{{$option['value']}}</td>
            <td>{{$option['order']}}</td>
            <td>
              <a href="{{url('form/update-option/'.$option['id'])}}"  class="btn btn-primary btn-xs" >E</a>       
              <a href="{{url('form/delete-option/'.$option['id'])}}"  class="btn btn-danger btn-xs" >X</a>
            </td>
          </tr>
        @endforeach
        </tbody>       
      </table>

    <table class="table table-hover">
        <thead>
          <tr>
            
            <th>Name</th>
            <th>Value</th>
            <th>Order</th>
            <th>Action</th>
          </tr>
        </thead>
        
        {{csrf_field()}}
        
        <tbody id="mytablefield{{$field['name']}}">
          
          
          <div class="btn-group">
            <a id="add" onclick="myfunctionfield('<?php echo $field['name']; ?>','<?php echo $field['id']; ?>')" class="btn btn-primary btn-xs" >add Option</a>
            
          </div>
        </tbody>       
      </table>
  
    @endif 

    <input class="btn btn-success btn-xs" name="submit_btn" type="submit" value="Save">
    </form> 
  </div>
  
</div>

<script type="text/javascript">
  var mycount = 0;
function myfunctionfield(fieldname,fieldid){
  mycount = mycount+1;
 //alert('cliked');
var htmlelementoption='<tr>';
  
  htmlelementoption += '<td>';
    htmlelementoption += '<input type="text" name="name['+fieldid+'][]" class="form-control" id="name" placeholder="Enter name" required>';
  htmlelementoption += '</td>';

  htmlelementoption += '<td>';
    htmlelementoption += '<input type="text" name="value['+fieldid+'][]" class="form-control" id="name_key" placeholder="Enter value" required>';
  htmlelementoption += '</td>';

  htmlelementoption += '<td>';
    htmlelementoption += '<input type="number" name="order['+fieldid+'][]" class="form-control" id="name_key" placeholder="Enter order" required>';
  htmlelementoption += '</td>';

  htmlelementoption += '<td><a onclick="mycheckfield(event)" class="btn btn-danger btn-xs" >X</a></td>';
 
htmlelementoption += '</tr>';
$('#mytablefield'+fieldname).last().append($(htmlelementoption));
}

function mycheckfield(event){
  console.log($(event.target).parent().parent().remove());
}



</script>
@stop