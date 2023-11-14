<?php
session_start(); 

if (isset($_SESSION['AdminloginId'])) {
    unset($_SESSION['AdminloginId']);
    session_destroy();
}
echo '<script>alert("You have been successfully logged out.");
setTimeout(function() {
    window.location.href = "adminlogin.php"; // Redirect after 2 seconds
}, 2000);</script>';

header('Location: adminlogin.php'); 

?>
