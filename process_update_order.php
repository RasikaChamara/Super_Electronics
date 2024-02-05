<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $order_id = $_POST["order_id"];
    $category = $_POST["category"];
    $item = $_POST["item"];
    $quantity = $_POST["quantity"];

    // Validate and sanitize input data 
    $category = htmlspecialchars($category);
    $item = htmlspecialchars($item);
    $quantity = intval($quantity);

    // Connect to the database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "super_electronics";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update order details in the "orders" table
    $sql = "UPDATE orders SET category='$category', item='$item', quantity=$quantity WHERE order_id=$order_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to view_orders.php after successful update
        header("Location: view_orders.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
