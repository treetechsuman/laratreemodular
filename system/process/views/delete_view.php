<?php
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
$fileName = isset($_GET['file_name'])?$_GET['file_name']:'';
//$path = RepositoryFolderPath;
$location = new Locate();
if(file_exists ('../../../'.$fileName )){
	if(unlink('../../../'.$fileName)){
		
$location->redirect('../../../index.php?menu=views&action=create&success=yes&message=view is Deleted ');
	}else{
		$location->redirect('../../../index.php?menu=views&action=create&success=no&message=view is Not Deleted ');
	}

}else{
	//new Locate('../../../index.php?menu=repository&action=create&success=no&message=Could not fine file ');

}