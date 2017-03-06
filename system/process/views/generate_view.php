<?php session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');

//echo MigrationFolderPath .'<br>';
//rtrim($string, ",")
//$_SESSION['repository']= $_POST['repository'];
$_SESSION['viewfolder']= $_POST['viewfolder'];
$views = $_POST['views'];
$controller = $_POST['controller'];

if (!file_exists(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']))) {
    mkdir(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']), 0777, true);
}
$variable = lcfirst(substr($controller, 0, -14));
foreach ($views as $view) {
		//mkdir(ViewFolderPath.'/'.lcfirst($_POST['viewfolder'].'/'.$view), 0777, true);
		$myfile = fopen(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']).'/'.$view.'.blade.php', "w") or die("Unable to open file!");
		$text ="@extends('backend.layouts.app')\n";
		$text .="@section('title')\n";
			$text .="\t".$view."\n";
		$text .="@endsection\n";
		$text .="@section('site_map')\n";
			$text .="\t".lcfirst($_POST['viewfolder']).'/'.$view."\n";
		$text .="@endsection\n";
		$text .="@section('content')\n";
			$text .="\t<div class=\"row\">\n";
				$text .="\t\t<div class=\"col-md-6\">\n";
					$text .="\t\t\t<div class=\"box box-primary\">\n";
						$text .="\t\t\t\t<div class=\"box-header with-border\">\n";
						$text .="\t\t\t\t\t<h3 class=\"box-title\">".$view."</h3>\n";
						$text .="\t\t\t\t\t<a href=\"{{url('admin/".$variable."/create')}}\" data-toggle=\"tooltip\" title=\"Create!\" class=\"btn btn-primary btn-xs pull-right\"><i class=\"glyphicon glyphicon-plus\"></i></a>\n";
						$text .="\t\t\t\t</div>\n";
						$text .="\t\t\t\t<div class=\"box-body\">\n";
						if($view=='index'){
							$text .= "\t\t\t\t\t<table class=\"table table-condensed table-hover\">\n";
								$text.= "\t\t\t\t\t\t<thead>\n\t\t\t\t\t\t\t<tr>\n";
									$text.= "\t\t\t\t\t\t\t\t<th>Id</th>\n";
									$text.= "\t\t\t\t\t\t\t\t<th>item</th>\n";
									$text.= "\t\t\t\t\t\t\t\t<th>Action</th>\n";
								$text.= "\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</thead>\n";
								$text.= "\t\t\t\t\t\t<tbody>\n";
								$text.="\t\t\t\t\t\t\t@foreach($".$variable."s as $".$variable.")\n";
								$text.="\t\t\t\t\t\t\t<tr>\n";
									$text.= "\t\t\t\t\t\t\t\t<td>{{\$" .$variable."['id']}}</td>\n";
									$text.= "\t\t\t\t\t\t\t\t<td>item1</td>\n";
									$text.= "\t\t\t\t\t\t\t\t<td>\n";
										$text.= "\t\t\t\t\t\t\t\t\t<a href=\"{{url('admin/".$variable."/'.$" .$variable."['id'].'/edit')}}\" data-toggle=\"tooltip\" title=\"Edit\" class=\"btn btn-info btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a>\n";
										$text.= "\t\t\t\t\t\t\t\t\t<a href=\"{{url('admin/".$variable."/delete/'.$" .$variable."['id'])}}\" data-toggle=\"tooltip\" title=\"Delete\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-remove\"></i></a></i></a>\n";

									$text.= "\t\t\t\t\t\t\t\t</td>\n";
								$text.= "\t\t\t\t\t\t\t</tr>\n";
								$text.="\t\t\t\t\t\t\t@endforeach\n";
								$text.="\t\t\t\t\t\t</tbody>\n";

							$text .= "\t\t\t\t\t</table>\n";
						}elseif($view=='create'){
							$text .= "\t\t\t\t\t<form role=\"form\" action=\"{{url('admin/".$variable."/store')}}\" method=\"post\" enctype=\"multipart/form-data\">\n";
							$text .= "\t\t\t\t\t\t{!! csrf_field() !!}\n";
							$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
							$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
							$text .= "\t\t\t\t\t\t\t\t<label for=\"name\" {{ $". "errors->has('name') ? ' has-error' : '' }}>Name:</label>\n";
							$text .= "\t\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
							$text .= "\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Enter Name\" name=\"name\" value=\"{{old('name')}}\" required>\n";
    					$text .= "\t\t\t\t\t\t\t\t@if ($"."errors->has('name'))\n";
    					$text .= "\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
    					$text .= "\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('name') }}</strong>\n";


    					$text .= "\t\t\t\t\t\t\t\t\t</span>\n";
    					$text .= "\t\t\t\t\t\t\t\t@endif\n";
    					$text .= "\t\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t\t<div class=\"box-footer\">\n";
							$text .= "\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary btn-flat btn-sm\">Submit</button>\n";
							$text .= "\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t</form>\n";
						}elseif($view=='edit'){
							$text .= "\t\t\t\t\t<form role=\"form\" action=\"{{url('admin/".$variable."/update/'.$" .$variable."['id'])}}\" method=\"post\" enctype=\"multipart/form-data\">\n";
							$text .= "\t\t\t\t\t\t{!! csrf_field() !!}\n";
							$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
							$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
							$text .= "\t\t\t\t\t\t\t\t<label for=\"name\" {{ $". "errors->has('name') ? ' has-error' : '' }}>Name:</label>\n";
							$text .= "\t\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
							$text .= "\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Enter Name\" name=\"name\" value=\"{{\$".$variable."['name']}}\" required>\n";
    					$text .= "\t\t\t\t\t\t\t\t@if ($"."errors->has('name'))\n";
    					$text .= "\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
    					$text .= "\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('name') }}</strong>\n";


    					$text .= "\t\t\t\t\t\t\t\t\t</span>\n";
    					$text .= "\t\t\t\t\t\t\t\t@endif\n";
    					$text .= "\t\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t\t<div class=\"box-footer\">\n";
							$text .= "\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary btn-flat btn-sm\">Submit</button>\n";
							$text .= "\t\t\t\t\t\t</div>\n";
							$text .= "\t\t\t\t\t</form>\n";

						}else{
							$text .= "\t\t\t\t\tthis is ".$view." \n";
						}
						$text .="\t\t\t\t</div>\n";
					$text .="\t\t\t</div>\n";
				$text .="\t\t</div>\n";
			$text .="\t</div>\n";
		$text .="@endsection\n";
		
		fwrite($myfile, $text);
}
if(file_exists(RouteFolderPath)&&isset($controller)){
	$myfile = fopen(RouteFolderPath.'/web.php', "a") or die("Unable to open file!");
	$controller_prefix = substr($controller, 0, -14);
	$text ="/*\n|--------------------------------------------------------------------------\n";
	$text .="| ".ucfirst($controller_prefix)." Routes\n";
	$text .="|--------------------------------------------------------------------------\n*/\n";
	fwrite($myfile, $text);
	$text = "Route::group(['prefix' => 'admin'], function() { \n";
	fwrite($myfile, $text);
		$text = "\tRoute::group(['prefix' => '".lcfirst($controller_prefix)."'], function() { \n";
		fwrite($myfile, $text);

			$text = "\t\tRoute::get('/','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@index');\n";
			$text .= "\t\tRoute::get('/create','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@create');\n";
			$text .= "\t\tRoute::post('/store','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@store');\n";
			$text .= "\t\tRoute::get('/{id}/edit','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@edit');\n";
			$text .= "\t\tRoute::get('/{id}','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@show');\n";
			$text .= "\t\tRoute::post('/update/{id}','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@update');\n";
			$text .= "\t\tRoute::get('/delete/{id}','".ucfirst($controller_prefix)."\\" .substr($controller, 0, -4). "@delete');\n";
			
			fwrite($myfile, $text);


		$text = "\t}); \n";
		fwrite($myfile, $text);
	$text = "}); \n";
	fwrite($myfile, $text);
}
//now add  menu--------------------------
	$myfile = fopen('../../../../resources/views/backend/layouts/generated_menu.blade.php', 'a'); 
	
	$text = "\n<li class=\"treeview\">\n";
	$text .= "\t<a href=\"{{url('admin/".lcfirst($controller_prefix)."')}}\">\n";
	$text .= "\t\t<i class=\"fa fa-dashboard\"></i> <span>".ucfirst($controller_prefix)."</span>\n";
	$text .= "\t</a>\n";
	$text .= "</li>\n";
	fwrite($myfile, $text); 

new Locate('../../../index.php?menu=views&action=create&success=yes&message=views is created ');
	
?>