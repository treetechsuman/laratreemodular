<ul>
<?php foreach ($appViews as $folder) { ?>
  <li><i class="glyphicon glyphicon-folder-open"></i> <?php echo $folder; ?></li>
  <ul>
  <?php 
    $files = scandir($folder);
    foreach ($files as $file) { ?>
    
      <?php if( $file != '.' && $file != '..' ) {?>
      <li><i class="glyphicon glyphicon-file"></i>
      <a href="system/process/repository/read_repository.php?file_name=<?php echo $folder.'/'.$file ?>" class="label label-info">
        <?php echo $file; ?>
      </a>
      <a href="system/process/views/delete_view.php?file_name=<?php echo $folder.'/'.$file ?>" class="btn btn-danger btn-xs">
        <i class="glyphicon glyphicon-remove"></i>
      </a>
      </li>
      <?php } ?>
      
  <?php } ?>
  </ul>
<?php } ?>
</ul>