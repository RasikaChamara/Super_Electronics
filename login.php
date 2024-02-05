<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "super_electronics";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before comparing with the database
    $hashed_password = hash('sha256', $password);

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login
        header("Location: home.html");
        exit();
    } else {
        // Invalid credentials
        echo "Invalid username or password";
    }
}

$conn->close();
?>
