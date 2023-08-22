<?php
		$conn = new mysqli('localhost', 'user', 'password', 'database');
		if(!$conn){
			die(mysqli_error($conn));
		}
?>