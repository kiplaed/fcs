<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $username = $_GET['username'];
            echo $username . " | Profile"; ?></title>
    <link rel="stylesheet" href="../assets/css/profile.css">

</head>

<body>
<a href="index.php" class="back">
        <ion-icon name="chevron-back-outline"></ion-icon>
        Back
    </a>
    <div class="logout-btn">
        <form method="post" action="../db/auth.php">
            <input type="submit" value="Logout" name="logout">
        </form>
    </div>
    <?php
    require '../db/db.php';
    $username = $_GET['username'];
    $profiles = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($profiles->num_rows > 0) {
        $profile = $profiles->fetch_assoc();
    }
    ?>
    <div class="profile">
        <div class="icon">
            <ion-icon name="person-circle-outline"></ion-icon>
        </div>
        <div class="details">
            <div class="name">
                <h1><?php echo $profile['fullName']; ?></h1>
            </div>
            <div class="username">
                <p>
                    <ion-icon name="at-outline"></ion-icon>
                    <?php echo $profile['username']; ?>
                </p>
            </div>
            <div class="email">
                <ion-icon name="mail-unread-outline"></ion-icon>
                <?php echo $profile['email']; ?>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">

            <h1>Requested Services</h1>
            <div class="rows">
                <?php
                require '../db/db.php';
                $userid = $_GET['id'];
                $showtasks = $conn->query("SELECT * FROM tasks WHERE uid ='$userid' AND status='pending'");
                if ($showtasks->num_rows > 0) {
                    while ($showtask = $showtasks->fetch_assoc()) { ?>
                        <div class="row">
                            <div class="title">
                                <h4><ion-icon name="bookmarks-outline"></ion-icon> <?php echo $showtask['title']; ?></h3>
                            </div>
                            <div class="provider">
                                <?php
                                $fid = $showtask['fid'];
                                $fname = $conn->query("SELECT * FROM users where id='$fid'");
                                if ($fname->num_rows > 0) {
                                    $name = $fname->fetch_assoc();
                                }
                                ?>
                                <?php
                                $fid = $showtask['jid'];
                                $prices = $conn->query("SELECT * FROM jobs where id='$fid'");
                                if ($prices->num_rows > 0) {
                                    $price = $prices->fetch_assoc();
                                }
                                ?>
                                <p><ion-icon name="person-outline"></ion-icon><?php echo $name['fullName']; ?></p>
                                <p>Ksh. <?php echo $price['price']; ?></p>
                            </div>
                            <p><ion-icon name="mail-outline"></ion-icon><?php echo $name['email']; ?></p>
                            <div class="cancel">
                                <form action="../db/auth.php?jid=<?php echo $showtask['jid']; ?>" method="post">
                                    <input type="submit" name="cancel" value="Cancel Request">
                                </form>
                            </div>
                        </div>
                <?php  }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">

            <h1>Completed Awaiting Your Approval</h1>
            <div class="rows">
                <?php
                require '../db/db.php';
                $userid = $_GET['id'];
                $showtasks = $conn->query("SELECT * FROM tasks WHERE uid ='$userid' AND status='completed' AND user_status='awaiting'");
                if ($showtasks->num_rows > 0) {
                    while ($showtask = $showtasks->fetch_assoc()) { ?>
                        <div class="row">
                            <div class="title">
                                <h4><ion-icon name="bookmarks-outline"></ion-icon> <?php echo $showtask['title']; ?></h3>
                            </div>
                            <div class="provider">
                                <?php
                                $fid = $showtask['fid'];
                                $fname = $conn->query("SELECT * FROM users where id='$fid'");
                                if ($fname->num_rows > 0) {
                                    $name = $fname->fetch_assoc();
                                }
                                ?>
                                <?php
                                $fid = $showtask['jid'];
                                $prices = $conn->query("SELECT * FROM jobs where id='$fid'");
                                if ($prices->num_rows > 0) {
                                    $price = $prices->fetch_assoc();
                                }
                                ?>
                                <p><ion-icon name="person-outline"></ion-icon><?php echo $name['fullName']; ?></p>
                                <p>Ksh. <?php echo $price['price']; ?></p>
                            </div>
                            <p><ion-icon name="mail-outline"></ion-icon><?php echo $name['email']; ?></p>
                            <div class="cancel">
                                <form action="../db/auth.php?jid=<?php echo $showtask['jid']; ?>" method="post">
                                    <input type="submit" name="approve" value="Approve">
                                </form>
                            </div>
                        </div>
                <?php  }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">

            <h1>Approved/Completed</h1>
            <div class="rows">
                <?php
                require '../db/db.php';
                $userid = $_GET['id'];
                $showtasks = $conn->query("SELECT * FROM tasks WHERE uid ='$userid' AND status='completed' AND user_status='approved'");
                if ($showtasks->num_rows > 0) {
                    while ($showtask = $showtasks->fetch_assoc()) { ?>
                        <div class="row">
                            <div class="title">
                                <h4><ion-icon name="bookmarks-outline"></ion-icon> <?php echo $showtask['title']; ?></h3>
                            </div>
                            <div class="provider">
                                <?php
                                $fid = $showtask['fid'];
                                $fname = $conn->query("SELECT * FROM users where id='$fid'");
                                if ($fname->num_rows > 0) {
                                    $name = $fname->fetch_assoc();
                                }
                                ?>
                                <?php
                                $fid = $showtask['jid'];
                                $prices = $conn->query("SELECT * FROM jobs where id='$fid'");
                                if ($prices->num_rows > 0) {
                                    $price = $prices->fetch_assoc();
                                }
                                ?>
                                <p><ion-icon name="person-outline"></ion-icon><?php echo $name['fullName']; ?></p>
                                <p>Ksh. <?php echo $price['price']; ?></p>
                            </div>
                            <p><ion-icon name="mail-outline"></ion-icon><?php echo $name['email']; ?></p>
                        </div>
                <?php  }
                }
                ?>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>