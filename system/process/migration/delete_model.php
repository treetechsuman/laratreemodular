<?php
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
$fileName = isset($_GET['file_name'])?$_GET['file_name']:'';
$path = ModelFolderPath;

$location = new Locate();
if(file_exists ( $path.$fileName )){
	if(unlink($path.$fileName)){
		$location->redirect('../../../index.php?menu=migration&action=create&success=yes&message=Migration is Deleted ');
	}else{
		$location->redirect('../../../index.php?menu=migration&action=create&success=no&message=Migration is Not Deleted ');
	}

}else{
	$location->redirect('../../../index.php?menu=migration&action=create&success=no&message=Could not fine file ');

}