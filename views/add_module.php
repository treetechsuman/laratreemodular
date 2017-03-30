<?php //session_start();
require_once('config/config.php');
require_once('system/classes/connection.class.php');
require_once('system/classes/service.class.php');

$Modules = glob('modules/*' , GLOB_ONLYDIR);

?>
<div class="col-md-3">
<h3>Module List</h3>
<ul>

<?php foreach ($Modules as $folder) { $module= str_replace('modules/','',$folder); ?>
  <li><i class="glyphicon glyphicon-folder-open"></i>
  <?php echo str_replace('modules/','',$folder); ?>
  <a href="system/process/modules/generate_module.php?module=<?php echo $module; ?>" data-toggle="tooltip" data-placement="top" title="Add this module to system!" class="btn btn-success btn-xs" > 
  Add
  </a>
  </li>
<?php } ?>
</ul>
</div>