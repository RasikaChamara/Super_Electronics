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

    // Fetch order details based on order_id
    $sql = "SELECT * FROM orders WHERE order_id = $order_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display a form for updating order details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Order - SUPER ELECTRONICS</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }

                .container {
                    width: 80%;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h2 {
                    color: #333;
                    text-align: center;
                }

                form {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                label {
                    margin-bottom: 8px;
                }

                input, select,button {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 16px;
                    box-sizing: border-box;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }

                input[type="submit"], button{
                    background-color: #4caf50;
                    color: #fff;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Update Order - SUPER ELECTRONICS</h2>

                <form action="process_update_order.php" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    
                    <label for="category">Category:</label>
                    <select name="category" required>
                        <option value="kitchen_equipment" <?php echo ($row['category'] == 'kitchen_equipment') ? 'selected' : ''; ?>>Kitchen Equipment</option>
                        <option value="entertainment" <?php echo ($row['category'] == 'entertainment') ? 'selected' : ''; ?>>Entertainment</option>
                        <option value="lightings" <?php echo ($row['category'] == 'lightings') ? 'selected' : ''; ?>>Lightings</option>
                        <option value="cleaners" <?php echo ($row['category'] == 'cleaners') ? 'selected' : ''; ?>>Cleaners</option>
                        <option value="cosmetics" <?php echo ($row['category'] == 'cosmetics') ? 'selected' : ''; ?>>Cosmetics</option>
                    </select>

                    <label for="item">Item:</label>
                    <select name="item" required>
                        <!-- Add options based on selected category -->
                        <?php
                        $selectedCategory = $row['category'];
                        $kitchenItems = ['Electric kettle', 'Heater', 'Grinder'];
                        $entertainmentItems = ['TV', 'Laptop', 'Home Theater', 'Router', 'Sub Woofer'];
                        $lightingItems = ['LED lights', 'Party Lights', 'LED Stripes', 'CFL Lights', 'Party Laser'];
                        $cleanerItems = ['Vacuum Cleaner', 'Auto AI cleaner', 'Electric Iron'];
                        $cosmeticsItems = ['Hair dryer', 'Heater', 'Trimmers', 'Massager'];

                        $items = [];

                        switch ($selectedCategory) {
                            case 'kitchen_equipment':
                                $items = $kitchenItems;
                                break;
                            case 'entertainment':
                                $items = $entertainmentItems;
                                break;
                            case 'lightings':
                                $items = $lightingItems;
                                break;
                            case 'cleaners':
                                $items = $cleanerItems;
                                break;
                            case 'cosmetics':
                                $items = $cosmeticsItems;
                                break;
                        }

                        foreach ($items as $itemOption) {
                            echo "<option value=\"$itemOption\" " . ($row['item'] == $itemOption ? 'selected' : '') . ">$itemOption</option>";
                        }
                        ?>
                    </select>

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>

                    

                    <input type="submit" name="submit" value="Update Order">
					<a href="view_orders.php"><button type="button">Back to View</button></a>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Order not found.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
