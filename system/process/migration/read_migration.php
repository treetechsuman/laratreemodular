<?php session_start();
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
$fileName = isset($_GET['file_name'])?$_GET['file_name']:'';
$path = MigrationFolderPath;
if(file_exists ( $path.$fileName )){
	//$myfile = fopen($path.$fileName, "r") or die("Unable to open file!");
	/*echo "<pre>";
	echo nl2br(file_get_contents($path.$fileName));
	echo "</pre>";
	echo nl2br(file_get_contents($path.$fileName));*/
	$_SESSION['readFile']=  nl2br(file_get_contents($path.$fileName));
	$_SESSION['fileName']= $fileName;
	new Locate('../../../index.php?menu=file&action=read&success=yes&message= fine file ');
}else{
	new Locate('../../../index.php?menu=file&action=read&success=no&message=Could not fine file ');

}