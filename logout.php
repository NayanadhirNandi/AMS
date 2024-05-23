<?php
session_start(); // Start or resume the session
echo "<script>alert('You are Logged out')</script>";
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the index page 
header('Location: index.php');

exit();

?>
