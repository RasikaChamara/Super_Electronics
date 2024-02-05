<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUPER ELECTRONICS - STAFF</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container">
        <h2>SUPER ELECTRONICS - STAFF</h2>
        
        <form action="" method="post">
            <label for="staffSelect">Select Staff Member:</label>
            <select name="staffSelect" id="staffSelect">
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

                // Fetch staff names from the database
                $sql = "SELECT staff_id, staff_name FROM staff";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['staff_id'] . "'>" . $row['staff_name'] . "</option>";
                    }
                }

                $conn->close();
                ?>
            </select>

            <input type="submit" name="submit" value="Show Details">
			<a href="home.html"><button type="button">Back to Home</button></a>
        </form>

        <?php
        // Display staff details if a staff member is selected
        if (isset($_POST['submit'])) {
            $selectedStaffId = $_POST['staffSelect'];

            // Connect to the database 
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch staff details based on the selected staff_id
            $sql = "SELECT * FROM staff WHERE staff_id = '$selectedStaffId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Staff ID</th><th>Name</th><th>Phone Number</th><th>Outlet ID</th><th>Job Description</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['staff_id'] . "</td>";
                    echo "<td>" . $row['staff_name'] . "</td>";
                    echo "<td>" . $row['staff_phone_no'] . "</td>";
                    echo "<td>" . $row['outlet_id'] . "</td>";
                    echo "<td>" . $row['job_description'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No staff member selected.";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
