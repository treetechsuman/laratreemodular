@extends('layouts.backend-master')
@section('menu')
Privious Form
@stop
@section('content')
<div class="row">
  
  <div class="col-md-6">
    <h3>Preview of {{$form['title']}}</h3>
    <form  action="{!!$form['submit_url']!!}" method="post">
      {{csrf_field()}}
      <input type="hidden" name="form_id" value="{{$form['id']}}">
      <input type="hidden" name="version" value="{{$form['version']}}">
      @foreach($formFields as $formField)
        @if($formField['element_type'])
          @if($formField['type']=='text' &&$formField['element_type']=='input')
          <div class="form-group">
            <label for="{{$formField['name_key']}}">{{$formField['name']}}</label>
            <input type="{{$formField['type']}}" name="{{$formField['name_key']}}" class="form-control" id="{{$formField['name_key']}}"  placeholder="Enter {{$formField['name']}}" {{$formField['validation']}}>
          </div>
          @endif

          @if($formField['type']=='email' &&$formField['element_type']=='input' )
          <div class="form-group">
            <label for="{{$formField['name_key']}}">{{$formField['name']}}</label>
            <input type="{{$formField['type']}}" name="{{$formField['name_key']}}" class="form-control" id="{{$formField['name_key']}}" aria-describedby="emailHelp" placeholder="Enter email" {{$formField['validation']}}>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          @endif

          @if($formField['type']=='password' &&$formField['element_type']=='input' )
          <div class="form-group">
            <label for="{{$formField['name_key']}}">{{$formField['name']}}</label>
            <input type="{{$formField['type']}}" name="{{$formField['name_key']}}" class="form-control" id="{{$formField['name_key']}}" aria-describedby="emailHelp" placeholder="Enter Password" {{$formField['validation']}}>
            
          </div>
          @endif

          @if($formField['type']=='number' &&$formField['element_type']=='input' )
          <div class="form-group">
            <label for="{{$formField['name_key']}}">{{$formField['name']}}</label>
            <input type="{{$formField['type']}}" name="{{$formField['name_key']}}" class="form-control" id="{{$formField['name_key']}}" aria-describedby="emailHelp" placeholder="Enter {{$formField['name']}}" {{$formField['validation']}}>
            
          </div>
          @endif

          @if($formField['type']=='checkbox' && $formField['element_type']=='input')
          <div class="form-check">
            <legend>{{$formField['name']}} Checkbox </legend>
            <?php $options = $formRepo->getOptionByFieldId($formField['id']); ?>
            @foreach($options as $option)
              <label class="form-check-label">
                <input type="{{$formField['type']}}" name = "{{$formField['name_key']}}[]" class="form-check-input" value="{{$option['value']}}">
                {{$option['name']}}
              </label>
            @endforeach
          </div>
          @endif

          @if($formField['type']=='radio'&&$formField['element_type']=='input')
          <fieldset class="form-group">
            <legend>{{$formField['name']}} Radio buttons</legend>
            <?php $options = $formRepo->getOptionByFieldId($formField['id']); ?>
            @foreach($options as $option)
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="{{$formField['name_key']}}" id="optionsRadios1" value="{{$option['value']}}" >
                {{$option['name']}}
              </label>
            </div>
            @endforeach          
          </fieldset>
          @endif
        @endif


      @if($formField['element_type']=='select')
        <div class="form-group">
        <legend>{{$formField['name']}} Select </legend>
          <label>{{$formField['name']}}</label>
          <select class="form-control" name="{{$formField['name_key']}}">
          <?php $options = $formRepo->getOptionByFieldId($formField['id']); ?>
          @foreach($options as $option)
            <option value="{{$option['value']}}" >{{$option['name']}}</option>
          @endforeach
          </select>
        </div>
      @endif


      @if($formField['element_type']=='textarea')
          <div class="form-group">
          <legend>{{$formField['name']}} Textarea </legend>
            <label for="exampleTextarea">{{$formField['name']}}</label>
            <textarea class="form-control" name="{{$formField['name_key']}}" id="exampleTextarea" rows="3"></textarea>
          </div>       
      @endif
      
      @endforeach
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" class="btn btn-success" value="submit">
        </div>
      </div>
    </form>
    
  </div>
  
</div>
@stop