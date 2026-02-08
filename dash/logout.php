<?php
// Start the session
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect the user to the login page after logout
header("Location: login.php"); // Or any page you want to redirect the user to
exit();
?>
