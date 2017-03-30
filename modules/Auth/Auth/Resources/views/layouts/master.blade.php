<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Auth</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{url('auth/home')}}">SocialAves Auth Module</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="{{url('auth/home')}}">Home</a></li>
          <li><a href="{{url('email/')}}">Email</a></li>
          <li><a href="{{url('contact/')}}">Contact</a></li>
          <li><a href="{{url('sms/')}}">Sms</a></li>
          <li><a href="{{url('form/')}}">Form</a></li>
        </ul>
          <ul class="nav navbar-nav navbar-right">
            
            @if(Auth::check())
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user">{{ucfirst($user['name'])}}
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{url('auth/profile')}}">Profile</a></li>
                  <li><a href="{{url('auth/setting')}}">Setting</a></li>
                </ul>
              </li>
              <li><a href="{{url('auth/logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
              @else
              <li><a href="{{url('auth/register')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li><a href="{{url('auth/login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              @endif
            </ul>
          </div>
        </nav>
        <div class="container">
          @if(Session::has('success'))
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Success!</strong> {{Session::get('success')}}.
          </div>
          @endif
          @if(Session::has('error'))
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Error!</strong> {{Session::get('error')}}.
          </div>
          @endif
          @yield('content')
          
        </div>
      </body>
    </html>