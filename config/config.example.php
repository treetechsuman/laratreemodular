<?php
//app configuration -----------
define("AppName", "laraTree");

//database configuration -------
define("Host", "localhost");
define("Db", "");
define("User", "");
define("Password", "");

//for process---------------------------------------
define("MigrationFolderPath", "../../../../database/migrations/");
define("ModelFolderPath", "../../../../app/Model/");
define("ControllerFolderPath", "../../../../app/Http/Controllers/");
define("RepositoryFolderPath", "../../../../app/Repositories/");
define("ViewFolderPath", "../../../../resources/views/backend/");
define("RouteFolderPath", "../../../../routes/");

//for views-----------------------------------------
define("MigrationFolderPathForView", "../database/migrations/");
define("ModelFolderPathForView", "../app/Model/");
define("ControllerFolderPathForView", "../app/Http/Controllers");
define("RepositoryFolderPathForView", "../app/Repositories");
define("ViewFolderPathForView", "../resources/views/backend");


$_SESSION['Host'] = 'localhost';
$_SESSION['Db'] = '';
$_SESSION['User'] = 'root';
$_SESSION['Password'] = '';

if (!file_exists("../app/Model/")) {
    mkdir("../app/Model/", 0777, true);
}


?>