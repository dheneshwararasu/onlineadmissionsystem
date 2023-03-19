<?php
session_start();
 if (!isset($_SESSION['id']))
{
    header("location:logout.php"); //this is the update to prevent redirection
}
session_destroy();
//header("Location: adminlogin.php");
?>
