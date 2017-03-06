<?php session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');

//echo MigrationFolderPath .'<br>';
//rtrim($string, ",")
$_SESSION['repository']= $_POST['repository'];
$_SESSION['controller']= $_POST['controller'];
$repositories = $_POST['repository'];
$file_name = ucfirst($_POST['controller']).'Controller.php';
//create Repositories folder inside app
if (!file_exists(ControllerFolderPath)) {
    mkdir(ControllerFolderPath, 0777, true);
}
//create another folder in side Repositories----
if (!file_exists(ControllerFolderPath.ucfirst($_POST['controller']))) {
    mkdir(ControllerFolderPath.ucfirst($_POST['controller']), 0777, true);
}
$myfile = fopen(ControllerFolderPath.$_POST['controller'].'/'.$file_name, "w") or die("Unable to open file!");

if(fopen(ControllerFolderPath.$_POST['controller'].'/'.$file_name, "w")){
	$text = "<?php \n\n";
	fwrite($myfile, $text);
//namespace App\Http\Controllers\Product;
	$text = "namespace App\Http\Controllers\\". ucfirst($_POST['controller']).";\n\n";
	fwrite($myfile, $text);

	$text = "use Illuminate\Http\Request;\n";
	$text .= "use App\Http\Controllers\Controller;\n";
	fwrite($myfile, $text);
	foreach ($repositories as $repository) {
		$repository = substr($repository, 0, -4);
		$folder = substr($repository, 0, -10);
		$text = "use App\Repositories\\".ucfirst($folder)."\\" .ucfirst($repository).";\n";
		fwrite($myfile, $text);

	}
	$text = "\n\n";
	$text .= "class ".ucfirst($_POST['controller'])."Controller extends Controller{\n";
	fwrite($myfile, $text);
	//private property---------------
	foreach ($repositories as $repository) {
		$repository = substr($repository, 0, -10);
		$text = "\tprivate $".lcfirst($repository).";\n";
		fwrite($myfile, $text);

	}

	$text = "\n\tpublic function __construct(\n";
	fwrite($myfile, $text);
		//class injuction---------------
		$i=0;
		$len = count($repositories);
		foreach ($repositories as $repository) {
			$repoProperty = substr($repository, 0, -10);
			$repository = substr($repository, 0, -4);
			$text = "\t\t".$repository." $".lcfirst($repoProperty)."\n";
			if ($i != $len - 1) {
				$text .= ",";
			}
			fwrite($myfile, $text);
		}

	$text = "\t){\n";
	fwrite($myfile, $text);

		//property init---------------
		foreach ($repositories as $repository) {
			$repoProperty = substr($repository, 0, -10);
			$repository = substr($repository, 0, -4);
			$text = "\t\t$"."this->".lcfirst($repoProperty)." = $".lcfirst($repoProperty).";\n";
			fwrite($myfile, $text);
		}

	$text = "\t}\n";
	fwrite($myfile, $text);

	$text = "\n\tpublic function index(){\n";
	//$sliders = $this->sliderRepo->getAllSlider();
	$text .= "\t\t$".lcfirst($_POST['controller'])."s = $". "this->".lcfirst($_POST['controller'])."Repo->getAll".ucfirst($_POST['controller'])."();\n";
	$text .= "\t\treturn view('backend.".lcfirst($_POST['controller']).".index',compact('".lcfirst($_POST['controller'])."s'));\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	$text = "\n\tpublic function create(){\n";
	$text .= "\t\treturn view('backend.".lcfirst($_POST['controller']).".create');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	//$this->sliderRepo->createSlider($request->all());
	//return redirect('/slider');
	$text = "\n\tpublic function store(Request $"."request){\n";
	$text .= "\t\t$"."this->".lcfirst($_POST['controller'])."Repo->create".ucfirst($_POST['controller'])."($"."request->all());\n";
	$text .= "\t\treturn redirect('admin/".lcfirst($_POST['controller'])."');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);
	
	$text = "\n\tpublic function show(){\n";
	$text .= "\t\treturn view('backend.".lcfirst($_POST['controller']).".show');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	//$slider = $this->sliderRepo->getSliderById($id);
	//return view('backend.slider.edit',compact('slider'));
	$text = "\n\tpublic function edit($" . "id){\n";
	$text .= "\t\t$".lcfirst($_POST['controller'])." = $". "this->".lcfirst($_POST['controller'])."Repo->get".ucfirst($_POST['controller'])."ById($" . "id);\n";
	$text .= "\t\treturn view('backend.".lcfirst($_POST['controller']).".edit',compact('".lcfirst($_POST['controller'])."'));\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	//$this->sliderRepo->updateSlider($id,$request->all())
	//return redirect('/slider');
	$text = "\n\tpublic function update($" . "id ,Request $"."request){\n";
	$text .= "\t\t$"."this->".lcfirst($_POST['controller'])."Repo->update".ucfirst($_POST['controller'])."($" . "id,$"."request->all());\n";
	$text .= "\t\treturn redirect('admin/".lcfirst($_POST['controller'])."');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);
	//$this->sliderRepo->deleteSlider($id);
	//return redirect('/slider');
	$text = "\n\tpublic function delete($" . "id){\n";
	$text .= "\t\t$"."this->".lcfirst($_POST['controller'])."Repo->delete".ucfirst($_POST['controller'])."($"."id);\n";
	$text .= "\t\treturn redirect('admin/".lcfirst($_POST['controller'])."');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	$text ="\n}";
	fwrite($myfile, $text);


}


new Locate('../../../index.php?menu=controller&action=create&success=yes&message=' .$_POST['controller'] . ' controller is created ');
	




?>
