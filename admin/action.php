<?php
	require '../db/db.php';
	
	$id = $_GET['id'];
	$title = $_GET['title'];
	
	$askrecent = $conn->query("SELECT * FROM jobs where id ='$id'");
	
	if ($askrecent->num_rows > 0) {
		while ($user = $askrecent->fetch_assoc()) {
			
			?>
			<div class="job-row">
				<div class="title">
					<h1>
						<?php echo $user['title'];
						?>
					</h1>
					<h4>
						<?php echo "KSH ". $user['price'];
						?>
					</h4>
					<p>
						<?php echo $user['details']; ?>
					</p>
				</div>
			</div>
		<?php }
	} ?>
</div>