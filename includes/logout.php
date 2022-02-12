<?php ob_start(); ?>
<?php session_start(); ?>

<?php

// Removing the User's Stored Access Privileges to the Admin Site by Pressing the Logout Button
$_SESSION['username'] = null;
$_SESSION['firstName'] = null;
$_SESSION['lastName'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");

?>