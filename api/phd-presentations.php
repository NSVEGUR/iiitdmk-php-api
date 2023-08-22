<?php
	include "../dbconnect.php";
	if(isset($_GET['category'])){
		$category = $_GET['category'];
			$sql = "SELECT * FROM `phd-presentations` WHERE deleted=0 AND category='$category' ORDER BY `date` DESC";
			$result = mysqli_query($conn, $sql);
			$presentations = array();
			if($result){
				while($row=mysqli_fetch_array($result)){
					$obj = array(
						'category' => $row['category'],
						'title' => $row['title'],
						'name' => $row['name'],
						'profile' => $row['profile'],
						'roll' => $row['roll'],
						'guide' => $row['guide'],
						'date' => $row['date'],
						'time' => $row['time'],
						'venue' => $row['venue'],
						'priority' => $row['priority'],
						'attachment' => $row['attachment'],
					);
					array_push($presentations, json_encode($obj));
				}
				header("Content-Type: application/json");
				echo json_encode(array(
					'status' => 'success',
					'presentations' => $presentations,
				));
				exit();
			}else{
				die(mysqli_error($conn));
			}
	}else{
		$sql = "SELECT * FROM `phd-presentations` WHERE deleted=0 ORDER BY `priority` DESC, `date` DESC LIMIT 5";
		$result = mysqli_query($conn, $sql);
		$presentations = array();
		if($result){
			while($row=mysqli_fetch_array($result)){
				$obj = array(
					'category' => $row['category'],
					'title' => $row['title'],
					'name' => $row['name'],
					'profile' => $row['profile'],
					'roll' => $row['roll'],
					'guide' => $row['guide'],
					'date' => $row['date'],
					'time' => $row['time'],
					'venue' => $row['venue'],
					'priority' => $row['priority'],
					'attachment' => $row['attachment'],
				);
				array_push($presentations, json_encode($obj));
			}
			header("Content-Type: application/json");
			echo json_encode(array(
				'status' => 'success',
				'presentations' => $presentations,
			));
			exit();
		}else{
			die(mysqli_error($conn));
		}
	}
?>