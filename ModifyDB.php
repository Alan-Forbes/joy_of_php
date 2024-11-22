<?php
/**
 * Joy of PHP sample code
 * Demonstrates how to modify an existing database table.
 */
include 'db.php';

   if (!$mysqli) { 
      die("Could not connect: ".$mysqli->error."<br>"); 
  } 
  echo 'Connected successfully to mySQL. <BR>'; 
  
//select a database to work with
$mysqli->select_db("Cars");
   Echo ("Selected the Cars database<br>");

$query = "ALTER TABLE `inventory` ADD `Primary_Image` VARCHAR(250) NULL AFTER `SALE_DATE`";
echo "<p>***********</p>";
echo $query ;
echo "<p>***********</p>";
if ($mysqli->query($query) === TRUE) 
{
    echo "Database table 'INVENTORY' modified</P>";
}
else
{
    echo "<p>Error: </p>" . $mysqli->error."<br>";;
}
$mysqli->close();
echo "<br><br><a href='home.html'>Home</a>";
?>