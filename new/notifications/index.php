<?php
	include "../../dbconnect.php";
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="../styles.css" rel="stylesheet">
	<title>Notifications | IIITDM Kancheepuram</title>
</head>


<body>
	<main class="flex flex-col gap-5 w-screen h-screen items-center justify-center px-5 text-black">

		<h1 class="text-4xl text-start mb-5 border-b">Notifications</h1>
		<a href="create.php" class="p-2 bg-accent rounded-md text-skin-inverted self-start">Add New</a>
		<div class="relative overflow-x-auto w-full">

			<table class="w-full text-sm text-left border border-base">
				<thead class="text-xs uppercase  bg-muted-secondary">
					<tr>
						<th scope="col" class="px-6 py-3">
							Id
						</th>
						<th scope="col" class="px-6 py-3">
							Title
						</th>
						<th scope="col" class="px-6 py-3">
							Category
						</th>
						<th scope="col" class="px-6 py-3">
							Attachment
						</th>
						<th scope="col" class="px-6 py-3">
							Download
						</th>
						<th scope="col" class="px-6 py-3">
							Priority
						</th>
						<th scope="col" class="px-6 py-3">
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM `notifications` WHERE deleted=0  ORDER BY `created_at` DESC";
						$result = mysqli_query($conn, $sql);
						if($result){
							while($row=mysqli_fetch_array($result)){
								$id=$row['id'];
								$title=$row['title'];
								$category=$row['category'];
								$attachment=$row['attachment'];
								$priority=$row['priority'];
								echo '<tr class="bg-white border-b border-base">
									<th scope="row" class="px-6 py-4">
										'.$id.'
									</th>
									<td class="px-6 py-4 whitespace-nowrap font-medium">
										'.$title.'
									</td>
									<td class="py-4 px-2 ">
										'.$category.'
									</td>
									<td class="px-6 py-4">
										'.$attachment.'
									</td>
									<td class="px-6 py-4 flex">
										<a href="'.$attachment.'" download class="bg-accent text-skin-inverted rounded-md" style="padding: 4px;">
										<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
											style="
											width: 20px;
											height: 20px;
											">
											<path stroke-linecap="round" stroke-linejoin="round"
												d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
										</svg>
										</a>
									</td>
									<td class="px-6 py-4">
										'.$priority.'
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