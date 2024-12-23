<?php
session_start();
include('functions/message.php');

if(isset($_SESSION['auth']))
{
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);
    unset($_SESSION['role']);

    redirect("success", "Logged out Successful!");
}

header("Location: index.php");
exit();

?>