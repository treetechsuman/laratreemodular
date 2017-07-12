<?php session_start();
//session_destroy();
if(!$_SESSION['module']){
    header('Location: select_module_first.php');
}
//app configuration -----------
define("AppName", "laraTreeModule");

//database configuration -------
define("Host", "localhost");
define("Db", "modules");
define("User", "root");
define("Password", "");

//for process---------------------------------------
define("MigrationFolderPath", "../../../../Modules/".$_SESSION['module']."/database/migrations/");
define("ModelFolderPath", "../../../../Modules/".$_SESSION['module']."/Entities/");
define("SeedersFolderPath", "../../../../Modules/".$_SESSION['module']."/Database/Seeders/");
define("ControllerFolderPath", "../../../../Modules/".$_SESSION['module']."/Http/Controllers/");
define("RepositoryFolderPath", "../../../../Modules/".$_SESSION['module']."/Repositories/");
define("ViewFolderPath", "../../../../Modules/".$_SESSION['module']."/resources/views/");
define("RouteFolderPath", "../../../../Modules/".$_SESSION['module']."/Http/");
define("AdminLteRouteFolderPath", "../../../../routes/");

//for views-----------------------------------------
define("MigrationFolderPathForView", "../Modules/".$_SESSION['module']."/database/migrations/");
define("ModelFolderPathForView", "../Modules/".$_SESSION['module']."/Entities/");
define("SeedersFolderPathForView", "../Modules/".$_SESSION['module']."/Database/Seeders/");
define("ControllerFolderPathForView", "../Modules/".$_SESSION['module']."/Http/Controllers");
define("RepositoryFolderPathForView", "../Modules/".$_SESSION['module']."/Repositories");
define("ViewFolderPathForView", "../Modules/".$_SESSION['module']."/resources/views/");
define("ModulesFolderPathForView", "../Modules");


$_SESSION['Host'] = 'localhost';
$_SESSION['Db'] = '';
$_SESSION['User'] = 'root';
$_SESSION['Password'] = '';

if (!file_exists("../app/Model/")) {
    mkdir("../app/Model/", 0777, true);
}
$table_in = "Tables_in_".lcfirst(Db);
define("TableIn",$table_in);


?>