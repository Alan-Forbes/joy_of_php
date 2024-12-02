<?php 
	session_start();
?>

<html>
<head>
<title>Welcome to the Joy of PHP</title>
<style type="text/css">
.center {
	text-align: center;
}
</style>
</head>

<body background="bg.jpg">

<table style="width: 100%">
	<tr>
		<td style="width: 133px">
		<img alt="Used Cars" height="120" src="usedcars.jpg" width="184" /></td>
		<td>
<h1 class='center'>Welcome to Sam's Used Car Lot</h1>

		<p class='center'>The companion web site that goes with the</p>
		<p class='center'>&nbsp;<a href="home.html">Joy of PHP</a>:<em>Deep Dive Into Sessions</em> Book</p></td>
	</tr>
</table>

<hr />
<?php
if(isset($_SESSION['MyUserName'])){
echo "Welcome ".$_SESSION['MyUserName'];
echo ". Your role is ".$_SESSION['Role'];
}
else
{
echo "Welcome to Sam's Used Car Lot";
}
?>

<p><a href="ViewCars.php">View Cars - Basic</a></p>
<p><a href="ViewCarsWithStyle.php">View Cars with Style</a> </p>

<?php 
if(isset($_SESSION['MyUserName'])){
if ($_SESSION['Role'] =="Owner")
{
echo "<p>**** Owner Actions **** </p>";
echo "<p><a href='ViewSalesReports.php'>View Sales Report</a></p>";
echo "<p><a href='ViewPendingSales.php'>Approve pending sales</a></p>";
echo "<p><a href='ViewCarsWithStyle2.php'>View Cars with Edit Links</a></p><br/>";
}
if ($_SESSION['Role'] =="Data Entry")
{
echo "<p>**** Data Entry Actions **** </p>";
echo "<p><a href='formEnterCar.htm'>Add a Car</a></p>";
echo "<p><a href='ViewCarsAddImage.php'>Add Images to Cars</a></p>";
}

echo "<p><a href='logout.php'>Logout</a>";
}
else
{
echo "<a href=\"login2.html\">Login</a></p>";
}
?>

</body>

</html>