<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPER ELECTRONICS - PLACE ORDER</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
            margin: 20px;
            border-radius: 15px;
            border: 2px solid #ddd;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        form {
            display: inline-block;
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        select, input,button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"],button {
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
    <div class="container">
        <h2>SUPER ELECTRONICS - PLACE ORDER</h2>

        <form action="process_order.php" method="post">
            <label for="category">Category:</label>
            <select name="category" id="category" onchange="populateItems()">
                <option value="kitchen">Kitchen Equipment</option>
                <option value="entertainment">Entertainment</option>
                <option value="lightings">Lightings</option>
                <option value="cleaners">Cleaners</option>
                <option value="cosmetics">Cosmetics</option>
            </select>

            <label for="item">Item:</label>
            <select name="item" id="item"></select>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required>

            <label for="outletId">Outlet ID:</label>
            <select name="outletId" id="outletId">
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

                // Fetch outlet names from the database
                $sql = "SELECT outlet_id, location FROM outlet";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['outlet_id'] . "'>" . $row['location'] . "</option>";
                    }
                }

                $conn->close();
                ?>
            </select>

            <input type="submit" name="submit" value="Add to Order">
			<a href="home.html"><button type="button">Back to Home</button></a>
			<a href="view_orders.php"><button type="button">View Orders</button></a>
        </form>
    </div>

    <script>
        function populateItems() {
            var categorySelect = document.getElementById('category');
            var itemSelect = document.getElementById('item');
            itemSelect.innerHTML = '';

            if (categorySelect.value === 'kitchen') {
                addItem('Electric kettle');
                addItem('Heater');
                addItem('Grinder');
            } else if (categorySelect.value === 'entertainment') {
                addItem('TV');
                addItem('Laptop');
                addItem('Home Theater');
                addItem('Router');
                addItem('Sub Woofer');
            } else if (categorySelect.value === 'lightings') {
                addItem('LED lights');
                addItem('Party Lights');
                addItem('LED Stripes');
                addItem('CFL Lights');
                addItem('Party Laser');
            } else if (categorySelect.value === 'cleaners') {
                addItem('Vacuum Cleaner');
                addItem('Auto AI cleaner');
                addItem('Electric Iron');
            } else if (categorySelect.value === 'cosmetics') {
                addItem('Hair dryer');
                addItem('Heater');
                addItem('Trimmers');
                addItem('Massager');
            }
        }

        function addItem(itemName) {
            var itemSelect = document.getElementById('item');
            var option = document.createElement('option');
            option.value = itemName;
            option.text = itemName;
            itemSelect.add(option);
        }
    </script>
</body>
</html>
