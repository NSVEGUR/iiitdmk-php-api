<?php
	include "../../dbconnect.php";
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="../styles.css" rel="stylesheet">
	<title>PhD Presentations | IIITDM Kancheepuram</title>
</head>


<body>
	<main class="flex flex-col gap-5 w-screen h-screen items-center justify-center px-5 text-black">

		<h1 class="text-4xl text-start mb-5 border-b">PhD Presentations</h1>
		<a href="create.php" class="p-2 bg-accent rounded-md text-skin-inverted self-start">Add New</a>
		<div class="relative overflow-x-auto w-full">

			<table class="w-full text-sm text-left border border-base">
				<thead class="text-xs uppercase  bg-muted-secondary">
					<tr>
						<th scope="col" class="px-6 py-3">
							Id
						</th>
						<th scope="col" class="px-6 py-3">
							Category
						</th>
						<th scope="col" class="px-6 py-3">
							Title
						</th>
						<th scope="col" class="px-6 py-3">
							Name
						</th>
						<th scope="col" class="px-6 py-3">
							Profile
						</th>
						<th scope="col" class="px-6 py-3">
							Roll
						</th>
						<th scope="col" class="px-6 py-3">
							Guide
						</th>
						<th scope="col" class="px-6 py-3">
							Date
						</th>
						<th scope="col" class="px-6 py-3">
							Time
						</th>
						<th scope="col" class="px-6 py-3">
							Venue
						</th>
						<th scope="col" class="px-6 py-3">
							Priority
						</th>
						<th scope="col" class="px-6 py-3">
							Attachment
						</th>
						<th scope="col" class="px-6 py-3">
						</th>
						<th scope="col" class="px-6 py-3">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM `phd-presentations` WHERE deleted=0 ORDER BY `created_at` DESC";
						$result = mysqli_query($conn, $sql);
						if($result){
							while($row=mysqli_fetch_array($result)){
								$id=$row['id'];
								$category=$row['category'];
								$title=$row['title'];
								$name = $row['name'];
								$profile = $row['profile'];
								$roll = $row['roll'];
								$guide = $row['guide'];
								$date = $row['date'];
								$time = $row['time'];
								$venue = $row['venue'];
								$priority = $row['priority'];
								$attachment=$row['attachment'];
								echo '<tr class="bg-white border-b border-base">
									<th scope="row" class="px-6 py-4">
										'.$id.'
									</th>
									<td class="py-4 px-2 ">
										'.$category.'
									</td>
									<td class="px-6 py-4 font-medium">
										'.$title.'
									</td>
									<td class="px-6 py-4">
										'.$name.'
									</td>
									<td class="px-6 py-4">
										<img src="'.$profile.'" alt="profile" style="
											height: 50px;
											object-fit: cover;
											border-radius: 50%;
										" />
									</td>
									<td class="px-6 py-4">
										'.$roll.'
									</td>
									<td class="px-6 py-4">
										'.$guide.'
									</td>
									<td class="px-6 py-4">
										'.$date.'
									</td>
									<td class="px-6 py-4">
										'.$time.'
									</td>
									<td class="px-6 py-4">
										'.$venue.'
									</td>
									<td class="px-6 py-4">
										'.$priority.'
									</td>
									<td class="px-6 py-4">
										<a href="'.$attachment.'" download class="bg-accent text-skin-inverted rounded-md" style="padding: 4px;">
										Download
										</a>
									</td>
									<td class="py-2 px-1 flex gap-2">
										<a href="update.php?id='.$id.'" class="font-medium bg-accent p-2 text-skin-inverted rounded-md w-[75px] text-center">Edit</a>
										<a href="delete.php?id='.$id.'" class="font-medium bg-error p-2 text-skin-inverted rounded-md w-[75px] text-center">Delete</a>
									</td>
								</tr>';
							}
						}
					?>

				</tbody>
			</table>
		</div>
	</main>
</body>

</html>