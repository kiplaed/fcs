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
    <div class="profile">
        <div class="icon">
            <ion-icon name="person-circle-outline"></ion-icon>
        </div>
        <div class="details">
            <div class="name">
                <h1><?php echo $profile['fullName']; ?></h1>
            </div>
            <div class="username">
                <?php echo "@" . $profile['username']; ?>
            </div>
            <div class="email">
                <?php echo $profile['email']; ?>
            </div>
        </div>
    </div>
    <div class="section">
        <h1>Your Services</h1>
        <?php
        require '../db/db.php';
        $userid = $_GET['id'];
        $showtasks = $conn->query("SELECT * FROM tasks WHERE uid ='$userid'");
        if ($showtasks->num_rows > 0) {
            while ($showtask = $showtasks->fetch_assoc()) { ?>
                <div class="row">
                    <div class="title">
                        <?php echo $showtask['title']; ?>
                    </div>
                </div>
        <?php  }
        }
        ?>


    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>