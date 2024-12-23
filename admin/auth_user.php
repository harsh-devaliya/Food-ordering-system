<?php
include('config/dbconnect.php');
include('../functions/message.php');

if(isset($_SESSION['auth']))
{
    if($_SESSION['role'] != 1)
    {
        redirect("error", "You are not authorized as ADMIN!");
        header("Location: ../index.php");
        exit();
    }
}
else
{
    redirect("error", "Login to continue!");
    header("Location: ../login.php");
    exit();
}

?>