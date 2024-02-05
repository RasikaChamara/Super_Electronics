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

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate password format
    $password_pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).{6,}$/";
    if (!preg_match($password_pattern, $password)) {
        die("Password must contain at least one digit, one lowercase letter, one uppercase letter, one special character, and be at least 6 characters long.");
    }

    // Validate email format
    $email_pattern = "/.+@.+/";
    if (!preg_match($email_pattern, $email)) {
        die("Invalid email address format.");
    }

    // Hash the password before storing in the database
    $hashed_password = hash('sha256', $password);

    // Insert user details into the 'users' table
    $sql = "INSERT INTO users (name, address, username, password, email) VALUES ('$name', '$address', '$username', '$hashed_password', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to the login page
        header("Location: index.html");
        exit();
    } else {
        // Error in registration
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
