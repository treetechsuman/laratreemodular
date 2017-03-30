@extends('backend.layouts.app')
@section('title')
Create User
@endsection
@section('site_map')
Create User
@endsection
@section('content')
<section class="content-header">
 <h1>

            <a href="{{url('admin/user/')}}" class="btn btn-primary btn-flat">Users</a>
                <a href="{{url('admin/user/role-permission')}}" class="btn btn-success btn-flat">Role Permission</a>



            <a href="{{url('admin/user')}}" data-toggle="tooltip" title="Create">
                <button type="button" class="btn btn-warning btn-flat  pull-right ">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>&nbsp;View Users
                </button>
            </a>
        </h1>
    </section>
 <section class="content">
				
        <form class="form-horizontal" method="post" action="{{url('admin/user/user/store')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
                    <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">New User Registration</h3>
                    <label style="margin-left: 40px">

                      (  Note&nbsp;:&nbsp;&nbsp;Field With  <span class=help-block" style="color: #b30000">&nbsp;* </span> is a Required .)
                    </label>
                </div>
                <div class="shadow">
                    <div class="row">
                        <div class="col-sm-2 col-md-6 col-lg-6">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <br>
                                <label for="name" class="col-sm-4 control-label">Full Name<span class=help-block" style="color: #b30000">&nbsp;* </span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter Your Full Name."  value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block" style="color: red">
                                        <strong> * {{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-4 control-label">
                                    Email<span class=help-block" style="color: #b30000">&nbsp;* </span></label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Enter Your Email Address."  value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block" style="color: red">
                                        <strong> * {{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('contact_no') ? ' has-error' : '' }}">
                                <label for="contact_no" class="col-sm-4 control-label">Contact No<span class=help-block" style="color: #b30000">&nbsp;* </span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="contact_no" name="contact_no"
                                           placeholder="Enter Your Contact Number." value="{{ old('contact_no') }}">
                                    @if ($errors->has('contact_no'))
                                        <span class="help-block" style="color: red">
                                        <strong> * {{ $errors->first('contact_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-sm-4 control-label">Gender <span class=help-block" style="color: #b30000">&nbsp;* </span></label>
                                <div class="col-sm-8">
                                    <select id="gender" name="gender" class="form-control">
                                        <option value=" ">
                                            Select Your Gender
                                        </option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                        <option value="2">Others</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="help-block" style="color: red">
                                        <strong> * {{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-sm-4 control-label">Address<span class=help-block" style="color: #b30000">&nbsp;* </span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="Enter Your Address."value="{{ old('address') }}">
                                    @if ($errors->has('address'))
                                        <span class="help-block" style="color: red">
                                        <strong> * {{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="pass1" class="col-sm-4 control-label">Password<span class=help-block"
                                                                                                style="color: #b30000">&nbsp;* </span></label>

                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="pass1"
                                           placeholder="Enter Password." name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass2" class="col-sm-4 control-label">Re-Password<span class=help-block"
                                                                                                   style="color: #b30000">&nbsp;* </span></label>

                                <div class="col-sm-8">
                                    <input type="password" class="form-control"
                                           placeholder="Re Type Initial Password." id="pass2" required
                                           onkeyup="checkPass(); return false;">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button type="submit" class="btn btn-success btn-flat" id="myBtn" disabled="disabled"
                                            onkeyup="checkPass()">Save
                                    </button>
                                    <button type="reset" class="btn btn-default btn-flat">Reset</button>
                                </div>
                            </div>


                        </div>


                        <div class="col-sm-5 col-md-6 col-lg-6">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-5">
                                    <br>
                                    <img src="{{URL::asset('adminlte/dist/img/avatar5.png')}}" class="thumbnail"
                                         alt="User Image" id="profile" height="215px" width="210px">

                                    <div class="form-group">
                                        &nbsp; &nbsp; &nbsp; &nbsp; <label for="inputfile">Browse Image <span
                                                    class=help-block" style="color: #b30000">&nbsp;* </span></label>

                                        <input type="file" class="form-control" id="inputfile" name="userimage_name"
                                               onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
</section>
@endsection