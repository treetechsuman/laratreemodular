<?php
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
$fileName = isset($_GET['file_name'])?$_GET['file_name']:'';
$path = RepositoryFolderPath;
echo $path.$fileName;
if(file_exists ($path.$fileName)){
	if(unlink($path.$fileName)){
		new Locate('../../../index.php?menu=repository&action=create&success=yes&message=repository is Deleted ');
	}else{
		new Locate('../../../index.php?menu=repository&action=create&success=no&message=repository is Not Deleted ');
	}

}else{
	new Locate('../../../index.php?menu=repository&action=create&success=no&message=Could not fine file ');

}