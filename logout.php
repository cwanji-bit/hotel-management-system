<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect with message
header("Location: login.php?msg=You have been logged out successfully");
exit();
?>
