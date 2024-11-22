<?php
 include 'db.php';
 $vin = trim($_POST['VIN']);
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br>". "\n";
  echo "Type: " . $_FILES["file"]["type"] . "<br>". "\n";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>". "\n";
  echo "VIN: ".$vin."<br>";
  echo "Stored temporarily as: " . $_FILES["file"]["tmp_name"]."<br><BR>". "\n";
  $currentfolder =  getcwd();
  echo "This script is running in: " .$currentfolder."<br>". "\n";
  $target_path = getcwd() ."/uploads/";
  echo "The uploaded file will be stored in the folder: ".$target_path."<br>". "\n";

  $target_path = $target_path . basename( $_FILES['file']['name']); 
  $imagename = "uploads/". basename( $_FILES['file']['name']); 
  echo "The full file name of the uploaded file is '". $target_path."'<br>". "\n";

  echo "The relative name of the file for use in the IMG tag is " . $imagename ."<br><br>". "\n";;

if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded<br>". "\n";
   
    // Create a database entry for this image
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

  echo 'Connected successfully to mySQL. <BR>'; 
  $file_name =  $_FILES["file"]["name"];
  $query = "INSERT INTO images (VIN, ImageFile) VALUES ('$vin', '$file_name')";
  echo $query."<br>\n";
   echo  "<a href='AddImage.php?VIN=";
   echo $vin;
   echo "'>Add another image for this car </a></p>\n";
/* Try to insert the new car into the database */
if ($result = $mysqli->query($query)) {
        echo "<p>You have successfully entered $target_path into the database.</P>\n";
       
    }
    else
    {
        echo "Error entering $VIN into database: " . mysql_error()."<br>";
    }
    $mysqli->close();
    echo "<img src='$imagename' width='150'><br>";

} else{
    echo "There was an error uploading the file, please try again!";
}
  }
  
  include 'footer.php'
?> 