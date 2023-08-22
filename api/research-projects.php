<?php
	include "../dbconnect.php";
	if(isset($_GET['limit'])){
		$limit = $_GET['limit'];
		$sql = "SELECT * FROM `research-projects` WHERE deleted=0 ORDER BY `priority` DESC, `created_at` DESC, LIMIT $limit";
		$result = mysqli_query($conn, $sql);
		$projects = array();
		if($result){
			while($row=mysqli_fetch_array($result)){
				$obj = array(
					'investigator' => $row['investigator'],
					'agency' => $row['agency'],
					'title' => $row['title'],
					'profile' => $row['profile'],
					'priority' => $row['priority'],
					'attachment' => $row['attachment'],
				);
				array_push($projects, json_encode($obj));
			}
			header("Content-Type: application/json");
			echo json_encode(array(
				'status' => 'success',
				'projects' => $projects,
			));
			exit();
		}else{
			die(mysqli_error($conn));
		}
	}else{
		$sql = "SELECT * FROM `research-projects` WHERE deleted=0 ORDER BY `priority` DESC, `created_at` DESC";
		$result = mysqli_query($conn, $sql);
		$projects = array();
		if($result){
			while($row=mysqli_fetch_array($result)){
				$obj = array(
					'investigator' => $row['investigator'],
					'agency' => $row['agency'],
					'title' => $row['title'],
					'profile' => $row['profile'],
					'priority' => $row['priority'],
					'attachment' => $row['attachment'],
				);
				array_push($projects, json_encode($obj));
			}
			header("Content-Type: application/json");
			echo json_encode(array(
				'status' => 'success',
				'projects' => $projects,
			));
			exit();
		}else{
			die(mysqli_error($conn));
		}
	}
?>