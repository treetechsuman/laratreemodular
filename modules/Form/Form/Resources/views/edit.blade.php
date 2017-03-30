@extends('layouts.backend-master')
@section('menu')
Edit Form
@stop
@section('content')
<div class="row">
  
  <div class="col-md-6">
  <h3>Update form</h3>
    <form class="form-horizontal" action="{{url('form/update/'.$form['id'])}}" method="post">
    {{csrf_field()}}
      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="title">Form Title:</label>
        <div class="col-sm-8">
          <input type="text" name="title" value="{{$form['title']}}" class="form-control" id="title" placeholder="Enter title" required="">
          @if ($errors->has('title'))
              <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('slag') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="slag">Form Slag:</label>
        <div class="col-sm-8">
          <input type="text" name="slag" value="{{$form['slag']}}" class="form-control" id="slag" placeholder="Enter slag" required="">
          @if ($errors->has('slag'))
              <span class="help-block">
                  <strong>{{ $errors->first('slag') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('submit_url') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="submit_url">Submit Url:</label>
        <div class="col-sm-8">
          <input type="text" name="submit_url" value="{{$form['submit_url']}}" class="form-control" id="submit_url" placeholder="Enter submit_url" required="">
          @if ($errors->has('submit_url'))
              <span class="help-block">
                  <strong>{{ $errors->first('submit_url') }}</strong>
              </span>
          @endif

        </div>
      </div>
      <div class="form-group{{ $errors->has('version') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="version">Version:</label>
        <div class="col-sm-8">
          <input type="number" name="version" value="{{$form['version']}}" class="form-control" id="version" placeholder="Enter version" required="">
          @if ($errors->has('version'))
              <span class="help-block">
                  <strong>{{ $errors->first('version') }}</strong>
              </span>
          @endif

        </div>
      </div>
      <div class="form-group{{ $errors->has('query_params') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="query_params">Form query_params:</label>
        <div class="col-sm-8">
          <input type="text" name="query_params" value="{{$form['query_params']}}" class="form-control" id="query_params" placeholder="Enter query_params">
          @if ($errors->has('query_params'))
              <span class="help-block">
                  <strong>{{ $errors->first('query_params') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="email">Email:</label>
        <div class="col-sm-8">
          <div class="radio">
            <label><input type="radio" name="email" value="1">Yes</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="email" checked="checked">No</label>
          </div>
        </div>
      </div>
      <div class="form-group{{ $errors->has('email_template_name') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="email_template_name">Email template name:</label>
        <div class="col-sm-8">
          <input type="text" name="email_template_name" value="{{$form['email_template_name']}}" class="form-control" id="email_template_name" placeholder="Enter email_template_name" required="">
          @if ($errors->has('email_template_name'))
              <span class="help-block">
                  <strong>{{ $errors->first('email_template_name') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-4" for="auto_responder">Form Auto responder:</label>
        <div class="col-sm-8">
          <div class="radio">
            <label><input type="radio" name="auto_responder" value="1">Yes</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="auto_responder" checked="checked">No</label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-sm-4" for="notification">Notification:</label>
        <div class="col-sm-8">
          <div class="radio">
            <label><input type="radio" name="notification" value="1">Yes</label>
          </div>
          <div class="radio">
            <label><input type="radio" name="notification" checked="checked">No</label>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>
  </div>
  
</div>
@stop