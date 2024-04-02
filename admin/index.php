<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCS - Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"><img src="../assets/images/logo.png" alt="logo"></a>
        </div>
        <div class="profile">
            Signed in as <?php echo $_SESSION['username']; ?>
        </div>
    </header>
    <div class="container">
        <div class="side">
            <a href="#users" class="link"> <ion-icon name="people-outline"></ion-icon> Users</a>
            <a href="#services" class="link"><ion-icon name="library-outline"></ion-icon> Services</a>
            <a href="create-admin.php" class="link"><ion-icon name="person-add"></ion-icon> Create Admin</a>
            <div class="logout-btn">
                <form method="post" action="../db/auth.php">
                    <input type="submit" value="Logout" name="logout">
                </form>
            </div>
        </div>
        <div class="main">
            <section class="users" id="users">
                <h1>Users</h1>
                <div class="row">
                    <div class="row_id">
                        <h6>Id</h6>
                    </div>
                    <div class="row_name">
                        <h6>Name</h6>
                    </div>
                    <div class="row_username">
                        <h6>Username</h6>
                    </div>
                    <div class="row_email">
                        <h6>Email</h6>
                    </div>
                    <div class="row_role">
                        <h6>User Type</h6>
                    </div>
                    <div class="row_action">
                        <h6>Action</h6>
                    </div>
                </div>
                <?php
                require '../db/db.php';
                $users = $conn->query("SELECT * FROM users WHERE role !='admin'");
                if ($users->num_rows > 0) {
                    while ($user = $users->fetch_assoc()) { ?>

                        <div class="row">
                            <div class="row_id">
                                <p><?php echo $user['id']; ?></p>
                            </div>
                            <div class="row_name">
                                <p><?php echo $user['fullName']; ?></p>
                            </div>
                            <div class="row_username">
                                <p><?php echo $user['username']; ?></p>
                            </div>
                            <div class="row_email">
                                <p><?php echo $user['email']; ?></p>
                            </div>
                            <div class="row_role">
                                <p> <?php echo $user['role']; ?> </p>
                            </div>
                            <div class="row_action">
                                <a href="view.php?userid=<?php echo $user['id']; ?>">View</a>
                            </div>
                        </div>
                <?php }
                } ?>
            </section>
            <section class="services" id="services">
                <h1>All Services</h1>
                <div class="cards">
                    <?php
                    require '../db/db.php';
                    $services = $conn->query("SELECT * FROM jobs");
                    if ($services->num_rows > 0) {
                        while ($service = $services->fetch_assoc()) { ?>
                            <div class="card">
                                <div class="card_title">
                                    <h3>
                                        <ion-icon name="bookmarks"></ion-icon> <?php echo $service['title']; ?>
                                    </h3>
                                </div>
                                <div class="card_user">
                                    <p> <ion-icon name="person-circle"></ion-icon> <?php
                                                                                    $userid = $service['user_id'];
                                                                                    $users = $conn->query("SELECT * FROM users where id ='$userid'");
                                                                                    if ($users->num_rows > 0) {
                                                                                        $user = $users->fetch_assoc();
                                                                                    }

                                                                                    echo $user['fullName']; ?>
                                    </p>
                                    <p><ion-icon name="cash"></ion-icon> <?php echo $service['price']; ?> </p>
                                </div>
                                <div class="card_details">
                                    <p>
                                        <?php echo $service['details']; ?>
                                    </p>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </section>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>