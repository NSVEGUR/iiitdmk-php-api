<?php 
	include "../dbconnect.php";
	$sql = "SELECT * FROM `carousal` WHERE deleted=0 ORDER BY `priority` DESC";
	$result = mysqli_query($conn, $sql);
	$carousal = array();
	if($result){
		while($row=mysqli_fetch_array($result)){
			$obj = array(
				'title' => $row['title'],
				'description' => $row['description'],
				'attachment' => $row['attachment'],
				'priority' => $row['priority'],
			);
			array_push($carousal, json_encode($obj));
		}
		header("Content-Type: application/json");
		echo json_encode(array(
			'status' => 'success',
			'carousal' => $carousal,
		));
		exit();
	}else{
		die(mysqli_error($conn));
	}
?>