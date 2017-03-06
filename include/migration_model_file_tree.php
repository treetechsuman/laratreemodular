<ul>
  <li><i class="glyphicon glyphicon-folder-open"></i> migrations</li>
  <?php foreach ($migratinFolders as $file) { ?>
    <ul>   
        <?php if( $file != '.' && $file != '..' ) {?>
          <li><i class="glyphicon glyphicon-file"></i>
          <a href="system/process/migration/read_migration.php?file_name=<?php echo $file ?>" class="label label-primary">
            <?php echo $file;?>       
          </a>
          <a href="system/process/migration/delete_migration.php?file_name=<?php echo $file ?>" class="btn btn-danger btn-xs">
            <i class="glyphicon glyphicon-remove"></i>
          </a>
          </li>
        <?php } ?>    
    </ul>
  <?php } ?>
</ul>
<ul>
  <li><i class="glyphicon glyphicon-folder-open"></i> Model</li>
  <ul>
  <?php foreach ($modelFolders as $file) { ?>
    
    <?php  if( $file != '.' && $file != '..' ) {?>
      <li><i class="glyphicon glyphicon-file"></i> 
      <a href="system/process/migration/read_model.php?file_name=<?php echo $file ?>" class="label label-default" >
        <?php echo $file; ?>
      </a>
      <a href="system/process/migration/delete_model.php?file_name=<?php echo $file ?>" class="btn btn-danger btn-xs">
        <i class="glyphicon glyphicon-remove"></i>
      </a>
      </li>
    <?php } ?>
      
  <?php } ?>
  </ul>
</ul> 
