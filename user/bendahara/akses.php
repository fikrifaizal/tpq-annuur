<?php
session_start();

if(!isset($_SESSION['id']) && $_SESSION['role'] != "BENDAHARA TPQ"){
	header("location: ../login.php");
}
?>