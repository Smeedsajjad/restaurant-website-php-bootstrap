<?php
session_start();
session_unset();
session_destroy();

// Delete the cookies by setting their expiration to a past date
setcookie("remember_token", "", time() - 3600, "/");

header("Location: login.php");
exit();
?>
