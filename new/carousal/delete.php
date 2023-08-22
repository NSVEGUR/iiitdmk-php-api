<?php
	include "../../dbconnect.php";
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$sql = "UPDATE `carousal` SET deleted='1' WHERE id=$id";
		$result = mysqli_query($conn, $sql);
		if($result){
			header('location:index.php');
		}else{
			die(mysqli_error($conn));
		}
	}
?>