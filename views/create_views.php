<?php //session_start();
require_once('config/config.php');
require_once('system/classes/connection.class.php');
require_once('system/classes/service.class.php');

$migratinFolders = scandir(MigrationFolderPathForView);

$appFolders = glob(RepositoryFolderPathForView. '/*' , GLOB_ONLYDIR);
//$appController = glob(ControllerFolderPathForView. '/*' , GLOB_ONLYDIR);
$appController = scandir(ControllerFolderPathForView);
$appViews = glob(ViewFolderPathForView. '/*' , GLOB_ONLYDIR);

$modelFolders = scandir(ModelFolderPathForView);
//print_r($modelFolders);

 $old_table_name = isset($_SESSION['table_name'])?$_SESSION['table_name']:'';
 $old_no_of_fields = isset($_SESSION['no_of_fields'])?$_SESSION['no_of_fields']:'';

 $objService = new Service();
 $table_lists = $objService->get_table_name_list();
if(isset($_SESSION['table_fields'])){
 $fields = $_SESSION['table_fields'];
}else{
  $fields = array();
}
 /*echo '<pre>';
  print_r($fields);
 echo '</pre>'*/
?>
<div class="col-md-3">
  <form action="system/process/views/table_fields.php" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Table list:</label>
      <div class="col-sm-7">
        <select name="table" class="form-control">
        <?php foreach($table_lists as $table_list){ ?>
          <option value="<?php echo $table_list->{TableIn}; ?>"><?php echo $table_list->{TableIn}; ?></option>
        <?php } ?>
        </select>
      </div>
    </div>    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Find Fields</button>
      </div>
    </div>
    </form>
</div>
<div class="col-md-3">
	<form action="system/process/views/generate_view.php" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">View Folder:</label>
      <div class="col-sm-7">
        <input type="text" name="viewfolder" value="<?php //echo $old_table_name; ?>" class="form-control" id="viewfolder" placeholder="Enter viewfolder name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select Controller:</label>
      <div class="col-sm-7">
      

      <?php foreach ($appController as $file) { if($file !='.'&&$file!='..' ){ ?>
        <div class="radio">
  			<label><input type="radio" name="controller" value="<?php echo $file; ?>"><?php echo $file; ?></label>
		</div>
		<?php }}?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select Fields:</label>
      <div class="col-sm-7"> 
        <?php foreach($fields as $field){ ?>   
        <div class="checkbox">
          <label>
            <input type="checkbox" name="fields[]" value="<?php echo $field->name; ?>"
              <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){echo 'checked="checked"';} ?>
            >
            <?php echo $field->name; ?>
          </label>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select File:</label>
      <div class="col-sm-7">    
        <div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="index" checked="checked">Index</label>
		</div>
		<div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="show" checked="checked">show</label>
		</div>
		<div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="create" checked="checked">create</label>
		</div>
		<div class="checkbox">
  			<label><input type="checkbox" name="views[]" value="edit" checked="checked">edit</label>
		</div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Generate</button>
      </div>
    </div>
    </form>
</div>
<div class="col-md-5">
	<?php //require_once('include/migration_model_file_tree.php'); ?>
	<?php //require_once('include/controller_file_tree.php'); ?>
	<?php require_once('include/views_file_tree.php'); ?>	
</div>