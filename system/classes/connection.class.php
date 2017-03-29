<?php

/**
 class is to connect with the database
*/
//require_once('config/config.php');

//echo $_SESSION['Host']; 

class Connection{

	private $user;
	private $password;
	private $host;
	private $db;

	public $sql;
	public $res;
	public $error;
	public $affRows;
	public $numRows;
	public $data = array(); // blank array

	public $conxn;

//$h = 'localhost', $u = 'itucnac_site', $p = 'HswldUQN*{Ji', $db = 'itucnac_site'
//$h = 'localhost',  $u = 'root', $p = '', $db = 'db_bedc'
	public function __construct()
	{	
		$this->host=Host;
		$this->user=User;
		$this->password=Password;
		$this->db=Db;
		$this->conxn=mysqli_connect($this->host, $this->user, $this->password, $this->db)
				or trigger_error($this->error = mysqli_error($this->conxn));
	
//echo "<br /> The database is ready to serve! ";	
	}
	
	public function close(){
	mysqli_close($this->conxn);
	//echo "<br /> The connection is closed";	
	}
	


}//class ends
?>