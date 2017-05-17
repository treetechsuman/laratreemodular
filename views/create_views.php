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
        <input type="text" name="viewfolder" <?php
        if(isset($_SESSION['viewfolder'])){
        ?> 
            value="<?php echo $_SESSION['viewfolder']; ?>"
          <?php 
        }
        ?> class="form-control" id="viewfolder" placeholder="Enter viewfolder name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select Controller:</label>
      <div class="col-sm-7">
      

      <?php foreach ($appController as $file) { if($file !='.'&&$file!='..' ){ ?>
        <div class="radio">
  			<label><input type="radio" name="controller" value="<?php echo $file; ?>"
        <?php
        if(isset($_SESSION['controller'])){
          if($_SESSION['controller']==$file){
            echo 'checked="checked"'; 
          }
        }
        ?>
        ><?php echo $file; ?></label>
		</div>
		<?php }}?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-5" for="viewfolder">Select Fields:</label>
      <div class="col-sm-7"> 
      <?php
       if(isset($_SESSION['types'])){ 
        $types = $_SESSION['types'];
       }else{
        $types=false;
       }
      ?>
        <?php foreach($fields as $field){ ?>   
        <div class="checkbox">
          <label>
          <?php $info=''; ?>
            <input type="checkbox" name="fields[]" value="<?php echo $field->name; ?>"
              <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){
                  echo 'checked="checked"';
                  $info = 'danger';
              } ?>
            >
            <div <?php if($info=='danger') {?>style="color: green; font-size: 18px;"<?php }else{ ?>style="color: red; font-size: 18px;" <?php } ?>>
            <?php echo $field->name; ?>
            </div>
          </label>
          
        </div class="checkbox">
          <label>Text<input type="radio" value="text" name="types[<?php echo $field->name; ?>]"
          <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='text'){ ?> checked="checked" <?php }}else{ echo 'checked="checked"'; } ?>
          <?php } ?>
          >
          </label>
          <label>Number<input type="radio" value="number" name="types[<?php echo $field->name; ?>]"<?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='number'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
          <label>Email<input type="radio" value="email" name="types[<?php echo $field->name; ?>]"
          <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='email'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
          <label>Date<input type="radio" value="date" name="types[<?php echo $field->name; ?>]"
          <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='date'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
          <label>Select<input type="radio" value="select" name="types[<?php echo $field->name; ?>]"
          <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='select'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
          <label>TextArea<input type="radio" value="textarea" name="types[<?php echo $field->name; ?>]" 
          <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='textarea'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
          <label>Radio<input type="radio" value="radio" name="types[<?php echo $field->name; ?>]"
          <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='radio'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
          <label>Checkbox<input type="radio" value="checkbox" name="types[<?php echo $field->name; ?>]" <?php if($field->name!='id'&&$field->name!='created_at'&&$field->name!='updated_at'){?> 
           <?php if($types){ if($types[$field->name]=='checkbox'){ ?> checked="checked" <?php }} ?>
          <?php } ?>
          ></label>
        <div>
          
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
      <label class="control-label col-sm-4" for="no_of_fields">Add Route:</label>
      <div class="col-sm-8">                 
        Yes<input type="radio" name="add_route" value="yes" checked="checked">
        No<input type="radio" name="add_route" value="no" >       
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="no_of_fields">Add Menu:</label>
      <div class="col-sm-8">                 
        Yes<input type="radio" name="add_in_side_nav" value="yes" >
        No<input type="radio" name="add_in_side_nav" value="no" checked="checked">       
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