<?php 
include 'include/gifts.inc.php';
my_cart_to_mytreasurly();

header("location: mytreasure.php?SUCCESS=1");
?>