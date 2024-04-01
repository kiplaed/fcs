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
    <title><?php $username = $_GET['username'];
            echo $username . " | Profile"; ?></title>
    <link rel="stylesheet" href="../assets/css/profile.css">

</head>

<body>
    <?php
    require '../db/db.php';
    $username = $_GET['username'];
    $profiles = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($profiles->num_rows > 0) {
        $profile = $profiles->fetch_assoc();
    }
    ?>
    <a href="index.php" class="back">
        <ion-icon name="chevron-back-outline"></ion-icon>
        Back
    </a>
    <div class="logout-btn">
        <form method="post" action="../db/auth.php">
            <input type="submit" value="Logout" name="logout">
        </form>
    </div>
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
                <p>
                    <ion-icon name="mail-unread-outline"></ion-icon>
                    <?php echo $profile['email']; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="section">
        <h1>Your Services</h1>
        <div class="rows">
            <?php
            require '../db/db.php';
            $userid = $_GET['id'];
            $showservices = $conn->query("SELECT * FROM jobs WHERE user_id ='$userid'");
            if ($showservices->num_rows > 0) {
                while ($showservice = $showservices->fetch_assoc()) { ?>
                    <div class="freelance">
                        <div class="title">
                            <h2><?php echo $showservice['title']; ?></h2>
                        </div>
                        <div class="fdetails">
                            <?php echo $showservice['details']; ?>
                        </div>
                        <div class="cancel">
                            <form action="../db/auth.php?id=<?php echo $showservice['id']; ?>" method="post">
                                <input type="submit" name="delete" value="Delete Service">
                            </form>
                        </div>
                    </div>
            <?php  }
            }
            ?>
            <div class="editor">
                <a href="editor.php"> <ion-icon name="add-circle"></ion-icon></a>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>