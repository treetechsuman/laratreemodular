<?php session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');

//echo MigrationFolderPath .'<br>';
//rtrim($string, ",")
$_SESSION['field_name']= $_POST['field_name'];
$_SESSION['type']= $_POST['type'];
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

	$text = "class Create" .ucfirst($_POST['table_name']). "Table extends Migration {\n";
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
				$text = "\n\t\t\t$" . "table->".$_POST['type'][$i]."('" . $_POST['field_name'][$i] ."',['value1','value2']);";
			}elseif($_POST['type'][$i]=='foreign'){
				$text = "\n\t\t\t$" . "table->integer('" . $_POST['field_name'][$i] ."')->unsigned();";
				$text .= "\n\t\t\t$" . "table->".$_POST['type'][$i]."('" . $_POST['field_name'][$i] ."')->references('id')->on('table name')->onDelete('cascade');";

			}else{
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
		//echo 'cteate model tooooo';
		//ucfirst("hello world!");
		//create Model folder inside app
		if (!file_exists(ModelFolderPath)) {
		    mkdir(ModelFolderPath, 0777, true);
		}
		$model_file_name = rtrim(ucfirst($_POST['table_name']),'s'). '.php';
		//echo $file_name;
		$myfile = fopen(ModelFolderPath.$model_file_name, "w") or die("Unable to open file!");
		if(fopen(ModelFolderPath.$model_file_name, "w")){
			$text = "<?php \n";
			fwrite($myfile, $text);

			$text = "namespace App\Model;\n\n";
			$text .= "use Illuminate\Database\Eloquent\Model;\n\n";
			fwrite($myfile, $text);

			$text = "class " .rtrim(ucfirst($_POST['table_name']),'s'). " extends Model{\n";
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
			new Locate('../../../index.php?menu=migration&action=create&success=yes&message=' .$_POST['table_name'] . ' migration and module is created ');
		}

	}
	new Locate('../../../index.php?menu=migration&action=create&success=yes&message=' .$_POST['table_name'] . ' migration is created ');
	
}else{
new Locate('../../../index.php?menu=migration&action=create&success=no&message=' . $_POST['table_name'] . ' migration is created ');
}


?>
