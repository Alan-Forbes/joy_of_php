<html>
<head>
    <meta charset="utf-8">
    <title>Sam's Used Cars</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<h1>Sam's Used Cars</h1>
<h3>Complete Inventory</h3>
<?php
$apiUrl = 'http://localhost:8888/joy_of_php/cars_list_api.php';
$response = file_get_contents($apiUrl);

if ($response === FALSE) {
    echo "Error fetching car data.";
    exit;
}

$cars = json_decode($response, true);

if (isset($cars['error'])) {
    echo "Error: " . $cars['error'];
    exit;
}

echo "<table id='Grid' style='width: 80%'><tr>";
echo "<th style='width: 50px'>Make</th>";
echo "<th style='width: 50px'>Model</th>";
echo "<th style='width: 50px'>Asking Price</th>";
echo "</tr>\n";

$class = "odd";
foreach ($cars as $car) {
    echo "<tr class=\"$class\">";
    echo "<td>" . htmlspecialchars($car['Make']) . "</td>";
    echo "<td>" . htmlspecialchars($car['Model']) . "</td>";
    echo "<td>" . htmlspecialchars($car['ASKING_PRICE']) . "</td>";
    echo "</tr>\n";

    $class = ($class == "odd") ? "even" : "odd";
}

echo "</table>";
?>
</body>
</html>
