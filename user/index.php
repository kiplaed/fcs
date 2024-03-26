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
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="../assets/images/logo.png" />
        </div>
        <div class="prof_tab">
            <div class="user">
                <a href="profile.php?username=<?php echo $_SESSION['username']; ?>&id=<?php echo $_SESSION['user']; ?>"><?php echo $_SESSION['username']; ?></a>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="cards">
            <?php
            require '../db/db.php';
            $askjobs = $conn->query("SELECT * FROM jobs ");
            if ($askjobs->num_rows > 0) { // Fetch the first matching row
                while ($job = $askjobs->fetch_assoc()) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">
                                <?php echo $job['title'];
                                ?>
                            </h3>
                            <h6 class="card-title">
                                Ksh 
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
                                <a href="details.php?id=<?php echo $job['id']; ?>&title=<?php echo $job['title']; ?>&username=<?php echo $user['fullName'] ?>&pid=<?php echo $_SESSION['user']; ?>&fid=<?php echo $job['user_id']; ?>" rel="noopener">View Details</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>