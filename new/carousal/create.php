<?php
	include "../../dbconnect.php";
	if(isset($_POST['submit'])){
		$description = $_POST['description'];
		$title = $_POST['title'];
		$priority = $_POST['priority'] ? $_POST['priority'] : 0;
		$current_date = date("Y-m-d H:i:s");
		$created_at = $current_date;
		$updated_at = $current_date;
		$attachment = '';
		if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
			  $info = pathinfo($_FILES['attachment']['name']);
				$ext = $info['extension']; // get the extension of the file
				$FN =  $info['filename']; // get the Filename alone of the file
				$newname = $FN."-".date('dmYhis', time()).".".$ext;
				$target = 'attachments/'.$newname;
				$tmp_name = $_FILES['attachment']['tmp_name'];
				if(move_uploaded_file( $_FILES['attachment']['tmp_name'], $target)){
					$attachment = $target;
				}else{
					die("Error in uploading file.");
				}
		}
		$sql = "INSERT INTO `carousal` (description, title, priority, attachment, created_at, updated_at) VALUES ('$description', '$title', '$priority', '$attachment', '$created_at', '$updated_at')";
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
	<title>Carousal Creation | IIITDM Kancheepuram</title>
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
			<h1 class="text-center text-2xl mb-5 border-b text-skin-accent">New Carousal or Slide</h1>
			<div>
				<label for="title" class="block mb-2 text-sm font-medium">Title (If any): </label>
				<input name="title" type="text" class="w-full p-2.5 border rounded-lg bg-muted focus:outline-accent"
					placeholder="Title goes here" />
			</div>
			<div>
				<label for="description" class="block mb-2 text-sm font-medium">Description (If any): </label>
				<textarea name="description" rows="4"
					class="block p-2.5 w-full text-sm bg-muted focus:outline-accent rounded-lg border "
					placeholder="Write any description to be displayed here ..."></textarea>
			</div>
			<div>
				<label for="priority" class="block mb-2 text-sm font-medium">Priority - Important(Number): </label>
				<input name="priority" type="number" class="w-full p-2.5 border rounded-lg bg-muted focus:outline-accent"
					placeholder="Displayed based on priority order" />
			</div>
			<div>
				<label class="block mb-2 text-sm font-medium " for="attachment">Upload attachment*: </label>
				<input name="attachment" accept="image/*"
					class="block w-full text-sm border rounded-lg p-2.5 cursor-pointer bg-muted focus:outline-accent" type="file"
					required>
			</div>
			<button type="submit" name="submit"
				class="text-white bg-accent cursor-pointer hover:bg-accent-secondary focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5">
				Submit
			</button>
		</form>
	</main>

</body>

</html>