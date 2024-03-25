<?php
// Connect to your database (replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process search and filter parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$categories = isset($_GET['category']) ? $_GET['category'] : [];

// Build the SQL query based on search and filter parameters
$sql = "SELECT * FROM users WHERE ";

if (!empty($categories)) {
    $categoryConditions = [];
    foreach ($categories as $category) {
        $categoryConditions[] = "category = '$category'";
    }
    $sql .= "(" . implode(" OR ", $categoryConditions) . ") AND ";
}

$sql .= "title LIKE '%$search%'";

// Execute the query
$result = $conn->query($sql);

// Display the results
if ($result->num_rows > 0) {
    while ($user = $result->fetch_assoc()) {
        echo "<p>{$user['title']} - Category: {$user['category']}</p>";
        // Display other relevant information as needed
    }
} else {
    echo "No results found.";
}

// Close the database connection
$conn->close();
