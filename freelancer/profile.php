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
    <title style="text-transform: uppercase;"><?php echo $_SESSION['username']. " | Profile";?></title>
</head>
<body>
    
</body>
</html>