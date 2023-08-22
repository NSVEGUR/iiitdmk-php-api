<?php
		$conn = new mysqli('localhost', 'iiitdm', 'Iiitdm@579', 'iiitdmk');
		if(!$conn){
			die(mysqli_error($conn));
		}
?>