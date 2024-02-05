<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPER ELECTRONICS - OUTLET</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h2>SUPER ELECTRONICS - OUTLET</h2>
        
        <form action="" method="post">
            <label for="outletSelect">Select Outlet:</label>
            <select name="outletSelect" id="outletSelect">
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

            <input type="submit" name="submit" value="Show Details">
			<a href="home.html"><button type="button">Back to Home</button></a>
        </form>

        <?php
        // Display outlet details if an outlet is selected
        if (isset($_POST['submit'])) {
            $selectedOutletId = $_POST['outletSelect'];

            // Connect to the database 
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch outlet details based on the selected outlet_id
            $sql = "SELECT * FROM outlet WHERE outlet_id = '$selectedOutletId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Outlet ID</th><th>Location</th><th>Outlet Phone Number</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['outlet_id'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['outlet_phone_no'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No outlet selected.";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
