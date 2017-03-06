<?php session_start(); 
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
//create another folder in side Repositories----
if (!file_exists(RepositoryFolderPath.ucfirst($_POST['repository']))) {
    mkdir(RepositoryFolderPath.ucfirst($_POST['repository']), 0777, true);
}
$myfile = fopen(RepositoryFolderPath.$_POST['repository'].'/'.$file_name, "w") or die("Unable to open file!");

if(fopen(RepositoryFolderPath.$_POST['repository'].'/'.$file_name, "w")){
	$text = "<?php \n";
	fwrite($myfile, $text);

	$text = "namespace App\Repositories\\". ucfirst($_POST['repository']).";\n\n";
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

//for eloquent---------------
$file_name = 'Eloquent'.ucfirst($_POST['repository']).'.php';
//echo $file_name;
if (!file_exists(RepositoryFolderPath.$_POST['repository'])) {
    mkdir(RepositoryFolderPath.$_POST['repository'], 0777, true);
}
$myfile = fopen(RepositoryFolderPath.$_POST['repository'].'/'.$file_name, "w") or die("Unable to open file!");

if(fopen(RepositoryFolderPath.$_POST['repository'].'/'.$file_name, "w")){
	$text = "<?php \n";
	fwrite($myfile, $text);

	$text = "namespace App\Repositories\\". ucfirst($_POST['repository']).";\n\n";
	fwrite($myfile, $text);
	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text ="use App\Model\\" . ucfirst($model). ";\n";	
		fwrite($myfile, $text);
	}

	$text = "\nclass " .'Eloquent'.ucfirst($_POST['repository']). " implements ". ucfirst($_POST['repository'])."Repository{\n";
	fwrite($myfile, $text);

	foreach ($models as $model) {
		$model = substr($model, 0, -4);
		$text = "\tprivate $" . strtolower($model) . ";\n";
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
		$text = "\tpublic function getAll".ucfirst($model)."(){\n";
		$text .=	"\t\treturn $" . "this->" .strtolower($model). "->all();\n";
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

	}
	

	$text = "}";
	fwrite($myfile, $text);
	//for updating AppsServiceProvider.php-------------------------
	// These two lines can be accomplished by using array_pop 
	// This will also prevent it from inserting blank lines 
	$file  = file('../../../../app/Providers/AppServiceProvider.php'); 
	array_pop($file); 
	$fp    = fopen('../../../../app/Providers/AppServiceProvider.php','w'); 
	fwrite($fp, implode('',$file)); 
	fclose($fp);  

	// write the new data to the file 
	$myfile = fopen('../../../../app/Providers/AppServiceProvider.php', 'a'); 
	/*public function registerCategoryRepo() {
        return $this->app->bind(
            'App\\Repositories\\Category\\CategoryRepository',
            'App\\Repositories\\Category\\EloquentCategory'
            );
    }*/
	$text = "\n\tpublic function register".ucfirst($_POST['repository'])."Repository() {\n";
	$text .= "\t\treturn $"."this->app->bind(\n";
	fwrite($myfile, $text);

	$text = "\t\t\t'App\\" . "\Repositories\\"."\\".ucfirst($_POST['repository'])."\\" . "\\".ucfirst($_POST['repository'])."Repository',\n"; 
	$text .= "\t\t\t'App\\" . "\Repositories\\"."\\".ucfirst($_POST['repository'])."\\" . "\Eloquent".ucfirst($_POST['repository'])."'"; 
	fwrite($myfile, $text);

	$text = "\n\t\t);\n\t}\n}";
	fwrite($myfile, $text); 

	//create boot.php inside Provider folder----
	if(!file_exists('../../../../app/Providers/boot.php')) {
		$myfile = fopen('../../../../app/Providers/boot.php', 'w');
		$text = "<?php";
		fwrite($myfile, $text); 
	}

	//now add repository to boot file-------------
	$myfile = fopen('../../../../app/Providers/boot.php', 'a');
	$text = "\n$" . "this->register".ucfirst($_POST['repository'])."Repository();";
	fwrite($myfile, $text);

new Locate('../../../index.php?menu=repository&action=create&success=yes&message=' .$_POST['repository'] . ' Repository and Eloquent is created ');
	
}



?>
