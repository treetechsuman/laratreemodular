<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title','treeShop')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('adminlte/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    <![endif]-->
    @yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('backend.layouts.top_nav')
    <!-- Left side column. contains the logo and sidebar -->
    @include('backend.layouts.side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('site_map')                
            </h1>
            @include('backend.layouts.message')
        </section>

        <!-- Main content -->
        <section class="content">
        
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@include('backend.layouts.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('adminlte/plugins/morris/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('adminlte/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('adminlte/plugins/knob/jquery.knob.js')}}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('adminlte/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

@yield('scripts')
<script type="text/javascript">
    $(".alert").delay(4000).slideUp(200, function() {
    $(this).alert('close');
});
</script>
</body>
</html>
