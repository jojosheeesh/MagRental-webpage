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
    // Retrieve form data
    $location = test_input($_POST["location"]);
    $name = test_input($_POST["name"]);
    $car_number = test_input($_POST["carNumber"]);  // Corrected variable name
    $price = test_input($_POST["price"]);
    $pickupDate = test_input($_POST["pickup_date"]);
    $returnDate = test_input($_POST["return_date"]);

    // Validate form data (you can add more validation as needed)
    if (empty($location) || empty($name) || empty($car_number) || empty($price) || empty($pickupDate) || empty($returnDate)) {
        echo "All fields are required. Please go back and fill in the missing information.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO rental (location, name, car_number, price, pickup_date, return_date)
                VALUES ('$location', '$name', '$car_number', '$price', '$pickupDate', '$returnDate')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Data inserted successfully.</p>";
            echo "<button style='padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;' onclick=\"window.location.href='index.html'\">thankyou</button>"; // Add this line
        } else {
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
} else {
    // Redirect to the form page if accessed directly without form submission
    header("Location: form.html");
    exit();
}

// Close the database connection
$conn->close();

// Function to sanitize form input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
