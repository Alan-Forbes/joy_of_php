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
include 'db.php';
$query = "SELECT * FROM inventory ORDER BY Make";
/* Try to insert the new car into the database */
if ($result = $mysqli->query($query)) {
   // Don't do anything if successful.
}
else
{
    echo "Error getting cars from the database: " . mysqli_error($mysqli)."<br>";
}

// Create the table headers
echo "<table id='Grid' style='width: 80%'><tr>";
echo "<th style='width: 50px'>Make</th>";
echo "<th style='width: 50px'>Model</th>";
echo "<th style='width: 50px'>Asking Price</th>";
echo "</tr>\n";

$class ="odd";  // Keep track of whether a row was even or odd, so we can style it later

// Loop through all the rows returned by the query, creating a table row for each
while ($result_ar = mysqli_fetch_assoc($result)) {
    echo "<tr class=\"$class\">";
    echo "<td>" . $result_ar['Make'] . "</td>";
    echo "<td>" . $result_ar['Model'] . "</td>";
    echo "<td>";
    echo '$'.number_format($result_ar['ASKING_PRICE'],0);
    echo "</td>";
   echo "</td></tr>\n";
   
   // If the last row was even, make the next one odd and vice-versa
    if ($class=="odd"){
        $class="even";
    }
    else
    {
        $class="odd";
    }
}
echo "</table>";
$mysqli->close();
echo "<br/>\n";
include 'footer.php';
?>
 </body>
 
</html>