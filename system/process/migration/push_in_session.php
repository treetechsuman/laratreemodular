<?php session_start();
require_once('../../classes/locate.class.php');
$_SESSION['table_name'] = $_POST['table_name'];
$_SESSION['no_of_fields'] = $_POST['no_of_fields'];
//unset($_SESSION['name']);

unset($_SESSION['field_name']);
unset($_SESSION['type']);

echo $_SESSION['no_of_fields']; 

$location = new Locate();
$location->redirect('../../../index.php?menu=migration&action=create&success=yes&message=Session is set');

?>