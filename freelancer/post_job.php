<?php
require '../db/db.php';

if (isset($_POST['post-job'])) {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $userid = $_SESSION['id'];
    $details = mysqli_real_escape_string($conn, $_POST['details']);

    $query = " INSERT INTO jobs(`title`,`user_id`, `price`, `details`) VALUES ('$title','$userid','$price','$details')";

    $results = mysqli_query($conn, $query);

    // if ($results) {
    //     echo "Uploaded Successfully";
    // } else {
    //     echo "Upload Failed";
    // }

    switch ($results) {
        case true:
            echo "Uploaded Successfully";
            break;
        default:
            echo "Upload Failed";
            break;
    }
}
