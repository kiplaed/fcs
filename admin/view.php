<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --background: #d4d4d4;
        --backgroundv: #afafb1;
        --primary: rgb(31, 31, 31);
        --secondary: #3e3e3e;
        --primaryLight: #312f2f;
        --secondarylight: #b5bbfe;
        --success: rgb(125, 198, 141) 84;
        --danger: rgb(251, 114, 114);
        --dangerhover: rgb(252, 96, 96);
    }

    body {
        width: 100%;
        height: 100%;
        background: var(--background);
    }

    .back {
        margin: 30px;
        height: 30px;
        width: 60px;
        display: flex;
        align-items: center;
        text-decoration: none;
        background: var(--secondary);
        padding: 5px;
        border-radius: 5px;
        font-size: 16px;
    }

    .profile {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 10px 120px;
    }

    .profile .icon {
        font-size: 200px;
    }

    .user {
        padding: 20px 10px;
        width: max-content;
    }

    .name {
        font-size: 40px;
    }

    .role {
        display: flex;
        justify-content: space-between;
        align-items: start;
    }

    p {
        display: flex;
        align-items: center;
    }

    .role p:nth-child(2) {
        background: var(--secondarylight);
        padding: 2px 5px;
        border-radius: 6px;
    }

    .role p:nth-child(2) ion-icon {
        margin-right: 3px;
    }

    .cards {
        padding: 20px 40px;
        display: grid;
        grid-template-columns: repeat(4, 280px);
        gap: 5px;
    }

    .rows {
        padding: 10px 50px;
        display: grid;
        grid-template-columns: repeat(3, 350px);
        gap: 5px;
    }

    .card {
        width: 280px;
        height: 130px;
        padding: 10px;
        background: var(--secondarylight);
        border-radius:8px;
    }
    .row{
        width: 350px;
        height: auto;
        padding:10px;
        border-radius:8px;
        background: var(--secondarylight);
    }
    .row .details{
        padding: 10px 20px;
    }
    .row .details ul{
        padding: 10px 30px;
    }
    .row_title{
        display: flex;
        align-items: center;
        justify-content:space-between;
    }
</style>
<div class="nav">
    <a href="index.php" class="back">
        <ion-icon name="chevron-back-outline"></ion-icon>
        Back
    </a>
</div>

<body class="view">
    <section class="profile">
        <?php
        require '../db/db.php';
        $userid = $_GET['userid'];
        $profiles = $conn->query("SELECT * FROM users WHERE id='$userid'");
        if ($profiles->num_rows > 0) {
            $profile = $profiles->fetch_assoc();
        }
        ?>
        <div class="icon">
            <ion-icon name="person-circle"></ion-icon>
        </div>
        <div class="user">
            <div class="name">
                <h1><?php echo $profile['fullName']; ?></h1>
            </div>
            <div class="role">
                <p> <ion-icon name="at"></ion-icon><?php echo $profile['username']; ?> </p>
                <p> <ion-icon name="pricetags-outline"></ion-icon> <?php echo $profile['role']; ?> </p>
            </div>
            <div class="email">
                <p> <ion-icon name="mail"></ion-icon> <?php echo $profile['email']; ?> </p>
            </div>
        </div>
    </section>
    <section class="all">
        <div class="cards">

            <?php
            $user = $profile['role'];
            $userid = $profile['id'];
            if ($user == 'user') {
                $tasks = $conn->query("SELECT * FROM tasks WHERE uid = '$userid'");
                if ($tasks->num_rows > 0) {
                    while ($task = $tasks->fetch_assoc()) { ?>
                        <div class="card">
                            <div class="card_title">
                                <h3> <?php echo $task['title']; ?></h3>
                            </div>
                            <div class="card_details">
                                <div class="by">
                                    <?php
                                    $fid = $task['fid'];
                                    $freelancers = $conn->query("SELECT * FROM users WHERE id ='$fid' ");
                                    if ($freelancers->num_rows > 0) {
                                        $freelancer = $freelancers->fetch_assoc();
                                    }
                                    ?>
                                    
                                    <p>By: <?php echo $freelancer['fullName']; ?></p>
                                </div>
                                <div class="status">
                                    <p><strong>User Status:&nbsp;</strong> <u> <?php echo$task['user_status'];?> </u></p>
                                    <p><strong>Status:&nbsp;</strong> <u><?php echo $task['status'];?></u></p>
                                </div>

                            </div>

                        </div>
            <?php }
                } else {
                    echo "No Services Requested";
                }
            } else {
            } ?>
        </div>
        <div class="rows">
            <?php
            $user = $profile['role'];
            $userid = $profile['id'];
            if ($user == 'freelancer') {
                $services = $conn->query("SELECT * FROM jobs WHERE user_id='$userid'");
                if ($services->num_rows > 0) {
                    while ($service = $services->fetch_assoc()) { ?>
                        <div class="row">
                            <div class="row_title">
                                <h3>
                                    <?php echo $service['title']; ?>
                                </h3>
                                <p> <?php echo"KSH. ". $service['price'];?> </p>
                            </div>
                            <div class="details">
                                <?php echo $service['details']; ?>
                            </div>
                        </div>
            <?php }
                } else {
                    echo "No Services Created";
                }
            } else {
            } ?>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>