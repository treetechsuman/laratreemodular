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
<div class="col-md-3">
	<form action="system/process/views/generate_view.php" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">folder:</label>
      <div class="col-sm-7">
        <input type="text" name="viewfolder" value="<?php //echo $old_table_name; ?>" class="form-control" id="viewfolder" placeholder="Enter viewfolder name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select Controller:</label>
      <div class="col-sm-7">
      <?php foreach ($appController as $folders) {
      $files = scandir($folders);  ?>

      <?php foreach ($files as $file) { if($file !='.'&&$file!='..' ){ ?>
        <div class="radio">
  			<label><input type="radio" name="controller" value="<?php echo $file; ?>"><?php echo $file; ?></label>
		</div>
		<?php }}} ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select File:</label>
      <div class="col-sm-7">    
        <div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="index">Index</label>
		</div>
		<div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="show">show</label>
		</div>
		<div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="create">create</label>
		</div>
		<div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="edit">edit</label>
		</div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Generate</button>
      </div>
    </div>
</div>
<div class="col-md-5">
	<?php //require_once('include/migration_model_file_tree.php'); ?>
	<?php //require_once('include/controller_file_tree.php'); ?>
	<?php require_once('include/views_file_tree.php'); ?>	
</div>