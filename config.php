<?php
/* mysqli_connect for database connection */

$dbHost = 'localhost';
$dbUser = 'id18192108_sayang';
$dbPassword = 'w7V$Zj6~ot!d9@aC';
$dbName = 'id18192108_annur';

// connect to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
?>