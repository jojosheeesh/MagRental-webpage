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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $location = test_input($_POST["location"]);
    $name = test_input($_POST["name"]);
    $car_number = test_input($_POST["car_number"]);
    $price = test_input($_POST["price"]);
    $pickupDate = test_input($_POST["pickup_date"]);
    $returnDate = test_input($_POST["return_date"]);

    // Update data in the database
    $sql = "UPDATE rental SET 
            location = '$location',
            name = '$name',
            car_number = '$car_number',
            price = '$price',
            pickup_date = '$pickupDate',
            return_date = '$returnDate'
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();

// Function to sanitize form input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go to Display Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 40px;
        }

        h1 {
            color: #333;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

   
    <!-- The button to go to display_data.php -->
    <button onclick="goToDisplayData()">THANKYOUUU</button>

    <script>
        // JavaScript function to navigate to display_data.php
        function goToDisplayData() {
            // Change the window location to display_data.php
            window.location.href = 'display_data.php';
        }
    </script>

</body>
</html>

