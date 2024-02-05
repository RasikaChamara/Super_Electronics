<?php
// Check if the order_id parameter is set
if (isset($_GET['order_id'])) {
    // Get the order_id from the URL
    $order_id = $_GET['order_id'];

    // Connect to the database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "super_electronics";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the order based on order_id
    $sql = "DELETE FROM orders WHERE order_id = $order_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to view_orders.php after successful deletion
        header("Location: view_orders.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
