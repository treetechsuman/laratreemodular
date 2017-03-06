<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once('route.php'); ?>
<?php require_once('config/config.php'); ?>
<?php require_once('include/nav.php'); ?>
  
<div class="container-fluid" style="margin-top:70px">
  <div class="row">
  <?php require_once('include/alert.php'); ?>
    <?php require_once($page_to_load) ;?>
  </div>
</div>


</body>
</html>
