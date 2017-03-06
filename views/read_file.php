<?php //session_start();
require_once('config/config.php');
require_once('system/classes/connection.class.php');
require_once('system/classes/service.class.php');

$migratinFolders = scandir(MigrationFolderPathForView);

$appFolders = glob(RepositoryFolderPathForView. '/*' , GLOB_ONLYDIR);
$appController = glob(ControllerFolderPathForView. '/*' , GLOB_ONLYDIR);
$appViews = glob(ViewFolderPathForView. '/*' , GLOB_ONLYDIR);

$modelFolders = scandir(ModelFolderPathForView);
//print_r($modelFolders);

 $old_table_name = isset($_SESSION['table_name'])?$_SESSION['table_name']:'';
 $old_no_of_fields = isset($_SESSION['no_of_fields'])?$_SESSION['no_of_fields']:'';
?>

<div class="col-md-6">
<h3><?php echo $_SESSION['fileName']; ?></h3>
	<?php
	echo "<pre>";
	echo $_SESSION['readFile'];
	echo "</pre>";
	?>
</div>
<div class="col-md-5">
  <?php require_once('include/migration_model_file_tree.php'); ?>
  <?php require_once('include/controller_file_tree.php'); ?>
  <?php require_once('include/repository_file_tree.php'); ?>
  <?php require_once('include/views_file_tree.php'); ?>	
</div>
