<?php //session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
require_once('../../../include/help_function.php');

//echo MigrationFolderPath .'<br>';
//rtrim($string, ",")
//$_SESSION['repository']= $_POST['repository'];
$_SESSION['viewfolder']= $_POST['viewfolder'];
$views = $_POST['views'];
$table_fields = $_POST['fields'];
$types = $_POST['types'];
$controller = $_POST['controller'];
$_SESSION['types'] = $types;
$_SESSION['controller']=$controller;
$table = $_SESSION['table'];

$controller_prefix = substr($controller, 0, -14);

/*$enumlists = enum_select( $table , 'address' );
 echo '<pre>';
 print_r($enumlists);
 echo '</pre>';*/
/*echo '<pre>';
 print_r($types);
echo '</pre>';*/

//create nav for module--------------
if (!file_exists('../../../../Modules/'.$_SESSION['module'].'/Resources/views/layouts/nav.blade.php')) {
    //mkdir(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']), 0777, true);
    $myfile = fopen('../../../../Modules/'.$_SESSION['module'].'/Resources/views/layouts/nav.blade.php', 'w');
    $text = "\t<div class=\"row\">\n";
    $text .= "\t\t<div class=\"col-md-6\">\n";
    $text .= "\t\t\t<div class=\"btn-group\">\n";
    $text .= "\t\t\t\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".lcfirst($controller_prefix)."')}}\" class=\"btn btn-default\">Home</a>\n";
    $text .= "\t\t\t\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".lcfirst($controller_prefix)."/export/data')}}\" class=\"btn btn-default\">Export</a>\n";
    $text .= "\t\t\t</div>\n";
    $text .= "\t\t</div>\n";
    $text .= "\t</div>\n";
    fwrite($myfile, $text);
}

