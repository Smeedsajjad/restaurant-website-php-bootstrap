<?php

session_start();
session_destroy();

setcookie('admin_email', '', time() - 3600, "/");

header("Location: login.php");
exit;

?>