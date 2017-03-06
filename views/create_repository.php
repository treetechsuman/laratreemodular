<?php //session_start();
require_once('config/config.php');
require_once('system/classes/connection.class.php');
require_once('system/classes/service.class.php');

$migratinFolders = scandir(MigrationFolderPathForView);

$appFolders = glob(RepositoryFolderPathForView. '/*' , GLOB_ONLYDIR);

$modelFolders = scandir(ModelFolderPathForView);
//print_r($modelFolders);

 $old_table_name = isset($_SESSION['table_name'])?$_SESSION['table_name']:'';
 $old_no_of_fields = isset($_SESSION['no_of_fields'])?$_SESSION['no_of_fields']:'';
?>
<div class="col-md-3">
	<form action="system/process/repository/generate_repository.php" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-5" for="repository">Repository:</label>
      <div class="col-sm-7">
        <input type="text" name="repository" value="<?php //echo $old_table_name; ?>" class="form-control" id="repository" placeholder="Enter repository name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="repository">Select Model:</label>
      <div class="col-sm-7">
      <div class="checkbox">
      <label><input type="checkbox" name="model[]" value="User.php">User.php</label>
      </div>
      <?php foreach ($modelFolders as $file) { if($file !='.'&&$file!='..'){ ?>
        <div class="checkbox">
  			<label><input type="checkbox" name="model[]" value="<?php echo $file; ?>"><?php echo $file; ?></label>
		</div>
		<?php }} ?>
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
<?php require_once('include/repository_file_tree.php'); ?>

	
</div>