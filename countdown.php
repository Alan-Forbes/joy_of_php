<?php
$target = mktime(0, 0, 0, 12, 10, 2018) ;
$today = time () ;
$difference =($target-$today) ;
$days =(int) ($difference/86400) ;
print "Our event will occur in $days days";
?>