<html>

<body>
<?php
 $myBirthday = "1965-01-21";
 echo age($myBirthday);
  //calculate years of age (input string: YYYY-MM-DD)
  function age($age){
    list($year,$month,$day) = explode("-",$age);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;
    return $year_diff;
  }

?>
</body>
</html>