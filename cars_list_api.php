<?php
header('Content-Type: application/json');
include 'db.php';

$query = "SELECT * FROM inventory ORDER BY Make";
$cars = [];

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
    $result->free();
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Error retrieving cars: " . $mysqli->error]);
    exit;
}

$mysqli->close();
echo json_encode($cars);
?>
