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
            <h3>FCS</h3>
        </div>
        <div class="navbar">
            <div class="navbar-collapse">
                <a class="navbar-link" href="#projects">Projects</a>
                <a class="navbar-link" href="#about">About</a>
            </div>
        </div>
        <div class="profile">
            <ion-icon name="person-circle-outline"></ion-icon>
            <div class="logout-btn">
                <form method="post" action="../db/auth.php">
                    <input type="submit" value="Logout" name="logout">
                </form>
                <i class="uil uil-arrow-circle-right"></i>
            </div>
        </div>

        <!-- <div class="user-profile">
            <div class="name">
                <h3> <?php echo $_SESSION['username']; ?>
                </h3>
            </div>
        </div>-->
    </header>
    <div class="container users">

        <table>
            <thead>USERS</thead>
            <tr>
                <td><b>Id</b></td>
                <td><b>Email</b></td>
                <td><b>Name</b></td>
                <td><b>Username</b></td>
                <td><b>Role</b></td>
                <td><b>Actions</b></td>
            </tr>
            <?php
            require '../db/db.php';

            $askuser = $conn->query("SELECT * FROM users ");
            if ($askuser->num_rows > 0) {
                while ($user = $askuser->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo $user['id']; ?>
                        </td>
                        <td>
                            <?php echo $user['email']; ?>
                        </td>
                        <td>
                            <?php echo $user['fullName']; ?>
                        </td>
                        <td>
                            <?php echo $user['username']; ?>
                        </td>
                        <td>
                            <?php echo $user['role']; ?>
                        </td>
                        <td>
                            <?php echo "View Actions"; ?>
                        </td>
                    </tr>
                    <?php }
                } ?>
        </table>



    </div>
    <!-- <div class="p-5 rounded-4 m-3" style="width:100%;">
        <div style="display:grid; grid-template-columns:repeat(4,auto);">

            <?php
            require '../db/db.php';

            $askrecent = $conn->query("SELECT * FROM users ");

            if ($askrecent->num_rows > 0) { // Fetch the first matching row
                while ($user = $askrecent->fetch_assoc()) {

            ?>

                    <div class="card bg-secondary-subtle rounded-3" style="width:18rem; margin-bottom:.8em;">
                        <div class="card-body">
                            <h4 class="card-title">
                                <?php echo $user['fullName'];
                                ?>
                            </h4>
                            <h6 class="card-title">
                                <?php echo $user['username'];
                                ?>
                            </h6>
                            <p class="card-text">
                                <?php
                                echo $user['email'];

                                ?>
                            </p>
                            <p>
                                <?php echo $user['password'];
                                ?>
                            </p>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div> -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>