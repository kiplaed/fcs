<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <img src="../assets/images/logo.png" />
    <div class="logout-btn">
        <form method="post" action="../db/auth.php">
            <input type="submit" value="Logout" name="logout">
        </form>
        <i class="uil uil-arrow-circle-right"></i>
    </div>
    <div class="container">
        <div style="display:grid; grid-template-columns:repeat(3,auto);">
            <?php
            require '../db/db.php';

            $askjobs = $conn->query("SELECT * FROM jobs ");
            if ($askjobs->num_rows > 0) { // Fetch the first matching row
                while ($job = $askjobs->fetch_assoc()) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">
                                <?php echo $job['title'];
                                ?>
                            </h2>
                            <h6 class="card-title">
                                <?php echo $job['price'];
                                ?>
                            </h6>
                            <div class="button">
                                <?php
                                $userid = $job['user_id'];
                                $asknames = $conn->query("SELECT * FROM users WHERE id='$userid'");

                                if ($asknames->num_rows > 0) {
                                    $user = $asknames->fetch_assoc();
                                }
                                ?>
                                <a href="details.php?id=<?php echo $job['id']; ?>&title=<?php echo $job['title']; ?>&username=<?php echo $user['fullName'] ?>&pid=<?php echo $_SESSION['user']; ?>&fid=<?php echo $job['user_id'];?>" rel="noopener">View Details</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</body>

</html>