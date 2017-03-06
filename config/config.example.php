<?php session_start();
//app configuration -----------
define("AppName", "laraTreeModule");

//database configuration -------
define("Host", "localhost");
define("Db", "");
define("User", "");
define("Password", "");

//for process---------------------------------------
define("MigrationFolderPath", "../../../../Modules/".$_SESSION['module']."/database/migrations/");
define("ModelFolderPath", "../../../../Modules/".$_SESSION['module']."/Entities/");
define("ControllerFolderPath", "../../../../Modules/".$_SESSION['module']."/Http/Controllers/");
define("RepositoryFolderPath", "../../../../Modules/".$_SESSION['module']."/Repositories/");
define("ViewFolderPath", "../../../../resources/views/backend/");
define("RouteFolderPath", "../../../../routes/");

//for views-----------------------------------------
define("MigrationFolderPathForView", "../Modules/".$_SESSION['module']."/database/migrations/");
define("ModelFolderPathForView", "../Modules/".$_SESSION['module']."/Entities/");
define("ControllerFolderPathForView", "../Modules/".$_SESSION['module']."/Http/Controllers");
define("RepositoryFolderPathForView", "../Modules/".$_SESSION['module']."/Repositories");
define("ViewFolderPathForView", "../resources/views/backend");
define("ModulesFolderPathForView", "../Modules");


$_SESSION['Host'] = 'localhost';
$_SESSION['Db'] = '';
$_SESSION['User'] = 'root';
$_SESSION['Password'] = '';

if (!file_exists("../app/Model/")) {
    mkdir("../app/Model/", 0777, true);
}


?>