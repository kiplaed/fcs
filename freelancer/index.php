<?php
session_start();
if (!isset($_SESSION['freelancer'])) {
    header('location:../auth/login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCS- Freelancer Dashboard</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <div class="container">
        <section class="sidebar">
            <div class="logo">
                <img src="../assets/images/logo.png" alt="fcs-logo">
            </div>
            <div class="nav">
                <!-- <li><ion-icon name="reload-circle-outline"></ion-icon><a href="#pending">Pending Tasks</a></li>
                <li><ion-icon name="checkmark-done-circle-outline"></ion-icon> <a href="#completed">Completed Tasks</a></li> -->
                <a href="#pending"><ion-icon name="reload-circle-outline"></ion-icon><span>Pending Tasks</span></a>
                <a href="#completed"><ion-icon name="checkmark-done-circle-outline"></ion-icon><span>Completed Tasks</span></a>
                <div class="hidden">
                    ggggg
                </div>
                <div class="profile">
                    <a href="profile.php"><ion-icon name="person-circle-outline"></ion-icon><span>Profile</span></a>
                    <div class="logout-btn">
                        <ion-icon name="log-out-outline"></ion-icon>
                        <form method="post" action="../db/auth.php">
                            <input type="submit" value="Logout" name="logout">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="mainbar">
            <section id="pending" class="section">
                <div class="title">
                    <h1>Pending Tasks</h1>
	                
	                <?php
		                
		                if (isset($_GET['status'])) {
			                $status = $_GET['status'];
			                if ($status = 'success') {
				                $message = $_GET['message'];
				                echo "<span>$message</span>";
			                }
		                } else {
		                }
	                ?>
                    <?php
                    require '../db/db.php';
                    $total = $conn->query("SELECT COUNT(*) as total FROM tasks WHERE status ='pending'");
                    if ($total->num_rows > 0) {
                        // Fetch the result as an associative array
                        $row = $total->fetch_assoc();
                    }
                    $fid = $_SESSION['freelancer'];
                    $asktasks = $conn->query("SELECT * FROM tasks WHERE fid='$fid' AND status='pending'");
                    if ($asktasks->num_rows > 0) {
                        while ($task = $asktasks->fetch_assoc()) { ?>

                            <h4>You Have(<?php echo $row['total']; ?>) pending tasks</h4>
                            <div class=" completed card">
                                <div class="card_title">
                                    <h3><?php echo $task['title']; ?></h3>
                                </div>
                                <form action="../db/auth.php?taskid=<?php echo $task['id']; ?>" method="post">
                                    <input class="button" type="submit" name="complete" value="Details">
                                </form>
                            </div>


                    <?php }
                    } ?>

                </div>
            </section>
            <section id="completed" class="section">
                <h1>Completed Tasks</h1>
                <?php
                require '../db/db.php';
                $total = $conn->query("SELECT COUNT(*) as total_rows FROM tasks WHERE status ='completed'");
                if ($total->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $total->fetch_assoc();
                }
                $fid = $_SESSION['freelancer'];
                $asktasks = $conn->query("SELECT * FROM tasks WHERE fid='$fid' AND status='completed'");
                if ($asktasks->num_rows > 0) {
                    while ($task = $asktasks->fetch_assoc()) { ?>

                        <h4>You Have(<?php echo $row['total_rows']; ?>) completed task(s)</h4>
                        <br>
                        <div class="card">
                            <div class="card_title">
                                <h3><?php echo $task['title']; ?></h3>
                            </div>
                        </div>

                <?php }
                } ?>

        </div>
    </div>
    <!-- <h1> Freelancer Dashboard</h1>
    <div class="logout-btn">
        <form method="post" action="../db/auth.php">
            <input type="submit" value="Logout" name="logout">
        </form>
        <i class="uil uil-arrow-circle-right"></i>
    </div> -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>