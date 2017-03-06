<?php

require_once('config/config.php');
require_once('connection.class.php');
class Service extends Connection{

	public function get_table_name_list(){
		
		$this->sql = "show tables";
		$this->res = mysqli_query ( $this->conxn, $this->sql ) or trigger_error ( $this->error = mysqli_error ( $this->conxn ) );
		$this->numRows = mysqli_num_rows ( $this->res );
		$this->data = array ();
		if ($this->numRows > 0) {
			while ( $this->row = mysqli_fetch_object ( $this->res ) ) {
				array_push ( $this->data, $this->row );
			} // while ends
		} // if ends
		return $this->data;
		return($table);
	}
	
	public function get_table_fields_name( $table){
		//this block find number of fields of table in database------------------------------------------------------
		$this->sql = "SELECT * FROM " . $table . "";
		$this->res = mysqli_query ( $this->conxn, $this->sql ) or die ( $this->error = mysqli_error ( $this->conxn ) );
		$fieldcount=mysqli_num_fields($this->res);
		$field = mysqli_fetch_fields($this->res);
		return $field;						
	}//function ends

	public function listFolderFiles($dir){
    $ffs = scandir($dir);
    $outPut= '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            $outPut .= '<li>'.$ff;
            if(is_dir($dir.'/'.$ff)) {$this.listFolderFiles($dir.'/'.$ff);}
            $outPut .= '</li>';
        }
    }
    $outPut .= '</ol>';
    return $outPut;
	}


}//class ends
?>