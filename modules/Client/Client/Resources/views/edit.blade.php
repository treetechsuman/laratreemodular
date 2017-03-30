@extends('layouts.backend-master')
@section('menu')
Update Client info
@stop
@section('content')
<div class="row">
  <div class="col-md-6">
    <form class="form-horizontal" action="{{url('client/update/'.$client['id'])}}" method="post">
    {{csrf_field()}}
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="name">Name:</label>
        <div class="col-sm-8">
          <input type="text" name="name" value="{{$client['name']}}" class="form-control" id="name" placeholder="Enter name" required="">
          @if ($errors->has('name'))
              <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="email">Email:</label>
        <div class="col-sm-8">
          <input type="text" name="email" value="{{$client['email']}}" class="form-control" id="email" placeholder="Enter email" required="">
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="password">Password:</label>
        <div class="col-sm-8">
          <input type="text" name="password" value="{{$client['password']}}" class="form-control" id="password" placeholder="Enter password" required="">
          @if ($errors->has('password'))
              <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif

        </div>
      </div>
      <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="mobile">Form mobile:</label>
        <div class="col-sm-8">
          <input type="number" name="mobile" value="{{$client['mobile']}}" class="form-control" id="mobile" placeholder="Enter mobile">
          @if ($errors->has('mobile'))
              <span class="help-block">
                  <strong>{{ $errors->first('mobile') }}</strong>
              </span>
          @endif

        </div>
      </div>
      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="address">Address:</label>
        <div class="col-sm-8">
          <input type="text" name="address" value="{{$client['address']}}" class="form-control" id="address" placeholder="Enter address">
          @if ($errors->has('address'))
              <span class="help-block">
                  <strong>{{ $errors->first('address') }}</strong>
              </span>
          @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('expire_on') ? ' has-error' : '' }}">
        <label class="control-label col-sm-4" for="expire_on">Expire:</label>
        <div class="col-sm-8">
          <input type="date" name="expire_on" value="{{$client['expire_on']}}" class="form-control" id="expire_on" placeholder="Enter expire_on">
          @if ($errors->has('expire_on'))
              <span class="help-block">
                  <strong>{{ $errors->first('expire_on') }}</strong>
              </span>
          @endif
        </div>
      </div>
     
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </div>
    </form>
  </div>
  
</div>

@stop