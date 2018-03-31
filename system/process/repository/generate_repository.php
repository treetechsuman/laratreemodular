<?php //session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');

//echo MigrationFolderPath .'<br>';
//rtrim($string, ",")
$_SESSION['repository']= $_POST['repository'];
$_SESSION['model']= $_POST['model'];
$models = $_POST['model'];
$file_name = ucfirst($_POST['repository']).'Repository.php';

//create Repositories folder inside app
if (!file_exists(RepositoryFolderPath)) {
    mkdir(RepositoryFolderPath, 0777, true);
}

//creation of Repository--------------------------------------------------------------------------
$myfile = fopen(RepositoryFolderPath.'/'.$file_name, "w") or die("Unable to open file!");
if(fopen(RepositoryFolderPath.'/'.$file_name, "w")){
	$text = "<?php \n";
	fwrite($myfile, $text);

	$text = "namespace Modules\\".$_SESSION['module']."\Repositories;\n\n";
	fwrite($myfile, $text);

	$text = "interface ". ucfirst($_POST['repository']).'Repository'." {\n\n";
	fwrite($myfile, $text);

	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text = "\tfunction getAll".ucfirst($model)."();\n\n";
		$text .= "\tfunction get".ucfirst($model)."ById($" . "id);\n\n";
		$text .= "\tfunction create".ucfirst($model)."(array $" . "attributes);\n\n";
		$text .= "\tfunction update".ucfirst($model)."($" . "id, array $" . "attributes);\n\n";
		$text .= "\tfunction delete".ucfirst($model)."($" . "id);\n\n";
		fwrite($myfile, $text);	
	}
	$text = "}\n";
	fwrite($myfile, $text);	
}
//End of creation of Repository--------------------------------------------------------------------


//creation of  eloquent,boot,inject to service provider--------------------------------------------
$file_name = ucfirst($_POST['repository']).'Eloquent.php';

$myfile = fopen(RepositoryFolderPath.'/'.$file_name, "w") or die("Unable to open file!");

