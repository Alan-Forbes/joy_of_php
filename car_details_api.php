<?php
// Include database connection
include 'db.php';

// Set response header to JSON
header('Content-Type: application/json');

// Check if VIN is provided in the query string
if (!isset($_GET['VIN']) || empty($_GET['VIN'])) {
    echo json_encode(["error" => "VIN parameter is required."]);
    exit();
}

// Sanitize the VIN input
$vin = $mysqli->real_escape_string($_GET['VIN']);

// Prepare the SQL query
$query = "SELECT * FROM inventory WHERE VIN='$vin'";

// Execute the query and handle potential errors
if ($result = $mysqli->query($query)) {
    // Check if the car exists
    if ($result->num_rows > 0) {
        // Fetch the car data
        $car = $result->fetch_assoc();

        // Prepare JSON response
        $response = [
            "year" => $car['YEAR'],
            "make" => $car['Make'],
            "model" => $car['Model'],
            "trim" => $car['TRIM'],
            "exterior_color" => $car['EXT_COLOR'],
            "interior_color" => $car['INT_COLOR'],
            "mileage" => $car['MILEAGE'],
            "transmission" => $car['TRANSMISSION'],
            "price" => $car['ASKING_PRICE']
        ];

        echo json_encode($response);
    } else {
        echo json_encode(["error" => "No vehicle found with VIN: $vin"]);
    }
    // Free the result set
    $result->free();
} else {
    echo json_encode(["error" => "Database query failed."]);
}

// Close the database connection
$mysqli->close();
?>
