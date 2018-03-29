<?php
class Locate{
	
	public function redirect($link){
		echo '<script type="text/javascript" language="javascript" >
		
		window.location = "'.$link.'";
		
		</script>';
	}
}
?>