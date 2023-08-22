<?php
	include "../dbconnect.php";
	if(isset($_GET['category'])){
		$category = $_GET['category'];
		if(isset($_GET['limit'])){
			$limit = $_GET['limit'];
			$sql = "SELECT * FROM `notifications` WHERE deleted=0 AND category='$category' ORDER BY `priority` DESC LIMIT $limit";
			$result = mysqli_query($conn, $sql);
			$notifications = array();
			if($result){
				while($row=mysqli_fetch_array($result)){
					$obj = array(
						'title' => $row['title'],
						'category' => $row['category'],
						'attachment' => $row['attachment'],
						'priority' => $row['priority'],
					);
					array_push($notifications, json_encode($obj));
				}
				header("Content-Type: application/json");
				echo json_encode(array(
					'status' => 'success',
					'notifications' => $notifications,
				));
				exit();
			}else{
				die(mysqli_error($conn));
			}
		}else{
			$sql = "SELECT * FROM `notifications` WHERE deleted=0 AND category='$category' ORDER BY `priority` DESC";
			$result = mysqli_query($conn, $sql);
			$notifications = array();
			if($result){
				while($row=mysqli_fetch_array($result)){
					$obj = array(
						'title' => $row['title'],
						'category' => $row['category'],
						'attachment' => $row['attachment'],
						'priority' => $row['priority'],
					);
					array_push($notifications, json_encode($obj));
				}
				header("Content-Type: application/json");
				echo json_encode(array(
					'status' => 'success',
					'notifications' => $notifications,
				));
				exit();
			}else{
				die(mysqli_error($conn));
			}
		}
	}else{
		$sql = "SELECT * FROM `notifications` WHERE deleted=0 ORDER BY `priority` DESC";
		$result = mysqli_query($conn, $sql);
		$notifications = array();
		if($result){
			while($row=mysqli_fetch_array($result)){
				$obj = array(
					'title' => $row['title'],
					'category' => $row['category'],
					'attachment' => $row['attachment'],
					'priority' => $row['priority'],
				);
				array_push($notifications, json_encode($obj));
			}
			header("Content-Type: application/json");
			echo json_encode(array(
				'status' => 'success',
				'notifications' => $notifications,
			));
			exit();
		}else{
			die(mysqli_error($conn));
		}
	}
?>