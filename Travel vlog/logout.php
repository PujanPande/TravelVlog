<!--Spring2024
Pujan Pandey
CS 385
This file logout.php contain the logout stuffs and return user to same page to and display the form-->
<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the original first page (index.php)
header("Location: index.php");
exit();
?>
