<?php //session_start();
require_once('../../../config/config.php');
require_once('../../classes/locate.class.php');
require_once('../../classes/connection.class.php');
require_once('../../classes/service.class.php');

$objService = new Service();
$table_lists = $objService->get_table_name_list();
$table = $_POST['table'];
$fields = $objService->get_table_fields_name($table);
unset($_SESSION['controller']);
unset($_SESSION['types']);
unset($_SESSION['viewfolder']);
 /*echo '<pre>';
  print_r($fields);
 echo '</pre>';*/
 $_SESSION['table_fields'] = $fields;

new Locate('../../../index.php?menu=views&action=create&success=yes&message=' .$table. ' Fields of table are set ');

