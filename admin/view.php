<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 500;
            font-family: "Golos text", sans-serif;

        }

        :root {

            --text-color: #000;
            --fw-medium: 500;
            --fw-strong: 700;
            --header-bg: #d3d3d3;
            --button-color: #373737;
            --button-h-color: #1a1a1a;
            --background: #868686a0;
        }

        .container {
            padding: 20px 40px;
        }


        .job-row {
            padding: 5px 50px;
            background: var(--background);
            color: var(--text-color);
            margin: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;

        }

        .job-row h1 {
            font-weight: 500;
            margin-bottom: .4em;
        }
    </style>
</head>

<body>

    <div class="container">

        <?php
        require '../db/db.php';
		  

        $askrecent = $conn->query("SELECT * FROM jobs ");

        if ($askrecent->num_rows > 0) { // Fetch the first matching row
            while ($user = $askrecent->fetch_assoc()) {

        ?>
                <div class="job-row">
                    <div class="title">
                        <h1>
                            <?php echo $user['title'];
                            ?>
                        </h1>
                        <h4>
                            <?php echo "KSH " . $user['price'];
                            ?>
                        </h4>
                    </div>
                    <a href="action.php?id=<?php echo $user['id']; ?>&title=<?php echo $user['title']; ?>" rel="noopener">View Details</a>
                </div>
        <?php }
        } ?>
    </div>

</body>

</html>