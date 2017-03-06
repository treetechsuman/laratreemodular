<?php
class Locate{
	
	public function Locate($link){
		echo '<script type="text/javascript" language="javascript" >
		
		window.location = "'.$link.'";
		
		</script>';
	}
}
?>