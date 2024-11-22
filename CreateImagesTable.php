<?php
/**
 * Joy of PHP sample code
 * Demonstrates how to create a database, create a table, and insert records.
 */

include 'db.php';

   if (!$mysqli) { 
      die('Could not connect: ' . mysqli_error($mysqli));
  } 
  echo 'Connected successfully to mySQL. <BR>'; 


//select a database to work with
$mysqli->select_db("Cars");
   Echo ("Selected the Cars database <br>");

$query = " CREATE TABLE IMAGES (ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT, VIN varchar(17), ImageFile varchar(250))";
//echo "<p>***********</p>";
//echo $query ;
//echo "<p>***********</p>";
if ($mysqli->query($query) === TRUE) 
{
    echo "Database table 'Images' created</P>";
}
else
{
    echo "<p>Error: " . mysqli_error($mysqli);
}
 echo "<br><br><a href='home.html'>Home</a>";
$mysqli->close();
?>