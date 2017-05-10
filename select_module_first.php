<?php //session_start();

$Modules = glob('../Modules/*' , GLOB_ONLYDIR);

?>
<div class="col-md-3">
<h1>Select Module first</h1>
<ul>

<?php foreach ($Modules as $folder) { 
$module= str_replace('../Modules/','',$folder); ?>
  <li><i class="glyphicon glyphicon-folder-open"></i>
  <a href="system/process/modules/select_module.php?module=<?php echo $module; ?>" data-toggle="tooltip" data-placement="top" title="Select Module!" > 
  <?php echo str_replace('../Modules/','',$folder); ?>
  </a>
  </li>
<?php } ?>
</ul>
</div>
