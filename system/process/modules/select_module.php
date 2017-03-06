<?php
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
$module = isset($_GET['module'])?$_GET['module']:'';
$_SESSION['module']=$module;
new Locate('../../../index.php?menu=modules&success=yes&message=Module '.$_SESSION['module'].' is selected ');
