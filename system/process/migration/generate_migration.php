<?php //session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');

//echo MigrationFolderPath .'<br>';
//rtrim($string, ",")
$_SESSION['field_name']= $_POST['field_name'];
$_SESSION['type']= $_POST['type'];

$moduleRepository = $_SESSION['module'].'Module';

//prepare name for model class and file
	$modules = $_POST['table_name'];
	$modules = explode('_',$modules);
	$modules_file_name ='';
	foreach($modules as $module){
		$modules_file_name .=ucfirst($module);
	}
	$migration_class_name = $modules_file_name;
	$model_class_name =rtrim($modules_file_name,'s');
	$model_file_name = rtrim($modules_file_name,'s'). '.php';

	$request_class_name =rtrim($modules_file_name,'s'). 'Request';
	$request_file_name = rtrim($modules_file_name,'s'). 'Request.php';

//HHMMSS
$file_name = date("Y").'_'.date("m").'_'.date("d").'_'.date("hms").'_create_'.$_POST['table_name']. '_table.php';
//echo $file_name;
$myfile = fopen(MigrationFolderPath.$file_name, "w") or die("Unable to open file!");

if(fopen(MigrationFolderPath.$file_name, "w")){
	$text = "<?php \n\n";
	fwrite($myfile, $text);

	$text = "use Illuminate\Database\Migrations\Migration;\n";
	$text .= "use Illuminate\Database\Schema\Blueprint;\n";
	$text .= "use Illuminate\Support\Facades\Schema;\n\n";
	fwrite($myfile, $text);

	$text = "class Create" .$migration_class_name. "Table extends Migration {\n";
	$text .= "\t/**\n\t* Run the migrations.\n\t*\n\t* @return void\n\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function up() {";
	$text .= "\n\t\tSchema::create('" .$_POST['table_name']. "', function (Blueprint $" . "table) {";
	fwrite($myfile, $text);
	//-----------------------------------actual process goes here-------------
		$text = "\n\t\t\t$" . "table->increments('id');";
		fwrite($myfile, $text);

		for($i=0;$i<$_POST['no_of_fields'];$i++){
			if($_POST['type'][$i]=='enum'){
				$text = "\n\t\t\t$" . "table->".$_POST['type'][$i]."('" . $_POST['field_name'][$i] ."',['Active','Inactive','Deleted']);";
			}elseif($_POST['type'][$i]=='foreign'){
				$text = "\n\t\t\t$" . "table->integer('" . $_POST['field_name'][$i] ."')->unsigned();";
				$text .= "\n\t\t\t$" . "table->".$_POST['type'][$i]."('" . $_POST['field_name'][$i] ."')->references('id')->on('table_name')->onDelete('cascade');";

			}elseif($_POST['type'][$i]=='date'){
				$text = "\n\t\t\t$" . "table->".$_POST['type'][$i]."('" . $_POST['field_name'][$i] ."');";
			}
			else{
				$text = "\n\t\t\t$" . "table->".$_POST['type'][$i]."('" . $_POST['field_name'][$i] ."');";
			}
			fwrite($myfile, $text);
		}


		//$text = "\n\t\t\t$" . "table->rememberToken();";
		$text = "\n\t\t\t$" . "table->timestamps();";
		fwrite($myfile, $text);

	//-------------------------------------------------------------------------
	$text = "\n\t\t});\n\t}";
	fwrite($myfile, $text);


	$text = "\n\t/**\n\t* Run the migrations.\n\t*\n\t* @return void\n\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function down() {";
	$text .= "\n\t\tSchema::drop('" .$_POST['table_name']. "');\n\t}\n}";
	fwrite($myfile, $text);
	//for creating model---------------------------------------------------------------------------------------------
	if($_POST['create_model']=='yes'){
		
		if (!file_exists(ModelFolderPath)) {
		    mkdir(ModelFolderPath, 0777, true);
		}
		//$model_file_name = rtrim(ucfirst($_POST['table_name']),'s'). '.php';
		//echo $file_name;
		$myfile = fopen(ModelFolderPath.$model_file_name, "w") or die("Unable to open file!");
		if(fopen(ModelFolderPath.$model_file_name, "w")){
			$text = "<?php \n";
			fwrite($myfile, $text);

			$text = "namespace Modules\\".$_SESSION['module']."\Entities;\n\n";
			$text .= "use Illuminate\Database\Eloquent\Model;\n\n";
			fwrite($myfile, $text);

			$text = "class " .$model_class_name. " extends Model{\n";
			$text .= "\tprotected $" . "table='" . $_POST['table_name'] . "';\n";
			fwrite($myfile, $text);

			$text ="\tprotected $" . "fillable=[";
			fwrite($myfile, $text);

			$text = "\n\t\t\t\t'id',";
				fwrite($myfile, $text);
			//------------------------logic------------------------------
			for($i=0;$i<$_POST['no_of_fields'];$i++){
			
				$text = "\n\t\t\t\t'" . $_POST['field_name'][$i] . "',";
				fwrite($myfile, $text);
			}

			//-----------------------------------------------------------
			$text ="\n\t\t\t];\n";
			fwrite($myfile, $text);

			$text ="\tprotected $" . "hidden=[\n";
			fwrite($myfile, $text);

			$text ="\t];\n}";
			fwrite($myfile, $text);
		}

	}

	//for creating request---------------------------------------------------------------------------------------------
	if($_POST['create_request']=='yes'){
		
		if (!file_exists(RequestFolderPath)) {
		    mkdir(RequestFolderPath, 0777, true);
		}
		//$model_file_name = rtrim(ucfirst($_POST['table_name']),'s'). '.php';
		//echo $file_name;
		$myfile = fopen(RequestFolderPath.$request_file_name, "w") or die("Unable to open file!");
		if(fopen(RequestFolderPath.$request_file_name, "w")){
			$text = "<?php \n\n";
			fwrite($myfile, $text);

			$text = "namespace Modules\\".$_SESSION['module']."\Http\Requests;\n\n";
			$text .= "use Illuminate\Foundation\Http\FormRequest;\n\n";
			fwrite($myfile, $text);

			$text = "class " .$request_class_name. " extends FormRequest\n{\n";
			
			$text .= "\t/**\n";
			$text .= "\t * Get the validation rules that apply to the request.\n";
			$text .= "\t *\n";
			$text .= "\t * @return array\n";
			$text .= "\t */\n";
			$text .= "\tpublic function rules()\n";
			$text .= "\t{\n";
			$text .= "\t\treturn [\n";
			fwrite($myfile, $text);
				for($i=0;$i<$_POST['no_of_fields'];$i++){
					$text = "\t\t\t '" . $_POST['field_name'][$i] . "' => 'required', \n";
					fwrite($myfile, $text);
			    }
			$text = "\t\t];\n";
			$text .= "\t}\n\n";

			$text .= "\t/**\n";
			$text .= "\t * Determine if the user is authorized to make this request.\n";
			$text .= "\t *\n";
			$text .= "\t * @return bool\n";
			$text .= "\t */\n";
			$text .= "\tpublic function authorize()\n";
			$text .= "\t{\n";
			$text .= "\t\treturn true;\n";
			$text .= "\t}\n";
			fwrite($myfile, $text);

			//------------------------logic------------------------------
			/*for($i=0;$i<$_POST['no_of_fields'];$i++){
			
				$text = "\n\t\t\t\t'" . $_POST['field_name'][$i] . "',";
				fwrite($myfile, $text);
			}*/

			$text ="\t\n}";
			fwrite($myfile, $text);
		}

	}

	//for creating seeder---------------------------------------------------------------------------------------------
	if($_POST['create_seeder']=='yes'){
		
		//create Model folder inside app
		if (!file_exists(SeedersFolderPath)) {
		    mkdir(SeedersFolderPath, 0777, true);
		}
		
		//echo $file_name;
		$myfile = fopen(SeedersFolderPath . rtrim($model_file_name,'.php'). "DataSeeders.php", "w") or die("Unable to open file!");
		if(fopen(SeedersFolderPath . rtrim($model_file_name,'.php'). "DataSeeders.php", "w")){
			$text = "<?php \n";
			fwrite($myfile, $text);

			$text = "namespace Modules\\".$_SESSION['module']."\Database\Seeders;\n\n";
			$text .= "use Illuminate\Database\Seeder;\n";
			$text .= "use Illuminate\Database\Eloquent\Model;\n";
			$text .= "use Faker\Factory as Faker;\n\n";
			$text .= "use Modules\\".$_SESSION['module']."\Repositories\\".$moduleRepository."Repository;\n\n";
			fwrite($myfile, $text);

			$text = "class " .$model_class_name. "DataSeeders extends Seeder{\n\n";
			$text .= "\tprivate $"."" .$moduleRepository. "Repo;\n\n";
			$text .= "\tpublic function __construct(" .$moduleRepository. "Repository $" .$moduleRepository. "Repo){\n\n";
			$text .= "\t\t$"."this->" .$moduleRepository. "Repo = $" .$moduleRepository. "Repo;\n\n";
				$text .= "\t}\n\n";
			$text .= "\tpublic function run(){\n\n";
			$text .= "\t\tModel::unguard();\n\n";
			$text .= "\t\t$"."faker = Faker::create();\n\n";
			$text .= "\t\tfor($"."i=1;$"."i<=20;$"."i++){\n";
			fwrite($myfile, $text);
			$text = "\t\t\t$" . lcfirst($model_class_name). "Data = [\n\n";
			fwrite($myfile, $text);
				for($i=0;$i<$_POST['no_of_fields'];$i++){
			
					$text = "\t\t\t\t\t'" . $_POST['field_name'][$i] . "'=>$"."faker->" . $_POST['field_name'][$i] . "(),\n";
					fwrite($myfile, $text);
				}
			$text = "\n\t\t\t];\n";
			$text .= "\t\t\t$"."this->" .$moduleRepository. "Repo->create" .ucfirst($model_class_name). "($" . lcfirst($model_class_name). "Data);\n";
			$text .= "\n\t\t\techo '.';\n";
			fwrite($myfile, $text);
			$text = "\t\t}\n\n";
			$text .= "\t\t//$"."this->call(OthersTableSeeder::class);\n";
			$text .= "\t}\n";
			fwrite($myfile, $text);

			$text = "}\n";
			fwrite($myfile, $text);
			$location = new Locate();
			$location->redirect('../../../index.php?menu=migration&action=create&success=yes&message=' .$_POST['table_name'] . ' migration and module is created ');
		}

	}
	//new Locate('../../../index.php?menu=migration&action=create&success=yes&message=' .$_POST['table_name'] . ' migration is created ');
	
}else{
//new Locate('../../../index.php?menu=migration&action=create&success=no&message=' . $_POST['table_name'] . ' migration is created ');
}


?>