if(fopen(RepositoryFolderPath.'/'.$file_name, "w")){
	$text = "<?php \n";
	fwrite($myfile, $text);

	$text = "namespace Modules\\".$_SESSION['module']."\Repositories;\n\n";
	fwrite($myfile, $text);
	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text ="use Modules\\".$_SESSION['module']."\Entities\\" . ucfirst($model). ";\n";	
		fwrite($myfile, $text);
	}

	$text = "\nclass " . ucfirst($_POST['repository']).'Eloquent'. " implements ". ucfirst($_POST['repository'])."Repository{\n";
	fwrite($myfile, $text);

	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text = "\tprotected $" . strtolower($model) . ";\n";
		fwrite($myfile, $text);
	}
	//creation of constructor---------------start
	$text = "\n\tpublic function __construct(";
	fwrite($myfile, $text);
	$i=0;
	$len = count($models);
	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text = ucfirst($model) . ' $' .strtolower($model);
		if ($i != $len - 1) {
			$text .= ",";
		}
		fwrite($myfile, $text);
		$i++;
	}


	$text = "){\n";
	fwrite($myfile, $text);
	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text = "\t\t$" . "this->" .strtolower($model) ." = $" . strtolower($model) .";\n";
		fwrite($myfile, $text);
		
	}

	$text = "\t}\n";
	fwrite($myfile, $text);
	//creation of constructor---------------end
	foreach ($models as $model) {

		$model = substr($model, 0, -4);
		$text = "\t/*---------------------------------------------------------------\n";
		$text .= "\t\t\t\t\t".ucfirst($model)." related Function\n";
		$text .= "\t---------------------------------------------------------------*/\n";
		fwrite($myfile, $text);

		$text = "\tpublic function getAll".ucfirst($model)."($"."limit = null){\n";
		$text .=	"\t\tif($"."limit!=null){\n";
		$text .=	"\t\t\treturn $" . "this->" .strtolower($model). "->orderBy('created_at','desc')->paginate($"."limit);\n";
		$text .=	"\t\t}\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->orderBy('created_at','desc')->get();\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

		$text = "\tpublic function get".ucfirst($model)."ById($" . "id){\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->findorfail($"."id);\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

		$text = "\tpublic function create".ucfirst($model)."(array $" . "attributes){\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->create($"."attributes);\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

		$text = "\tpublic function update".ucfirst($model)."($"."id,array $" . "attributes){\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->findorfail($"."id)->update($"."attributes);\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

		$text = "\tpublic function delete".ucfirst($model)."($" . "id){\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->findorfail($"."id)->delete();\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

		$text = "\tpublic function softDelete".ucfirst($model)."($" . "id){\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->findorfail($"."id)->update(['status'=>'Deleted']);\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

		$text = "\tpublic function get".ucfirst($model)."ByStatus($" . "status,$"."limit = null){\n";
		$text .=	"\t\tif($"."limit!=null){\n";
		$text .=	"\t\t\treturn $" . "this->" .strtolower($model). "->where('status',$"."status)->paginate($"."limit);\n";
		$text .=	"\t\t}\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->where('status',$"."status)->get();\n";
		$text .= "\t}\n\n";
		fwrite($myfile, $text);

	}


	$text = "}";
	fwrite($myfile, $text);
	//for updating AppsServiceProvider.php-------------------------
	// These two lines can be accomplished by using array_pop 
	// This will also prevent it from inserting blank lines
	if($_POST['update_service_provider']=='yes'){ 
		$file  = file('../../../../Modules/'.$_SESSION['module'].'/Providers/'.$_SESSION['module'].'ServiceProvider.php'); 
		array_pop($file); 
		$fp    = fopen('../../../../Modules/'.$_SESSION['module'].'/Providers/'.$_SESSION['module'].'ServiceProvider.php','w'); 
		fwrite($fp, implode('',$file)); 
		fclose($fp);  

		// write the new data to the file 
		$myfile = fopen('../../../../Modules/'.$_SESSION['module'].'/Providers/'.$_SESSION['module'].'ServiceProvider.php', 'a'); 
		
		$text = "\n\tpublic function register".ucfirst($_POST['repository'])."Repository() {\n";
		$text .= "\t\treturn $"."this->app->bind(\n";
		fwrite($myfile, $text);

		$text = "\t\t\t'Modules\\"."\\" .$_SESSION['module']."\\" . "\Repositories\\" . "\\".ucfirst($_POST['repository'])."Repository',\n"; 
		$text .= "\t\t\t'Modules\\"."\\" .$_SESSION['module']."\\" . "\Repositories\\" . "\\".ucfirst($_POST['repository'])."Eloquent'\n"; 
		//$text .= "\t\t\t'App\\" . "\Repositories\\"."\\" .ucfirst($_POST['repository']). "Eloquent"."'"; 
		fwrite($myfile, $text);

		$text = "\n\t\t);\n\t}\n}";
		fwrite($myfile, $text); 
  	}

	//create boot.php inside Provider folder----
	if(!file_exists('../../../../Modules/'.$_SESSION['module'].'/Providers/boot.php')) {
		$myfile = fopen('../../../../Modules/'.$_SESSION['module'].'/Providers/boot.php', 'w');
		$text = "<?php";
		fwrite($myfile, $text); 
	}

	//now add repository to boot file-------------
	$myfile = fopen('../../../../Modules/'.$_SESSION['module'].'/Providers/boot.php', 'a');
	$text = "\n$" . "this->register".ucfirst($_POST['repository'])."Repository();";
	fwrite($myfile, $text);

//End creation of  eloquent,boot,inject to service provider-----------------------------------------
}


