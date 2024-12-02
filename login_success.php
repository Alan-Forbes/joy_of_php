<?php
session_start();
if(!isset($_SESSION['MyUserName']))
{
header("location:login.html");
}
?>
<html>
<body>
Login Successful
</body>
</html>