<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['title']; ?></title>
    <link rel="stylesheet" href="assets/css/print.css" media="print">
</head>
<style>

    *{
        font-family:"Inter Medium",sans-serif;
    }
    :root {
        --background: #bababa;
        --backgroundv: #5a5a5a;
        --primary: rgb(31, 31, 31);
        --secondary: #efefef;
        --primaryLight: #312f2f;
        --secondarylight: #6c6d77;
        --success: rgb(125, 198, 141)84;
        --danger: rgb(251, 114, 114);
        --dangerhover: rgb(252, 96, 96);
    }

    body {
        background: #d4d4d4;
        width: 100%;
    }

    .container {
        align-self: center;
        padding: 20px 50px;
        width: max-content;
    }

    h1 {
        font-size: 60px;
        align-self: center;
    }

    .user_details {
        margin-top: -40px;
        width: auto;
        display: flex;
        align-items: center;
        padding: 10px;
        justify-content: space-between;
    }

    .back {
        position: absolute;
        top: 30px;
        left: 30px;
        display: flex;
        align-items: center;
        text-decoration: none;
        background: var(--secondary);
        padding: 5px;
        border-radius: 5px;
    }

    .button {
        margin-top: 20px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button form {
        width: 200px;
        height: 45px;
        padding: 5px;
        display: flex;
        align-items: center;
    }

    .button form input, .button button {
        width: 200px;
        cursor: pointer;
        height: 45px;
        background: var(--secondarylight);
        border: none;
        outline: none;
        border-radius: 5px;
        font: "Inter Medium",sans-serif;
    }

    .button form input:hover {
        background: var(--background);
    }
</style>

<body>
    <a href="index.php" class="back">
        <ion-icon name="chevron-back-outline"></ion-icon>
        Back
    </a>
    <div class="container">
        <?php
        require '../db/db.php';

        $id = $_GET['id'];
        $title = $_GET['title'];
        $pid = $_GET['pid'];
        $fid = $_GET['fid'];
        $askdetails = $conn->query("SELECT * FROM jobs where id ='$id'");

        if ($askdetails->num_rows > 0) {
            while ($details = $askdetails->fetch_assoc()) {

        ?>
                <div class="job-row">
                    <div class="title">
                        <h1>
                            <?php echo $details['title'];
                            ?>
                        </h1>
                    </div>
                    <div class="user_details">
                        <h4>By
                            <?php

                            $userid = $details['user_id'];
                            $askname = $conn->query("SELECT * FROM users WHERE id='$userid' ");
                            if ($askname->num_rows > 0) {
                                $name = $askname->fetch_assoc();
                            }
                            ?>
                            <?php echo $name['fullName'];
                            ?>
                        </h4>
                        <h4>
                            <?php echo "KSH " . $details['price'];
                            ?>
                        </h4>
                    </div>
                    <p>
                        <?php echo $details['details']; ?>
                    </p>
                    <div class="button">
                        <form action="../db/auth.php?title=<?php echo $details['title']; ?>&pid=<?php echo $pid; ?>&jid=<?php echo $details['id']; ?>&fid=<?php echo $fid; ?>" method="post">
                            <input  id="print-btn" class="button" type="submit" name="request" value="Request Service">
                        </form>
                    <div class="button">
                        <button onclick="window.print()" id="print-btn">PRINT SERVICE</button>
                    </div>
                </div>
        <?php }
        } ?>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>