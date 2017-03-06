<?php //session_start();
require_once('config/config.php');
require_once('system/classes/connection.class.php');
require_once('system/classes/service.class.php');

$migratinFolders = scandir(MigrationFolderPathForView);

//$appFolders = glob('app/Repositories'. '/*' , GLOB_ONLYDIR);

$modelFolders = scandir(ModelFolderPathForView);

 $old_table_name = isset($_SESSION['table_name'])?$_SESSION['table_name']:'';
 $old_no_of_fields = isset($_SESSION['no_of_fields'])?$_SESSION['no_of_fields']:'';
?>

<div class="col-md-3">
   <form action="system/process/migration/push_in_session.php" method="post" class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-5" for="table">Table:</label>
      <div class="col-sm-7">
        <input type="text" name="table_name" value="<?php echo $old_table_name; ?>" class="form-control" id="table" placeholder="Enter table name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="no_of_fields">No of Fields:</label>
      <div class="col-sm-7">          
        <input type="number" name="no_of_fields" value="<?php echo $old_no_of_fields; ?>" class="form-control" id="no_of_fields" placeholder="No fo Fields">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Prepare Fields</button>
      </div>
    </div>
  </form>
</div>
<div class="col-md-4">
  <form action="system/process/migration/generate_migration.php" method="post" class="form-horizontal">
    <?php
     if(isset($_SESSION['no_of_fields'])){
     	for($i=0;$i<$_SESSION['no_of_fields'];$i++){     
     ?>
	<div class="form-group">
      <label class="control-label col-sm-4" for="no_of_fields">Field Name:</label>
      <div class="col-sm-8">          
        <input type="text" name="field_name[]" class="form-control" id="no_of_fields" placeholder="Field Name" required value="<?php if(isset($_SESSION['field_name'])){ echo $_SESSION['field_name'][$i]; } ?>">
        String<input type="radio" name="type[<?php echo $i; ?>]" value="string" 
        <?php if(isset($_SESSION['type'])){ if($_SESSION['type'][$i]=='string'){ ?> checked="checked" <?php }}else{ echo 'checked="checked"';} ?>>
        Integer<input type="radio" name="type[<?php echo $i; ?>]" value="integer"
        <?php if(isset($_SESSION['type'])){ if($_SESSION['type'][$i]=='integer'){ ?> checked="checked" <?php }} ?>>
        Enum<input type="radio" name="type[<?php echo $i; ?>]" value="enum"
        <?php if(isset($_SESSION['type'])){ if($_SESSION['type'][$i]=='enum'){ ?> checked="checked" <?php } }?>>
        Foreignkey<input type="radio" name="type[<?php echo $i; ?>]" value="foreign"
        <?php if(isset($_SESSION['type'])){ if($_SESSION['type'][$i]=='foreign'){ ?> checked="checked" <?php } }?>>
      </div>
    </div>
    <?php } } ?>
    <div class="form-group">
      <label class="control-label col-sm-4" for="no_of_fields">Create Model Too:</label>
      <div class="col-sm-8">                 
        Yes<input type="radio" name="create_model" value="yes" checked="checked">
        No<input type="radio" name="create_model" value="no">       
      </div>
    </div>
   
    <input type="hidden" name="table_name" value="<?php echo $old_table_name ?>">
    <input type="hidden" name="no_of_fields" value="<?php echo $old_no_of_fields ?>">
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Generate</button>
      </div>
    </div>
  </form>
    
</div>
<div class="col-md-5">
  <?php require_once('include/migration_model_file_tree.php'); ?>
</div>