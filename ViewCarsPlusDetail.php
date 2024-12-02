<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sam's Used Cars</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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

echo "<table id='Grid' style='width: 80%; cursor: pointer;'><tr>";
echo "<th style='width: 50px'>Make</th>";
echo "<th style='width: 50px'>Model</th>";
echo "<th style='width: 50px'>Asking Price</th>";
echo "</tr>\n";

$class = "odd";
foreach ($cars as $car) {
    $vin = htmlspecialchars($car['VIN']);
    echo "<tr class=\"$class\" onclick=\"showCarDetails('$vin')\">";
    echo "<td>" . htmlspecialchars($car['Make']) . "</td>";
    echo "<td>" . htmlspecialchars($car['Model']) . "</td>";
    echo "<td>" . htmlspecialchars($car['ASKING_PRICE']) . "</td>";
    echo "</tr>\n";
    $class = ($class == "odd") ? "even" : "odd";
}

echo "</table>";
?>

<!-- Modal -->
<div id="carModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Car Details</h2>
        <div id="carDetails">
            <!-- Car details will be loaded here -->
        </div>
    </div>
</div>

<script>
    // Function to show the modal with car details
    function showCarDetails(vin) {
        const modal = document.getElementById('carModal');
        const carDetailsDiv = document.getElementById('carDetails');

        // Fetch car details from the API
        fetch(`http://localhost:8888/joy_of_php/car_details_api.php?VIN=${vin}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    carDetailsDiv.innerHTML = `<p>${data.error}</p>`;
                } else {
                    carDetailsDiv.innerHTML = `
                        <p><strong>${data.year} ${data.make} ${data.model}</strong></p>
                        <p>Trim: ${data.trim}</p>
                        <p>Price: $${data.price}</p>
                        <p>Exterior Color: ${data.exterior_color}</p>
                        <p>Interior Color: ${data.interior_color}</p>
                        <p>Mileage: ${data.mileage} miles</p>
                        <p>Transmission: ${data.transmission}</p>
                    `;
                }
                modal.style.display = "block";
            })
            .catch(error => {
                carDetailsDiv.innerHTML = `<p>Error fetching car details.</p>`;
                modal.style.display = "block";
            });
    }

    // Function to close the modal
    function closeModal() {
        const modal = document.getElementById('carModal');
        modal.style.display = "none";
    }

    // Close modal when clicking outside the modal content
    window.onclick = function(event) {
        const modal = document.getElementById('carModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>
</body>
</html>
