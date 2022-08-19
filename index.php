<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['role'])) {
  switch($_SESSION['role']) {
    case "ADMINISTRATOR":
      header("location: user/admin/dashboard.php");
      break;
    case "BENDAHARA TPQ":
      header("location: user/bendahara/dashboard.php");
      break;
    // default:
  }
} else {
  header("location: user/auth/login.php");
}

?>