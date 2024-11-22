 <?php

$local = true;
if ($local == true){
    $dbuser = 'root';
    $dbpass = 'root';
    $dbhost = 'localhost';
}
$docker = false;
if ($docker == true){
    $dbuser = 'root';
    $dbpass = 'verysecret';
    $dbhost = 'mySQL';
}
$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");


/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//select a database to work with
$mysqli->select_db("Cars");
 
?>