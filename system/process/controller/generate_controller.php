<?php //session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');

$_SESSION['repository']= $_POST['repository'];
$_SESSION['controller']= $_POST['controller'];
$repositories = $_POST['repository'];
$file_name = ucfirst($_POST['controller']).'Controller.php';

$myfile = fopen(ControllerFolderPath.'/'.$file_name, "w") or die("Unable to open file!");

if(fopen(ControllerFolderPath.'/'.$file_name, "w")){
	$text = "<?php \n\n";
	fwrite($myfile, $text);
	$text = "namespace Modules\\".$_SESSION['module']."\Http\Controllers;\n\n";
	fwrite($myfile, $text);

	$text = "use Illuminate\Http\Request;\n";
	$text .= "use Illuminate\Http\Response;\n";
	$text .= "use Illuminate\Routing\Controller;\n";
	$text .= "use Session;\n";
	fwrite($myfile, $text);
	foreach ($repositories as $repository) {
		$repository = substr($repository, 0, -4);
		$folder = substr($repository, 0, -10);
		$text = "use Modules\\".$_SESSION['module']."\Repositories\\" .ucfirst($repository).";\n";
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

	//index function---------
	$text ="\n\t/**\n";
	$text .="\t* Display a listing of the resource.\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);

	
	$text = "\n\tpublic function index(){\n";
	$text .= "\t\t$".lcfirst($_POST['controller'])."s = $". "this->".lcfirst($_POST['controller'])."Repo->getAll".ucfirst($_POST['controller'])."($"."limit = 10);\n";
	$text .= "\t\treturn view('". lcfirst($_SESSION['module']) . "::".lcfirst($_POST['controller']).".index',compact('".lcfirst($_POST['controller'])."s'));\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	//create function----------
	$text ="\n\t/**\n";
	$text .="\t* Show the form for creating a new resource.\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function create(){\n";

	$text .= "\t\treturn view('". lcfirst($_SESSION['module']) . "::".lcfirst($_POST['controller']).".create');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	//store function---------------
	$text ="\n\t/**\n";
	$text .="\t* Store a newly created resource in storage.\n";
	$text .="\t* @param  Request $" . "request\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function store(Request $"."request){\n";
	$text .= "\t\t$"."this->".lcfirst($_POST['controller'])."Repo->create".ucfirst($_POST['controller'])."($"."request->all());\n";
	$text .= "\t\tSession::flash('success','Operation Success');\n";
	$text .= "\t\treturn redirect('admin/".lcfirst($_SESSION['module'])."/".lcfirst($_POST['controller'])."');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);
	
	//show function---------------
	$text ="\n\t/**\n";
	$text .="\t* Show the specified resource.\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);
	$text = "\n\tpublic function show(){\n";
	$text .= "\t\treturn view('". lcfirst($_SESSION['module']) . "::".lcfirst($_POST['controller']).".show');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);
	//edit function -------
	$text ="\n\t/**\n";
	$text .="\t* Show the specified resource.\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function edit($" . "id){\n";
	$text .= "\t\t$".lcfirst($_POST['controller'])." = $". "this->".lcfirst($_POST['controller'])."Repo->get".ucfirst($_POST['controller'])."ById($" . "id);\n";
	$text .= "\t\treturn view('". lcfirst($_SESSION['module']) . "::".lcfirst($_POST['controller']).".edit',compact('".lcfirst($_POST['controller'])."'));\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	//update function-------------
	$text ="\n\t/**\n";
	$text .="\t* Update the specified resource in storage..\n";
	$text .="\t* Request $" . "request\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function update($" . "id ,Request $"."request){\n";
	$text .= "\t\t$"."this->".lcfirst($_POST['controller'])."Repo->update".ucfirst($_POST['controller'])."($" . "id,$"."request->all());\n";
	$text .= "\t\tSession::flash('success','Operation Success');\n";
	$text .= "\t\treturn redirect('admin/".lcfirst($_SESSION['module'])."/".lcfirst($_POST['controller'])."');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);
	
	//delete function---------------
	$text ="\n\t/**\n";
	$text .="\t* Remove the specified resource from storage.\n";
	$text .="\t* @return Response\n";
	$text .="\t*/";
	fwrite($myfile, $text);

	$text = "\n\tpublic function delete($" . "id){\n";
	$text .= "\t\t$"."this->".lcfirst($_POST['controller'])."Repo->delete".ucfirst($_POST['controller'])."($"."id);\n";
	$text .= "\t\tSession::flash('success','Operation Success');\n";
	$text .= "\t\treturn redirect('admin/".lcfirst($_SESSION['module'])."/".lcfirst($_POST['controller'])."');\n";
	$text .= "\t}\n";
	fwrite($myfile, $text);

	$text ="\n}";
	fwrite($myfile, $text);
}
new Locate('../../../index.php?menu=controller&action=create&success=yes&message=' .$_POST['controller'] . ' controller is created ');	
?>