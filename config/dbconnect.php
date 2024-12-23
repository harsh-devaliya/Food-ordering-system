<?php

$con = mysqli_connect('localhost','root','','food_ordering_system');

if(!$con)
{
    die("Connection failed: " . mysqli_connect_error());
}

?>