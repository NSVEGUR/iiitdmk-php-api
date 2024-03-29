<?php
	include "../../dbconnect.php";
	$id=$_GET['id'];
	$sql="SELECT * FROM `notifications` WHERE id=$id";
	$result=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	$title=$row['title'];
	$category=$row['category'];
	$priority=$row['priority'];
	$attachment=$row['attachment'];
	if(isset($_POST['submit'])){
		$category = $_POST['category'];
		$title = $_POST['title'];
		$priority = $_POST['priority'] ? $_POST['priority'] : 0;
		$current_date = date("Y-m-d H:i:s");
		$attachment = $row['attachment'];
		if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
			  $info = pathinfo($_FILES['attachment']['name']);
				$ext = $info['extension']; // get the extension of the file
				$FN =  $info['filename']; // get the Filename alone of the file
				$newname = $FN."-".date('dmYhis', time()).".".$ext;
				$target = 'attachments/'.$newname;
				if(move_uploaded_file( $_FILES['attachment']['tmp_name'], $target)){
					$attachment = $target;
				}else{
					die("Error in uploading file.");
				}
		}
		$sql = "UPDATE `notifications` set category='$category', title='$title', priority='$priority', updated_at='$current_date', attachment='$attachment' WHERE id=$id";
		$result = mysqli_query($conn, $sql);
		if($result){
			header('location:index.php');
		}else{
			die(mysqli_error($conn));
		}
	}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="../styles.css" rel="stylesheet">
	<title>Notification Updation | IIITDM Kancheepuram</title>
</head>

<body>
	<main class="flex flex-col w-screen h-screen items-center justify-center px-5 text-black">
		<form class="w-full max-w-[600px] flex flex-col gap-5" method="POST" enctype="multipart/form-data">
			<a href="index.php"
				class="flex items-center justify-center gap-1 self-start mb-5 p-2 bg-error text-skin-inverted rounded-md"><svg
					xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
					class="h-4 w-4">
					<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
				</svg>
				Go Back</a>
			<h1 class="text-center text-2xl mb-5 border-b text-skin-accent">Update Notification</h1>
			<?php
				echo '
					<div>
					<label for="category" class="block mb-2 text-sm font-medium">Select Notification
						Category</label>
					<select name="category"
						value='.$category.'
						class="cursor-pointer bg-muted focus:outline-accent border text-sm rounded-lg block w-full p-2.5">
						<option value="Achievements" '.($category=='Achievements' ? "selected" : "").'>Achievements</option>
						<option value="Announcements" '.($category=='Announcements' ? "selected" : "").'>Announcements</option>
						<option value="Events" '.($category=='Events'  ? "selected" : "").'>Events</option>
						<option value="Publications" '.($category=='Publications' ? "selected" : "").'>Publications</option>
					</select>
				</div>
			<div>
				<label for="title" class="block mb-2 text-sm font-medium">Title/Description: </label>
				<textarea name="title" rows="4"
					class="block p-2.5 w-full text-sm bg-muted focus:outline-accent rounded-lg border "
					placeholder="Write Title or Description of the notification here ..." required>'.$title.'</textarea>
			</div>
			<div>
				<label for="priority" class="block mb-2 text-sm font-medium">Priority (Number): </label>
				<input name="priority" type="number" class="w-full p-2.5 border rounded-lg bg-muted focus:outline-accent"
					value='.$priority.' placeholder="Displayed based on priority order"/>
			</div>
			<div>
				<p class="block mb-2 text-sm font-medium">Old attachment: </p>
				<div class="w-full flex gap-2 p-2.5 border rounded-lg bg-muted">
					<p>'.$attachment.'</p>
					<a href="'.$attachment.'" download class="bg-accent text-skin-inverted rounded-md" style="padding: 4px;">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" style="
											width: 20px;
											height: 20px;
											">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
						</svg>
					</a>
				</div>
			</div>
			<div>
				<label class="block mb-2 text-sm font-medium " for="attachment">Upload new attachment(If required to rewrite):
				</label>
				<input name="attachment"
					class="block w-full text-sm border rounded-lg p-2.5 cursor-pointer bg-muted focus:outline-accent" type="file"
					value='.$attachment.'>
			</div>
			';
			?>
			<button type="submit" name="submit"
				class="text-white bg-accent cursor-pointer hover:bg-accent-secondary focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
				Submit
			</button>
		</form>
	</main>

</body>

</html>