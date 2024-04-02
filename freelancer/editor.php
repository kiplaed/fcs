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
    <title>POST A SERVICE</title>
    <script src="../ckeditor/ckeditor.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-weight: 500;
            font-family: "Golos text", sans-serif;

        }

        :root {

            --text-color: rgb(245, 245, 245);
            --fw-medium: 500;
            --fw-strong: 700;
            --header-bg: #d3d3d3;
            --button-color: #373737;
            --button-h-color: #1a1a1a;
            --background: #868686a0;
        }


        section {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--header-bg);
        }


        .container {
            width: 600px;
            min-height: 380px;
            background: var(--background);
            border-radius: 3px;
            padding: 10px 20px;

        }

        .container h3 {
            margin-bottom: 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: underline;
        }
        textarea{
            height: 200px;
        }

        .container form {
            width: 100%;
            height: 500px;
            display: flex;
            flex-direction: column;
            margin: auto;
            justify-content: flex-start;

        }
        select{
            height: 40px;
            width: 100%;
        }

        .container form input {
            margin: auto;
            width: 100%;
            height: 40px;
            outline: none;
            font-size: 1.2em;
            padding: 0 10px;
            border: none;
            margin-bottom: 8px;
            border-radius: 5px;

        }

        .container form input[type="submit"] {
            width: 150px;
            height: 45px;
            border-radius: 8px;
            background: var(--button-color);
            transition: .5s ease-in-out;
            text-transform: uppercase;
            border: none;
            color: var(--text-color);
            margin-top: .5em;
        }

        .container form input[type="submit"]:hover {
            background: var(--button-h-color);
            box-shadow: 0 5px 15px rgba(1, 1, 1, .4);
            transition: .5s ease-in-out;
            margin-top: .5em;
        }
    </style>
</head>

<body>
    <section>
        <div class="container">
            <form action="../db/auth.php" method="post">
                <input type="text" name="title" id="title" placeholder="Title" required>
                <input type="text" name="price" id="price" placeholder="Price" required>
                <label for="category">ENTER CATEGORY</label>
                <select name="category" id="category">
                        <option value="gdesign">Graphic Design</option>
                        <option value="webdev">Web Development</option>
                        <option value="docs">Documentations</option>
                        <option value="business">Businesss</option>
                        <option value="app">Software Application</option>
                    </select>
                <label for="details">ENTER SERVICE DETAILS</label>
                <textarea type="text" name="details" placeholder="Enter Details" id="details" required></textarea>
            
                <input type="submit" name="post" value="POST SERVICE">
            </form>
        </div>
    </section>
    <script>
        CKEDITOR.replace('details');
    </script>
</body>

</html>