<ul>
  <li><i class="glyphicon glyphicon-folder-open"></i> Repositiory</li>
  <?php foreach ($appFolders as $file) { ?>
    <ul>   
        <?php if( $file != '.' && $file != '..' ) {?>
          <li><i class="glyphicon glyphicon-file"></i>
          <a href="system/process/repository/read_repository.php?file_name=<?php echo $file ?>" class="label label-primary">
            <?php echo $file;?>       
          </a>
          <a href="system/process/repository/delete_repository.php?file_name=<?php echo $file ?>" class="btn btn-danger btn-xs">
            <i class="glyphicon glyphicon-remove"></i>
          </a>
          </li>
        <?php } ?>    
    </ul>
  <?php } ?>
</ul>