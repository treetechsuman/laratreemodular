@extends('backend.layouts.app')
@section('title')
    Role & Permission Setup
@endsection
@section('site_map')
    Role & Permission Setup
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Permission</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" action="{{url('role-permission/permission/update/'.$permission['id'])}}" method="post" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="exampletextinput1" {{ $errors->has('name') ? ' has-error' : '' }}>Role Name:</label>
                                <input type="text" class="form-control" id="exampletextinput1"
                                placeholder="Enter Name" name="name" value="{{$permission['name']}}" required>
                                @if ($errors->has('name'))
                                <span class="help-block" style="color: #cc0000">
                                    <strong> * {{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary btn-flat btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection
