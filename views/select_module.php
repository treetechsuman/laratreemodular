<?php //session_start();
require_once('config/config.php');
require_once('system/classes/connection.class.php');
require_once('system/classes/service.class.php');
 
require_once('include/module_not_found_error.php');


$migratinFolders = scandir(MigrationFolderPathForView);

$appFolders = glob(RepositoryFolderPathForView. '/*' , GLOB_ONLYDIR);
$appController = glob(ControllerFolderPathForView. '/*' , GLOB_ONLYDIR);
$appViews = glob(ViewFolderPathForView. '/*' , GLOB_ONLYDIR);
$Modules = glob(ModulesFolderPathForView. '/*' , GLOB_ONLYDIR);

$modelFolders = scandir(ModelFolderPathForView);
//print_r($modelFolders);

 $old_table_name = isset($_SESSION['table_name'])?$_SESSION['table_name']:'';
 $old_no_of_fields = isset($_SESSION['no_of_fields'])?$_SESSION['no_of_fields']:'';
?>
<div class="col-md-3">
<h3>Module in this system</h3>
<ul>

<?php foreach ($Modules as $folder) { $module= str_replace('../Modules/','',$folder); ?>
  <li><i class="glyphicon glyphicon-folder-open"></i>
  <a href="system/process/modules/select_module.php?module=<?php echo $module; ?>" data-toggle="tooltip" data-placement="top" title="Select Module!" > 
  <?php echo str_replace('../Modules/','',$folder); ?>
  </a>
  </li>
<?php } ?>
</ul>
</div>