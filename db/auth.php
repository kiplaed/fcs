<?php
session_start();
require 'db.php';

if (isset($_POST['signup'])) {

    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordHash = md5($password);

    $query = " INSERT INTO users(`fullName`, `username`, `email`,`role`, `password`) VALUES ('$fullName','$username','$email','$role','$passwordHash')";

    $results = mysqli_query($conn, $query);

    if ($results) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $emailid = $_SESSION['email'];
        $userRole = $_SESSION['role'];


        if ($_SESSION['email']) {
            $query_post = $conn->query("SELECT * FROM users WHERE email ='$emailid' and role='$userRole'");
            $allusers = $query_post->fetch_assoc();
            $userid = $allusers['id'];
            $roles = $allusers['role'];


            $query_id = $conn->query("SELECT * FROM project.jobs
                                  JOIN project.users ON project.jobs.user_id = project.users.id
                                  WHERE project.jobs.user_id = '$userid' AND project.users.role='$roles'");

            switch ($roles) {
                case 'freelancer':
                    if ($query_id->num_rows > 0) {
                        header('location:../freelancer/');
                        $_SESSION['freelancer'] = $userid;
                    } else {
                        header('location: ../freelancer/editor.php');
                    }
                    break;
                case 'admin':
                    header('location:../admin/');
                    $_SESSION['admin'] = $userid;
                    break;
                default:
                    header('location:../user');
                    $_SESSION['user'] = $userid;
                    break;
            }
        }
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordHash = md5($password);

    $askrecent = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$passwordHash'");

    if ($askrecent->num_rows > 0) {
        while ($recent = $askrecent->fetch_assoc()) {
            $emailsave = $recent['email'];
            $username = $recent['username'];
            $user_id = $recent['id'];
            $userType = $recent['role'];
        }

        if ($askrecent->num_rows > 0) {
            $_SESSION['email'] = $emailsave;
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userid;
            $_SESSION['role'] = $userType;

            if ($userType == 'freelancer') {
                $_SESSION['freelancer'] = $user_id;
                header('location:../freelancer');
            } elseif ($userType == 'admin') {
                $_SESSION['admin'] = $user_id;
                header('location:../admin');
            } else {
                $_SESSION['user'] = $user_id;
                header('location:../user');
            }
        } else {
            header('location:../auth/login.php?check-credentials-and-login-again');
        }
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: ../auth/login.php");
    exit;
}

if (isset($_POST['complete'])) {
    $taskid = $_GET['taskid'];
    $query = "UPDATE `tasks` SET status ='completed' WHERE id= '$taskid'";
    $update = mysqli_query($conn, $query);
    if ($update) {
        header('location:../freelancer?status=success&message=Task Status Updated');
    }
}
if (isset($_POST['undo'])) {
    $taskid = $_GET['taskid'];
    $query = "UPDATE `tasks` SET status ='pending' WHERE id= '$taskid'";
    $update = mysqli_query($conn, $query);
    if ($update) {
        header('location:../freelancer?Task Status Updated');
    }
}

if (isset($_POST['request'])) {
    $fid = $_GET['fid'];
    $pid = $_GET['pid'];
    $jid = $_GET['jid'];
    $title = $_GET['title'];
    $status = "pending";
    $userstatus = "awaiting";

    $query = "INSERT INTO tasks(`uid`, `fid`,`jid`,`title`,`status`,`user_status`) VALUES('$pid','$fid','$jid','$title','$status','$userstatus')";
    $post = mysqli_query($conn, $query);
    if ($post) {
        header('location:../user/index.php?requested-succesfully');
    }
}

if (isset($_POST['cancel'])) {
    $jid = $_GET['jid'];
    $query = "DELETE FROM tasks WHERE jid='$jid'";
    $cancel = mysqli_query($conn, $query);
    if ($cancel) {
        header("location:../user/profile.php?username=$_SESSION[username]&id=$_SESSION[user]&action='deleted'");
    }
}

if (isset($_POST['approve'])) {
    $jid = $_GET['jid'];
    $query = "UPDATE `tasks` SET user_status ='approved' WHERE jid='$jid'";
    $update = mysqli_query($conn, $query);
    if ($update) {
        header("location:../user/profile.php?username=$_SESSION[username]&id=$_SESSION[user]&Task Status Updated");
    }
}

if (isset($_POST['delete'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM jobs WHERE id='$id'";
    $delete = mysqli_query($conn, $query);
    if ($delete) {
        header("location: ../freelancer/profile.php?username=$_SESSION[username]&id=$_SESSION[freelancer]&action='deleted'");
    }
}

require '../db/db.php';

if (isset($_POST['post'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $userid = $_SESSION['freelancer'];
    $details = mysqli_real_escape_string($conn, $_POST['details']);

    $query = " INSERT INTO jobs(`title`,`user_id`, `price`, `details`) VALUES ('$title','$userid','$price','$details')";

    $results = mysqli_query($conn, $query);
    switch ($results) {
        case true:
            echo "Uploaded Successfully";
            header("location:../freelancer/profile.php?username=$_SESSION[username]&id=$_SESSION[freelancer]");
            break;
        default:
            echo "Upload Failed";
            break;
    }
}
