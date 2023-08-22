<?php
	include "../../dbconnect.php";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "DELETE FROM `notifications` WHERE id=$id";
		$result = mysqli_query($conn, $sql);
		if($result){
			header('location:index.php');
		}else{
			die(mysqli_error($conn));
		}
	}
?>