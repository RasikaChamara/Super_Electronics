<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders - SUPER ELECTRONICS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        td a {
            color: #333;
            text-decoration: none;
        }

        td a:hover {
            color: #4caf50;
            font-weight: bold;
        }
		button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h2>View Orders - SUPER ELECTRONICS</h2>

    <?php
    // Connect to the database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "super_electronics";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch order details from the "orders" table
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Order ID</th>
                    <th>Category</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Outlet Location</th>
                    <th>Actions</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['item']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['outlet_id']}</td>
                    <td>
                        <a href='update_order.php?order_id={$row['order_id']}'>Update</a>
                        |
                        <a href='delete_order.php?order_id={$row['order_id']}'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "No orders found.";
    }

    $conn->close();
    ?>
	<a href="order.php"><button type="button">Back to Orders</button></a>
</body>
</html>
