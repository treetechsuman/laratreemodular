<ul>
  <li><i class="glyphicon glyphicon-folder-open"></i>Controllers</li>
  <?php foreach ($appController as $file) { ?>
    <ul>   
        <?php if( $file != '.' && $file != '..' ) {?>
          <li><i class="glyphicon glyphicon-file"></i>
          <a href="system/process/controller/read_controller.php?file_name=<?php echo $file ?>" class="label label-primary">
            <?php echo $file;?>       
          </a>
          <a href="system/process/controller/delete_controller.php?file_name=<?php echo $file ?>" class="btn btn-danger btn-xs">
            <i class="glyphicon glyphicon-remove"></i>
          </a>
          </li>
        <?php } ?>    
    </ul>
  <?php } ?>
</ul>