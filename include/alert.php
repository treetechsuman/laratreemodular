<?php
$success = isset($_GET['success'])?$_GET['success']:'';
$message=isset($_GET['message'])?$_GET['message']:'';

?>
<div class="mymessage">
<?php if($success == 'yes'){ ?>
	<div class="alert alert-success alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success!</strong> <?php echo $message; ?>
	</div>
<?php } if($success == 'no'){ ?>
	<div class="alert alert-danger alert-dismissable fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Sorry!</strong> <?php echo $message; ?>
	</div>
<?php } ?>	
</div>