//creation of  module Repository--------------------------------------------
$file_name = ucfirst($_SESSION['module']).'ModuleRepository.php';
if (!file_exists('../../../../Modules/'.$_SESSION['module'].'/Repositories/'.$file_name)) {

	
	$myfile = fopen(RepositoryFolderPath.'/'.$file_name, "w") or die("Unable to open file!");

	if(fopen(RepositoryFolderPath.'/'.$file_name, "w")){
		$text = "<?php \n";
		fwrite($myfile, $text);

		$text = "namespace Modules\\".$_SESSION['module']."\Repositories;\n\n";
		fwrite($myfile, $text);
		$text = "use DB;\n";
		$text .= "use Excel;\n";
		fwrite($myfile, $text);

		$text = "class " . ucfirst($_SESSION['module']).'ModuleRepository'. " extends ". ucfirst($_POST['repository'])."Eloquent{\n";
		fwrite($myfile, $text);

		$text = "\tpublic function export(array $"."tables){\n";
		$text .= "\t\t$"."datas = array();\n";
		$text .= "\t\t//prepared datas ------------------\n";
		$text .= "\t\tforeach($"."tables as $"."table){\n";
		$text .= "\t\t\t$"."tempData = DB::table($"."table)->get();\n";
		$text .= "\t\t\tarray_push($"."datas,$"."tempData);\n";
		$text .= "\t\t}\n";
		$text .= "\t\t//$"."datas =json_decode( json_encode($"."datas), true);\n";
		$text .= "\t\t//file name according to modules\n";
		$text .= "\t\t$"."filename = '". ucfirst($_SESSION['module']) ."';\n";
		$text .= "\t\tExcel::create($"."filename, function($"."excel) use ($"."datas,$"."filename,$"."tables) {\n";
		$text .= "\t\t\t$"."sheetNames = $"."tables;\n";
		$text .= "\t\t\t$"."i = 0;\n";
		$text .= "\t\t\t// loop table to create sheet\n";
		$text .= "\t\t\tforeach ($"."datas as $"."data) {\n";
		$text .= "\t\t\t\t$"."excel->sheet($"."sheetNames[$"."i], function($"."sheet) use($"."data,$"."sheetNames) {\n";
		$text .= "\t\t\t\t\t$"."sheet->fromArray($"."data);\n";
		$text .= "\t\t\t\t});\n";
		$text .= "\t\t\t\t$"."i++;\n";
		$text .= "\t\t\t}\n";
		$text .= "\t\t})->export('xls');\n";

		$text .= "\t}\n";
		fwrite($myfile, $text);

			
	$text = "\t/*------------------------------------------------------------------------------------
	 this commented code is only for image you can remove it there is not image
	 		------------------------------------------------------------------------------------*/\n";
	fwrite($myfile, $text);
	$text = "\t/*\n\tprivate function uploadImage($" . "file,$" . "width=null,$" . "height=null){
		if($" . "file){
			$" . "extension = $" . "file->getClientOriginalExtension();
			$" . "filename= md5(microtime()).'.'.$" . "extension;
			$" . "destinationPath= 'uploads/image/';
			$" . "file->move($" . "destinationPath,$" . "filename);
			if($" . "width!=null && $" . "height!=null){
				Image::make($" . "destinationPath.$" . "filename)
	            ->resize( $" . "width, $" . "height )//note width x height		
	            ->text('water',100,100,function($" . "font) {
								    //$" . "font->file('foo/bar.ttf');
								    $" . "font->size(200);
								    $" . "font->color(array(255, 255, 255, 0.5));
								    $" . "font->align('center');
								    $" . "font->valign('top');
								    $" . "font->angle(45);
								})
	            ->save($" . "destinationPath.$" . "filename);
	            return $" . "destinationPath.$" . "filename;
			}
			Image::make($" . "destinationPath.$" . "filename)
	            ->resize( 200, 200 )//note width x height		
	            ->text('water',100,100,function($" . "font) {
								    //$" . "font->file('foo/bar.ttf');
								    $" . "font->size(200);
								    $" . "font->color(array(255, 255, 255, 0.5));
								    $" . "font->align('center');
								    $" . "font->valign('top');
								    $" . "font->angle(45);
								})
	            ->save($" . "destinationPath.$" . "filename);    	
		}
		return $" . "destinationPath.$" . "filename;
	}\n\t*/\n\n";
	fwrite($myfile, $text);

	$text = "\t//copy this code in create function----\n";
	$text .= "\t\t/*\n\t\tif(array_key_exists('image', $" . "attributes)){
			$" . "path = $" . "this->uploadImage($" . "attributes['image']);
			$" . "attributes['image']=$" . "path;
		}\n\t\t*/\n\n";

	fwrite($myfile, $text);

	$text = "\t//copy this code in update need some edit ----\n";
	$text .= "\t\t/*\n\t\tif(array_key_exists('image', $" . "attributes)){
			$" . "testimonial = $" . "this->testimonial->findorfail($" . "id);
			//delete image
			if($" . "testimonial->image!='' && file_exists($" . "testimonial->image)){ 				
				unlink($" . "testimonial->image);
			}
			$" . "path = $" . "" . "this->uploadImage($" . "attributes['image']);
			$" . "attributes['image']=$" . "path;
		}\n\t\t*/\n\n";

	fwrite($myfile, $text);

	$text = "\t//copy this code in delete function ----\n";
	$text .= "\t\t/*\n\t\t$" . "testimonial = $" . "this->testimonial->findorfail($" . "id);
		//delete image 
		if($" . "" . "testimonial->image!='' && file_exists($" . "testimonial->image)){
			unlink($" . "testimonial->image);
		}\n\t\t*/\n\n";

	fwrite($myfile, $text);

		$text = "} \n";
		fwrite($myfile, $text);
	}
}


$location = new Locate();
$location->redirect('../../../index.php?menu=repository&action=create&success=yes&message=' .$_POST['repository'] . ' Repository and Eloquent is created ');



?>