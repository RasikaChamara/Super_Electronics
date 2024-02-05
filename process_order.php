<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST["category"];
    $item = $_POST["item"];
    $quantity = $_POST["quantity"];
    $outletId = $_POST["outletId"];

    // Validate and sanitize input data (you can add more validation)
    $category = htmlspecialchars($category);
    $item = htmlspecialchars($item);
    $quantity = intval($quantity);
    $outletId = intval($outletId);

    // Connect to the database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "super_electronics";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert order details into the "orders" table
    $sql = "INSERT INTO orders (category, item, quantity, outlet_id) VALUES ('$category', '$item', $quantity, $outletId)";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to order.php after successful insertion
        header("Location: order.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>
