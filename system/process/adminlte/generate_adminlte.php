<?php //session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
require_once('../../../include/help_function.php');

//---copy layout to resource folder of laravel project for adminlte---------------------
$source= '../../../laravel/backendthemes/';
$destination ='../../../../public/';
copyr($source, $destination); 
//---copy layout to resource folder of laravel project for adminlte---------------------

//---copy layout to resource folder of laravel project for app---------------------
$source= '../../../laravel/resources/backend/';
$destination ='../../../../resources/views/';
copyr($source, $destination); 
//---copy layout to resource folder of laravel project for app---------------------

//---copy layout to resource folder of laravel project for app---------------------
$source= '../../../laravel/resources/frontend/';
$destination ='../../../../resources/views/';
copyr($source, $destination); 
//---copy layout to resource folder of laravel project for app---------------------

//---copy layout to resource folder of laravel project for auth ---------------------
$source= '../../../laravel/resources/views/';
$destination ='../../../../resources/views/';
copyr($source, $destination); 
//---copy layout to resource folder of laravel project for autn---------------------

//---frontend and dashboard controller ---------------------------------------------
$source= '../../../laravel/controller/';
$destination ='../../../../app/Http/Controllers/';
copyr($source, $destination); 

//---move providers ---------------------------------------------
$source= '../../../laravel/providers/';
$destination ='../../../../app/Providers/';
copyr($source, $destination);

//create boot.php inside Provider folder----
	if(!file_exists('../../../../app/Providers/boot.php')) {
		$myfile = fopen('../../../../app/Providers/boot.php', 'w');
		$text = "<?php";
		fwrite($myfile, $text); 
	}

//---move config ---------------------------------------------
$source= '../../../laravel/config/';
$destination ='../../../../config/';
copyr($source, $destination);  


// add setup route---------------------------
if(file_exists(AdminLteRouteFolderPath)){
	$myfile = fopen(AdminLteRouteFolderPath.'/web.php', "a") or die("Unable to open file!");
	$text ="/*\n|--------------------------------------------------------------------------\n";
	$text .="| Setup Routes\n";
	$text .="|--------------------------------------------------------------------------\n*/\n";
	fwrite($myfile, $text);
	$text = "Route::group(['prefix' => 'setup'], function() { \n";
	fwrite($myfile, $text);


	$text = "\tRoute::get('/cache-clear', function(){ \n";
	$text .= "\t\t\\Artisan::call('cache:clear');\n";
	$text .= "\t\techo 'cache-clear complete';\n";
	$text .= "\t});\n";
	fwrite($myfile, $text);


	$text = "\tRoute::get('/config-cache', function(){ \n";
	$text .= "\t\t\\Artisan::call('config:cache');\n";
	$text .= "\t\techo 'config-cache complete';\n";
	$text .= "\t});\n";
	fwrite($myfile, $text);

	$text = "\tRoute::get('/dump-autoload', function(){ \n";
	$text .= "\t\texec('composer dump-autoload');\n";
	$text .= "\t\techo 'composer dump-autoload complete';\n";
	$text .= "\t});\n";
	fwrite($myfile, $text);


	$text = "}); \n";
	fwrite($myfile, $text);
}

// add dashboard route---------------------------
if(file_exists(AdminLteRouteFolderPath)){
	$myfile = fopen(AdminLteRouteFolderPath.'/web.php', "a") or die("Unable to open file!");
	$text ="/*\n|--------------------------------------------------------------------------\n";
	$text .="| Dashboard Routes\n";
	$text .="|--------------------------------------------------------------------------\n*/\n";
	fwrite($myfile, $text);
	$text = "Route::group(['prefix' => 'admin'], function() { \n";
	fwrite($myfile, $text);
	$text = "\tRoute::get('/dashboard','Dashboard\DashboardController@index'); \n";
	$text .= "\tRoute::get('/logout','Dashboard\DashboardController@logout'); \n";
	fwrite($myfile, $text);
	$text = "}); \n";
	fwrite($myfile, $text);
}

// add frontend route---------------------------
if(file_exists(AdminLteRouteFolderPath)){
	$myfile = fopen(AdminLteRouteFolderPath.'/web.php', "a") or die("Unable to open file!");
	$text ="/*\n|--------------------------------------------------------------------------\n";
	$text .="| Frontend Routes\n";
	$text .="|--------------------------------------------------------------------------\n*/\n";
	fwrite($myfile, $text);
	$text = "Route::get('/', 'FrontendPageController@index'); \n";
	$text .= "Route::get('/home', 'FrontendPageController@index'); \n";
	$text .= "Route::get('/about', 'FrontendPageController@about'); \n";
	fwrite($myfile, $text);
}

$location = new Locate();
$location->redirect('../../../index.php?menu=adminlte&action=create&success=yes&message=AdminLTE is integrated ');
