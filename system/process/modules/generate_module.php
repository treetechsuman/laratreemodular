<?php //session_start(); 
//processs
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
require_once('../../../include/help_function.php');

$module = isset($_GET['module'])?$_GET['module']:'';
echo $module . ' this is generate module';

//---copy form laratreemodular to destination---------------------
$source= '../../../modules/'.$module;
$destination ='../../../../Modules/';
copyr($source, $destination); 

new Locate('../../../index.php?menu=addmodule&action=create&success=yes&message=' . $module . ' Modules is Added ');
