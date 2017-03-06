<?php session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
require_once('../../../include/help_function.php');

//---copy migration---------------------
//$source= '../../../laravel/component/user/migrations/';
//$destination ='../../../../database/migrations/';
//copyr($source, $destination); 

//---copy controller---------------------
$source= '../../../laravel/component/user/controller/';
$destination ='../../../../app/Http/Controllers/';
copyr($source, $destination); 

//---copy repository---------------------
$source= '../../../laravel/component/user/repository/';
$destination ='../../../../app/Repositories/';
copyr($source, $destination); 

//---copy views---------------------
$source= '../../../laravel/component/user/views/';
$destination ='../../../../resources/views/backend/';
copyr($source, $destination); 

//---copy model---------------------
$source= '../../../laravel/component/user/model/';
$destination ='../../../../app/Model/';
copyr($source, $destination); 

if(file_exists(RouteFolderPath)){
	$myfile = fopen(RouteFolderPath.'/web.php', "a") or die("Unable to open file!");
	$text ="/*\n|--------------------------------------------------------------------------\n";
	$text .="| User Routes\n";
	$text .="|--------------------------------------------------------------------------\n*/\n";
	fwrite($myfile, $text);
	$text = "Route::group(['prefix' => 'admin'], function() { \n";
	fwrite($myfile, $text);
		//for user------------------------------------
		$text = "\tRoute::group(['prefix' => 'user'],function(){\n";
		fwrite($myfile, $text);

		$text = "\t\tRoute::get('/','User\UserController@index');\n";
		$text .= "\t\tRoute::get('/create','User\UserController@create');\n";
		$text .= "\t\tRoute::post('/store','User\UserController@store');\n";
		$text .= "\t\tRoute::get('/{id}/edit','User\UserController@edit');\n";
		$text .= "\t\tRoute::get('/{id}','User\UserController@show');\n";
		$text .= "\t\tRoute::post('/update/{id}','User\UserController@update');\n";	
		$text .= "\t\tRoute::get('/delete/{id}','User\UserController@delete');\n";	
		$text .= "\t\tRoute::get('/profile/{id}','User\UserController@profile');\n";		
		fwrite($myfile, $text);

		$text = "\t});\n";
		fwrite($myfile, $text);

	$text = "}); \n";
	fwrite($myfile, $text);
}

	// delete last line from AppServiceProvider.php 
	$file  = file('../../../../app/Providers/AppServiceProvider.php'); 
	array_pop($file); 
	$fp    = fopen('../../../../app/Providers/AppServiceProvider.php','w'); 
	fwrite($fp, implode('',$file)); 
	fclose($fp);

	//now add function------------------------------------------------------
	$myfile = fopen('../../../../app/Providers/AppServiceProvider.php', 'a'); 
	
	$text = "\n\tpublic function registerUserRepository() {\n";
	$text .= "\t\treturn $"."this->app->bind(\n";
	fwrite($myfile, $text);

	$text = "\t\t\t'App\\" . "\Repositories\\"."\\"."User"."\\" . "\\"."User"."Repository',\n"; 
	$text .= "\t\t\t'App\\" . "\Repositories\\"."\\"."User"."\\" . "\Eloquent"."User"."'"; 
	fwrite($myfile, $text);

	$text = "\n\t\t);\n\t}\n}";
	fwrite($myfile, $text);

	//create boot.php inside Provider folder-----------------------------------------------------
	if(!file_exists('../../../../app/Providers/boot.php')) {
		$myfile = fopen('../../../../app/Providers/boot.php', 'w');
		$text = "<?php";
		fwrite($myfile, $text); 
	}
	//now add repository to boot file------------------------------------------------------------
	$myfile = fopen('../../../../app/Providers/boot.php', 'a');
	$text = "\n$" . "this->registerUserRepository();";
	fwrite($myfile, $text); 

	//now add component menu---------------------------------------------------------------------
	$myfile = fopen('../../../../resources/views/backend/layouts/component_menu.blade.php', 'a'); 
	
	$text = "\n<li><a href=\"{{url('/admin/user')}}\"><i class=\"fa fa-circle-o\"></i>User</a></li>\n";
	fwrite($myfile, $text); 

new Locate('../../../index.php?menu=component&action=create&success=yes&message=User Component is Added ');
