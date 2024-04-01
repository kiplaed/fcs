<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register and Login</title>
    <!-- <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" /> -->
    <link rel="stylesheet" href="../assets/css/login.css" />
</head>

<body>
    <div class="logo">
        <a href="../"><img src="../assets/images/logo-white.png" alt="Logo" /></a>
    </div>
    <div class="container active">
        <div class="signup">
            <form action="../db/auth.php" method="post" onsubmit="return validateForm()">
                <h1>Sign Up</h1>
                <span id="emailError" class="error"></span>
                <h5>
                    <input type="email" name="email" id="email" placeholder="Email" required />
                </h5>
                <h5>
                    <input type="text" name="fullName" id="fullName" placeholder="Name" required />
                </h5>
                <h5>
                    <input type="text" name="username" id="username" placeholder="Username" />
                </h5>
                <h5>
                    <input type="password" name="password" id="password" placeholder="Create Password" required />
                </h5>
                <h5>
                    <select name="role" id="role">
                        <option value="user">user</option>
                        <option value="freelancer">freelancer</option>
                    </select>
                </h5>
                <input type="submit" name="signup" value="Sign up" />
                <p>
                    Already a Member?&nbsp;
                    <a href="login.php">SIGN-IN HERE</a>
                </p>
            </form>
        </div>
    </div>
    <script src="../assets/js/main.js"></script>
</body>

</html>