<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Data Display</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        caption {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

       
    /* ... (existing styles) ... */

    .edit-btn,
    .delete-btn {
        display: inline-block;
        padding: 8px;
        background-color: #4CAF50;
        color: white;
        border: none;
        text-decoration: none;
        cursor: pointer;
        margin-right: 5px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .edit-btn:hover,
    .delete-btn:hover {
        background-color: #45a049;
    }
</style>

    </style>
</head>

<body>
<button onclick="location.href='index.html'" 
        style="background-color: #3498db; color: white; padding: 10px; border: none; cursor: pointer; border-radius: 4px;">Go Back</button>
    <div class="container">
     

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

        // Handle delete action
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
            $idToDelete = $_POST["delete"];
            $deleteSql = "DELETE FROM rental WHERE id = '$idToDelete'";
            if ($conn->query($deleteSql) === TRUE) {
                echo "<p>Data with ID $idToDelete deleted successfully.</p>";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }

        // Retrieve data from the database
        $sql = "SELECT * FROM rental";
        $result = $conn->query($sql);

        // Display the data in a table
        if ($result->num_rows > 0) {
            echo "<table>
                <caption>Rental Information</caption>
                <tr>
                    <th>Location</th>
                    <th>Name</th>
                    <th>Car Number</th>
                    <th>Price</th>
                    <th>Pickup Date</th>
                    <th>Return Date</th>
                    <th>Actions</th>
                </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . htmlspecialchars($row["location"]) . "</td>
                    <td>" . htmlspecialchars($row["name"]) . "</td>
                    <td>" . htmlspecialchars($row["car_number"]) . "</td>
                    <td>" . htmlspecialchars($row["price"]) . "</td>
                    <td>" . htmlspecialchars($row["pickup_date"]) . "</td>
                    <td>" . htmlspecialchars($row["return_date"]) . "</td>
                    <td>
                        <form style='display:inline;' action='edit_page.php' method='POST'>
                            <input type='hidden' name='edit' value='" . $row["id"] . "'>
                            <button class='edit-btn' type='submit'>Edit</button>
                        </form>
                        <form style='display:inline;' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>
                            <input type='hidden' name='delete' value='" . $row["id"] . "'>
                            <button class='delete-btn' type='submit'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No data found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>

    </div>

</body>

</html>
