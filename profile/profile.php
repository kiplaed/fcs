<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $username = $_GET['username'];
            echo $username . " | Profile"; ?></title>
    <link rel="stylesheet" href="profile.css">

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
        <?php
        $uid =$profile['id'];
        $role = $_GET['role'];
        if($role=='user'){
            $showtasks = $conn->query("SELECT * FROM tasks WHERE uid='$uid'");
            if($showtasks->num_rows>0){
                while($showtask = $showtasks->fetch_assoc()){
                }
            }
        }elseif($role=='freelancer'){
            $id=$profile['id'];
            $showposts = $conn->query("SELECT * FROM jobs WHERE id='$id'");
            if($showposts->num_rows >0){
                while($showpost = $showposts->fetch_assoc()){
                }
            }
        }
        ?>
        <div class="card">
            <?php
            if($role =='user'){
                echo "Your Applied tasks";
            }elseif($role =='freelancer'){
                echo "Your Services";
            }
            ?>
        </div>

    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>