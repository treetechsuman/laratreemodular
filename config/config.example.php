<?php session_start();
//app configuration -----------
define("AppName", "laraTreeModule");

//database configuration -------
define("Host", "localhost");
define("Db", "vhakari");
define("User", "root");
define("Password", "");

//for process---------------------------------------
define("MigrationFolderPath", "../../../../Modules/".$_SESSION['module']."/database/migrations/");
define("ModelFolderPath", "../../../../Modules/".$_SESSION['module']."/Entities/");
define("ControllerFolderPath", "../../../../Modules/".$_SESSION['module']."/Http/Controllers/");
define("RepositoryFolderPath", "../../../../Modules/".$_SESSION['module']."/Repositories/");
define("ViewFolderPath", "../../../../Modules/".$_SESSION['module']."/resources/views/");
define("RouteFolderPath", "../../../../Modules/".$_SESSION['module']."/Http/");

//for views-----------------------------------------
define("MigrationFolderPathForView", "../Modules/".$_SESSION['module']."/database/migrations/");
define("ModelFolderPathForView", "../Modules/".$_SESSION['module']."/Entities/");
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