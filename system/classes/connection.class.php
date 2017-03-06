<?php

/**
 class is to connect with the database
*/
require_once('config/config.php');

//echo $_SESSION['Host']; 

class Connection{

	private $user;
	private $cpassword;
	private $host;
	private $db;

	public $sql;
	public $res;
	public $error;
	public $affRows;
	public $numRows;
	public $data = array(); // blank array

	public $conxn;

	/* setters */
	public function setUser($ur = ''){
		$this->user = $ur;
	}

	public function setCpassword($pd = '' ){
		$this->cpassword = $pd;
	}

	public function setHost($ht = ''){
		$this->host = $ht;
	}

	public function setDB($db = ''){
		$this->db = $db;
	}
//$h = 'localhost', $u = 'itucnac_site', $p = 'HswldUQN*{Ji', $db = 'itucnac_site'
//$h = 'localhost',  $u = 'root', $p = '', $db = 'db_bedc'
	public function __construct(
			$h = '',  
			$u = '', 
			$p = '', 
			$db = ''
		)
	{
	
	$this->conxn=mysqli_connect($h, $u, $p, $db)
				or trigger_error($this->error = mysqli_error($this->conxn));
	
//echo "<br /> The database is ready to serve! ";	
	}
	
	public function close(){
	mysqli_close($this->conxn);
	//echo "<br /> The connection is closed";	
	}
	


}//class ends
?>