if (!file_exists(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']))) {
    mkdir(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']), 0777, true);
}

$variable = lcfirst(substr($controller, 0, -14));
foreach ($views as $view) {
		//mkdir(ViewFolderPath.'/'.lcfirst($_POST['viewfolder'].'/'.$view), 0777, true);
		$myfile = fopen(ViewFolderPath.'/'.lcfirst($_POST['viewfolder']).'/'.$view.'.blade.php', "w") or die("Unable to open file!");
		//$text ="@extends('". lcfirst($_SESSION['module']) ."::layouts.master')\n";
		$text ="@extends('backend.layouts.app')\n";
		$text .="@section('title')\n";
			$text .="\t".$view."\n";
		$text .="@endsection\n";
		$text .="@section('site_map')\n";
			$text .="\t".lcfirst($_POST['viewfolder']).'/'.$view."\n";
		$text .="@endsection\n";
		$text .="@section('content')\n";
			$text .="\t@include('".lcfirst($_SESSION['module'])."::layouts.nav')\n";
			$text .="\t<div class=\"row\">\n";
				$text .="\t\t<div class=\"col-md-6\">\n";
					$text .="\t\t\t<div class=\"box box-primary\">\n";
						$text .="\t\t\t\t<div class=\"box-header with-border\">\n";
						$text .="\t\t\t\t\t<h3 class=\"box-title\">".ucfirst($variable).'::'.$view."</h3>\n";
						$text .="\t\t\t\t\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".$variable."/create')}}\" data-toggle=\"tooltip\" title=\"Create!\" class=\"btn btn-success btn-xs pull-right\"><i class=\"glyphicon glyphicon-plus\"></i>Add New</a>\n";
						$text .="\t\t\t\t</div>\n";
						$text .="\t\t\t\t<div class=\"box-body\">\n";
						if($view=='index'){
							$text .= "\t\t\t\t\t<table class=\"table table-condensed table-hover\">\n";
								$text.= "\t\t\t\t\t\t<thead>\n\t\t\t\t\t\t\t<tr>\n";
								fwrite($myfile, $text);
								foreach ($table_fields as $field) {
									$text= "\t\t\t\t\t\t\t\t<th>" . ucfirst($field) ."</th>\n";
									fwrite($myfile, $text);								
								}
									$text= "\t\t\t\t\t\t\t\t<th>Action</th>\n";
								$text.= "\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t</thead>\n";
								$text.= "\t\t\t\t\t\t<tbody>\n";
								$text.="\t\t\t\t\t\t\t@foreach($".$variable."s as $".$variable.")\n";
								$text.="\t\t\t\t\t\t\t<tr>\n";
									fwrite($myfile, $text);
									foreach ($table_fields as $field) {
										if($field=='image'){
											$text= "\t\t\t\t\t\t\t\t<td>\n";
												$text.= "\t\t\t\t\t\t\t\t\t<a href=\"{{ asset(\$" .$variable."['" . $field ."'])}}\" data-toggle=\"lightbox\">\n";
													$text.= "\t\t\t\t\t\t\t\t\t\t<img src=\"{{ asset(\$" .$variable."['" . $field ."'])}}\" height=\"50\" width=\"50\" class=\"img-fluid img-thumbnail\" >\n";
												$text.= "\t\t\t\t\t\t\t\t\t</a>\n";
											$text.= "\t\t\t\t\t\t\t\t</td>\n";
											//$text= "\t\t\t\t\t\t\t\t<td><img src=\"{{ asset(\$" .$variable."['" . $field ."'])}}\" ></td>\n";
										}else{
											$text= "\t\t\t\t\t\t\t\t<td>{{\$" .$variable."['" . $field ."']}}</td>\n";
										}
										
										fwrite($myfile, $text);								
									}
									//$text.= "\t\t\t\t\t\t\t\t<td>{{\$" .$variable."['id']}}</td>\n";
									
									$text= "\t\t\t\t\t\t\t\t<td>\n";
										$text.= "\t\t\t\t\t\t\t\t\t<div class=\"btn-group\">\n";
										$text.= "\t\t\t\t\t\t\t\t\t\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".$variable."/'.$" .$variable."['id'].'/edit')}}\" data-toggle=\"tooltip\" title=\"Edit\" class=\"btn btn-info btn-xs\"><i class=\"glyphicon glyphicon-edit\"></i></a>\n";
										$text.= "\t\t\t\t\t\t\t\t\t\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".$variable."/soft-delete/'.$" .$variable."['id'])}}\" data-toggle=\"tooltip\" title=\"Soft Delete\" class=\"btn btn-warning btn-xs\"><i class=\"glyphicon glyphicon-remove\"></i></a>\n";
										$text.= "\t\t\t\t\t\t\t\t\t\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".$variable."/delete/'.$" .$variable."['id'])}}\" data-toggle=\"tooltip\" title=\"Delete\" class=\"btn btn-danger btn-xs\"><i class=\"glyphicon glyphicon-remove\"></i></a>\n";
										$text.= "\t\t\t\t\t\t\t\t\t</div>\n";

									$text.= "\t\t\t\t\t\t\t\t</td>\n";
								$text.= "\t\t\t\t\t\t\t</tr>\n";
								$text.="\t\t\t\t\t\t\t@endforeach\n";
								$text.="\t\t\t\t\t\t</tbody>\n";

							$text .= "\t\t\t\t\t</table>\n";
							$text .= "\t\t\t\t\t{"."{"."$".$variable."s"."->"."links()}"."}\n";

							fwrite($myfile, $text);
						}elseif($view=='create'){
						/*
						-----------------------------------------------------------------------------------------
						create
						-----------------------------------------------------------------------------------------	
						 */	
							$text .= "\t\t\t\t\t<form role=\"form\" class=\"form-horizontal\" action=\"{{url('admin/".lcfirst($_SESSION['module'])."/".$variable."/store')}}\" method=\"post\" enctype=\"multipart/form-data\">\n";
							$text .= "\t\t\t\t\t\t{!! csrf_field() !!}\n";
							fwrite($myfile, $text);
									foreach ($table_fields as $field) {
									
										foreach($types as $key=>$value){
											//echo  'Field :' . $field. '  key: '  . $key . '<br> ';
											if($field == $key){	
												if($value == 'select'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														 $text .= "\t\t\t\t\t\t\t\t<select name=\"" . $field ."\" class=\"form-control\">\n";
														 //----------------enum---------------------------
														 fwrite($myfile, $text);
														 $enumlists = enum_select( $table , $field );
														 if(count($enumlists)>0){
															 foreach ($enumlists as $enumlist) {
															 	$text = "\t\t\t\t\t\t\t\t\t<option value=\"" . $enumlist ."\" @if(old('" . $field ."')=='" . $enumlist ."') selected=\"selected\" @endif >" . $enumlist ."</option>\n";

																fwrite($myfile, $text);
															 }
														 }else{
															$text = "\t\t\t\t\t\t\t\t\t<option value=\"Active\" @if(old('" . $field ."')=='Active') selected=\"selected\" @endif >Active</option>\n";

															fwrite($myfile, $text);
														}
														//----------------enum end---------------------------	
														$text = "\t\t\t\t\t\t\t\t</select>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
															fwrite($myfile, $text);
												}elseif($value == 'radio'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														//----------------enum---------------------------
														 fwrite($myfile, $text);
														 $enumlists = enum_select( $table , $field );
														 if(count($enumlists)>0){
															 foreach ($enumlists as $enumlist) {
															 	$text = "\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"" . $enumlist ."\" @if(old('" . $field ."')=='" . $enumlist ."') checked=\"checked\" @endif  >" . $enumlist ."</lable>\n";

																fwrite($myfile, $text);
															 }
														 }else{
															$text .= "\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"Male\" @if(old('" . $field ."')=='Male') checked=\"checked\" @endif  >Male</lable>\n";

															fwrite($myfile, $text);
														}
														//----------------enum end---------------------------
														 
								    					$text = "\t\t\t\t\t\t\t\t@if ($"."errors->has('" . $field ."'))\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
							    						$text .= "\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('" . $field ."') }}</strong>\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t</span>\n";
								    					$text .= "\t\t\t\t\t\t\t\t@endif\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);
												}elseif($value == 'checkbox'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
													$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														$text .= "\t\t\t\t\t\t\t\t<div class=\"checkbox\">\n";
														//----------------enum---------------------------
														 fwrite($myfile, $text);
														 $enumlists = enum_select( $table , $field );
														 if(count($enumlists)>0){
															 foreach ($enumlists as $enumlist) {
															 	$text = "\t\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"" . $enumlist ."\" >" . $enumlist ."</lable>\n";

																fwrite($myfile, $text);
															 }
														 }else{
															$text = "\t\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"Yes\" >Yes</lable>\n";

															fwrite($myfile, $text);
														}
														//----------------enum end---------------------------
								    					$text = "\t\t\t\t\t\t\t\t\t@if ($"."errors->has('" . $field ."'))\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
							    						$text .= "\t\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('" . $field ."') }}</strong>\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t\t</span>\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t@endif\n";
														$text .= "\t\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);

												}elseif($value == 'textarea'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														
														 $text .= "\t\t\t\t\t\t\t\t<textarea class=\"textarea\" name=\"" . $field ."\" placeholder=\"Place some text here\" style=\"width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;\">\n";
														 $text .="\t\t\t\t\t\t\t\t\t{{ old('" . $field ."') }}\n";
															$text .= "\t\t\t\t\t\t\t\t</textarea>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);
												}else{
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
															$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														$text .= "\t\t\t\t\t\t\t\t<input type=\"". $value ."\" class=\"form-control\" id=\"" . $field ."\" placeholder=\"Enter " . $field ."\" name=\"" . $field ."\" value=\"{{ old('" . $field ."') }}\" required>\n";
								    					$text .= "\t\t\t\t\t\t\t\t@if ($"."errors->has('" . $field ."'))\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
							    						$text .= "\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('" . $field ."') }}</strong>\n";


								    					$text .= "\t\t\t\t\t\t\t\t\t</span>\n";
								    					$text .= "\t\t\t\t\t\t\t\t@endif\n";
								    					$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);
													}//edd of else
													}
											}// end of types loop
									}//end field loop
									//form close
									$text = "\t\t\t\t\t\t<div class=\"box-footer\">\n";
									$text .= "\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary btn-flat btn-sm\">Submit</button>\n";
								$text .= "\t\t\t\t\t\t</div>\n";
								$text .= "\t\t\t\t\t</form>\n";
								fwrite($myfile, $text);		
						}elseif($view == 'edit'){
							/*
						-----------------------------------------------------------------------------------------
						edit
						-----------------------------------------------------------------------------------------	
						 */
							$text .= "\t\t\t\t\t<form role=\"form\" class=\"form-horizontal\" action=\"{{url('admin/".lcfirst($_SESSION['module'])."/".$variable."/update/'.$" .$variable."['id'])}}\" method=\"post\" enctype=\"multipart/form-data\">\n";
							$text .= "\t\t\t\t\t\t{!! csrf_field() !!}\n";
							fwrite($myfile, $text);
									foreach ($table_fields as $field) {
									
										foreach($types as $key=>$value){
											//echo  'Field :' . $field. '  key: '  . $key . '<br> ';
											if($field == $key){	
												if($value == 'select'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														 $text .= "\t\t\t\t\t\t\t\t<select name=\"" . $field ."\" class=\"form-control\">\n";
														 //----------------enum---------------------------
														 fwrite($myfile, $text);
														 $enumlists = enum_select( $table , $field );
														 if(count($enumlists)>0){
															 foreach ($enumlists as $enumlist) {
															 	$text = "\t\t\t\t\t\t\t\t\t<option value=\"" . $enumlist ."\" @if(\$".$variable."['" . $field ."']=='" . $enumlist ."') selected=\"selected\" @endif >" . $enumlist ."</option>\n";

																fwrite($myfile, $text);
															 }
														 }else{
															$text = "\t\t\t\t\t\t\t\t\t<option value=\"Active\" @if(\$".$variable."['" . $field ."']=='Active') selected=\"selected\" @endif >Active</option>\n";

															fwrite($myfile, $text);
														}
														$text = "\t\t\t\t\t\t\t\t</select>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
															fwrite($myfile, $text);
												}elseif($value == 'radio'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														//----------------enum---------------------------
														 fwrite($myfile, $text);
														 $enumlists = enum_select( $table , $field );
														 if(count($enumlists)>0){
															 foreach ($enumlists as $enumlist) {
															 	$text = "\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"" . $enumlist ."\" @if(\$".$variable."['" . $field ."']=='" . $enumlist ."') checked=\"checked\" @endif  >" . $enumlist ."</lable>\n";

																fwrite($myfile, $text);
															 }
														 }else{
															$text .= "\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"Male\" @if(\$".$variable."['" . $field ."']=='Male') checked=\"checked\" @endif  >Male</lable>\n";

															fwrite($myfile, $text);
														}
														//----------------enum end---------------------------
												
								    					$text = "\t\t\t\t\t\t\t\t@if ($"."errors->has('" . $field ."'))\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
							    						$text .= "\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('" . $field ."') }}</strong>\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t</span>\n";
								    					$text .= "\t\t\t\t\t\t\t\t@endif\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);
												}elseif($value == 'checkbox'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														$text .= "\t\t\t\t\t\t\t\t<div class=\"checkbox\">\n";
														//----------------enum---------------------------
														 fwrite($myfile, $text);
														 $enumlists = enum_select( $table , $field );
														 if(count($enumlists)>0){
															 foreach ($enumlists as $enumlist) {
															 	
															 	$text = "\t\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"{{ \$".$variable."['" . $field ."'] }}\" @if(\$".$variable."['" . $field ."']=='" . $enumlist ."') checked=\"checked\" @endif >" . $enumlist ."</lable>\n";

																fwrite($myfile, $text);
															 }
														 }else{
															$text = "\t\t\t\t\t\t\t\t\t<label><input type=\"". $value ."\" id=\"" . $field ."\"  name=\"" . $field ."\" value=\"{{ \$".$variable."['" . $field ."'] }}\" @if(\$".$variable."['" . $field ."']=='Yes') checked=\"checked\" @endif >Yes</lable>\n";

															fwrite($myfile, $text);
														}
														//----------------enum end---------------------------
														 
								    					$text = "\t\t\t\t\t\t\t\t\t@if ($"."errors->has('" . $field ."'))\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
							    						$text .= "\t\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('" . $field ."') }}</strong>\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t\t</span>\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t@endif\n";
														$text .= "\t\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);

												}elseif($value == 'textarea'){
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														
														 $text .= "\t\t\t\t\t\t\t\t<textarea class=\"textarea\" name=\"" . $field ."\" placeholder=\"Place some text here\" style=\"width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;\">\n";
														 $text .="\t\t\t\t\t\t\t\t\t{{ \$".$variable."['" . $field ."'] }}\n";
															$text .= "\t\t\t\t\t\t\t\t</textarea>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);
												}else{
														if($value == 'file'){
															$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
															$text .= "\t\t\t\t\t\t\t\t\t\t\t old" . $field ." \n";
															$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
															$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														 	$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
																$text .= "\t\t\t\t\t\t\t\t<label for=\"image\" {{ $" . "errors->has('image') ? ' has-error' : '' }}>Image:</label>\n";
															$text .= "\t\t\t\t\t\t\t</div>\n";
															$text .= "\t\t\t\t\t\t<div class=\"col-md-9\">\n";
																$text .= "\t\t\t\t\t\t\t<img src=\"{{ asset(\$".$variable."['" . $field ."']) }}\" class=\"img-responsive\" >\n";
															$text .= "\t\t\t\t\t\t\t</div>\n";
														 	
														 	$text .= "\t\t\t\t\t\t</div>\n";
															fwrite($myfile, $text);
														}
														$text = "\t\t\t\t\t\t<!-- _______________________________________________\n";
														$text .= "\t\t\t\t\t\t\t\t\t\t\t " . $field ." \n";
														$text .= "\t\t\t\t\t\t _______________________________________________ -->\n";
														$text .= "\t\t\t\t\t\t<div class=\"form-group\">\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-3\">\n";
														$text .= "\t\t\t\t\t\t\t\t<label for=\"" . $field ."\" {{ $". "errors->has('" . $field ."') ? ' has-error' : '' }}>" . ucfirst($field)  .":</label>\n";
														$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t\t<div class=\"col-md-9\">\n";
														if($value == 'file'){
															$text .= "\t\t\t\t\t\t\t\t<input type=\"". $value ."\" class=\"form-control\" id=\"" . $field ."\" placeholder=\"Enter " . $field ."\" name=\"" . $field ."\" value=\"{{ \$".$variable."['" . $field ."'] }}\" >\n";
														}else{
															$text .= "\t\t\t\t\t\t\t\t<input type=\"". $value ."\" class=\"form-control\" id=\"" . $field ."\" placeholder=\"Enter " . $field ."\" name=\"" . $field ."\" value=\"{{ \$".$variable."['" . $field ."'] }}\" required>\n";
													 }
								    					$text .= "\t\t\t\t\t\t\t\t@if ($"."errors->has('" . $field ."'))\n";
								    					$text .= "\t\t\t\t\t\t\t\t\t<span class=\"help-block\" style=\"color: #cc0000\">\n";
							    						$text .= "\t\t\t\t\t\t\t\t\t\t<strong> * {{ $"."errors->first('" . $field ."') }}</strong>\n";


								    					$text .= "\t\t\t\t\t\t\t\t\t</span>\n";
								    					$text .= "\t\t\t\t\t\t\t\t@endif\n";
								    					$text .= "\t\t\t\t\t\t\t</div>\n";
														$text .= "\t\t\t\t\t\t</div>\n";
														fwrite($myfile, $text);
													}//edd of else
													}
											}// end of types loop
									}//end field loop
									//form close
									
									$text = "\t\t\t\t\t\t<div class=\"box-footer\">\n";
									$text .= "\t\t\t\t\t\t\t<button type=\"submit\" class=\"btn btn-primary btn-flat btn-sm\">Submit</button>\n";
								$text .= "\t\t\t\t\t\t</div>\n";
								$text .= "\t\t\t\t\t</form>\n";
								fwrite($myfile, $text);

						}else{
							fwrite($myfile, $text);
							$text = "\t\t\t\t\tthis is ".$view." \n";
							fwrite($myfile, $text);
						}
						$text ="\t\t\t\t</div>\n";
					$text .="\t\t\t</div>\n";
				$text .="\t\t</div>\n";
			$text .="\t</div>\n";
		$text .="@endsection\n";
		
		fwrite($myfile, $text);
}
//generate routes----------------------------------------------------------------
if($_POST['add_route']=='yes'){
if(file_exists(RouteFolderPath)&&isset($controller)){
	$myfile = fopen(RouteFolderPath.'/routes.php', "a") or die("Unable to open file!");
	$controller_prefix = substr($controller, 0, -14);
	$text ="/*\n|--------------------------------------------------------------------------\n";
	$text .="| ".ucfirst($controller_prefix)." Routes\n";
	$text .="|--------------------------------------------------------------------------\n*/\n";
	fwrite($myfile, $text);
	$text = "Route::group(['middleware' => 'web','prefix' => 'admin/".lcfirst($_SESSION['module'])."','namespace' => 'Modules\\" . $_SESSION['module'] . "\Http\Controllers'], function() { \n";
	fwrite($myfile, $text);
		$text = "\tRoute::group(['prefix' => '".lcfirst($controller_prefix)."'], function() { \n";
		fwrite($myfile, $text);

			$text = "\t\tRoute::get('/','".substr($controller, 0, -4). "@index');\n";
			$text .= "\t\tRoute::get('/create','".substr($controller, 0, -4). "@create');\n";
			$text .= "\t\tRoute::post('/store','".substr($controller, 0, -4). "@store');\n";
			$text .= "\t\tRoute::get('/{id}/edit','".substr($controller, 0, -4). "@edit');\n";
			$text .= "\t\tRoute::get('/{id}','".substr($controller, 0, -4). "@show');\n";
			$text .= "\t\tRoute::post('/update/{id}','".substr($controller, 0, -4). "@update');\n";
			$text .= "\t\tRoute::get('/delete/{id}','".substr($controller, 0, -4). "@delete');\n";
			$text .= "\t\tRoute::get('/soft-delete/{id}','".substr($controller, 0, -4). "@softDelete');\n";
			$text .= "\t\tRoute::get('/export/data','".substr($controller, 0, -4). "@export');\n";
			fwrite($myfile, $text);


		$text = "\t}); \n";
		fwrite($myfile, $text);
	$text = "}); \n";
	fwrite($myfile, $text);
}
}
//now add  menu--------------------------
if($_POST['add_in_side_nav']=='yes'){
	$myfile = fopen('../../../../resources/views/backend/layouts/generated_menu.blade.php', 'a'); 
	
	$text = "\n<li class=\"treeview\">\n";
	$text .= "\t<a href=\"{{url('admin/".lcfirst($_SESSION['module'])."/".lcfirst($controller_prefix)."')}}\">\n";
	$text .= "\t\t<i class=\"fa fa-dashboard\"></i> <span>".ucfirst($controller_prefix)."</span>\n";
	$text .= "\t</a>\n";
	$text .= "</li>\n";
	fwrite($myfile, $text); 
}
new Locate('../../../index.php?menu=views&action=create&success=yes&message=views is created ');
	


	
?>