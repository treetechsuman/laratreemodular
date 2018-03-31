<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laratree Modular</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
  if(!file_exists("config/config.php")){
    echo "<h2>Config file is not created</h2>";
    exit(0);
  }
?>
<?php require_once('route.php'); ?>
<?php require_once('config/config.php'); ?>
<?php require_once('include/nav.php'); ?>
  
<div class="container-fluid" style="margin-top:70px; margin-bottom: 100px">
  <div class="row">
  
  <?php require_once('include/alert.php'); ?>
    <?php require_once($page_to_load) ;?>
  </div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <div class="container">
    Develop By <a href="https://www.facebook.com/suman.dahal.9026">Er.Suman Dahal</a>
  </div>
</nav>
<script type="text/javascript">
    $(".alert").delay(1000).slideUp(200, function() {
    $(this).alert('close');
});
</script>

</body>
</html>
