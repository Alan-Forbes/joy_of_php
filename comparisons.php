<html>
	<body>
		<h1>Open Hours</h1>	
		<?php
		date_default_timezone_set ( "EST" );
			if ( date("l")=='Sunday') {
  			echo "Sorry, we are closed today.";
		} else {
  		echo "We are open today from 10 AM to 9 PM<br>";
		}
		echo "<h1>Comparison operators</h1>";
		$FirstName = 'Alan';
		if ($FirstName == "Alan")
		{
		echo "Hello Master";
		}
		else
		{
		echo "Hello $FirstName";
		}
		echo "<br>";
		$a = 1;
		$b = "1";
		if ($a == $b) 
		{
		echo '$a is equal to $b';
		}
		else
		{
		echo '$a is not equal to $b';
		}
		
		echo "<br><BR>";
		if ($a === $b) 
		{
		echo '$a is equal to $b';
		}
		else
		{
		echo '$a is not equal to $b';
		}
echo "<br>":

$i = 1;
while ($i <= 10):
    echo $i;
    $i = $i + 1;
endwhile;
?>
</body>	
</html>

