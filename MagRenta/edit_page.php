<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rental Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Edit Rental Record</h2>

        <?php
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "system";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
            $idToEdit = $_POST["edit"];

            // Retrieve data for the selected record
            $sql = "SELECT * FROM rental WHERE id = '$idToEdit'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Display the form for editing
                echo "<form method='POST' action='update_record.php'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>

                        <label for='location'>Location:</label>
                        <input type='text' name='location' value='" . htmlspecialchars($row["location"]) . "' required>

                        <label for='name'>Name:</label>
                        <input type='text' name='name' value='" . htmlspecialchars($row["name"]) . "' required>

                        <label for='car_number'>Car Number:</label>
                        <input type='text' name='car_number' value='" . htmlspecialchars($row["car_number"]) . "' required>

                        <label for='price'>Price:</label>
                        <input type='text' name='price' value='" . htmlspecialchars($row["price"]) . "' required>

                        <label for='pickup_date'>Pickup Date:</label>
                        <input type='text' name='pickup_date' value='" . htmlspecialchars($row["pickup_date"]) . "' required>

                        <label for='return_date'>Return Date:</label>
                        <input type='text' name='return_date' value='" . htmlspecialchars($row["return_date"]) . "' required>

                        <input type='submit' value='Update Record'>
                    </form>";
            } else {
                echo "<p>Record not found.</p>";
            }
        } else {
            echo "<p>Invalid request.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>

    </div>

</body>

</html>
