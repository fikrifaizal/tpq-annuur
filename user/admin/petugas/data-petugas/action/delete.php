<?php
require_once('../../../../config.php');
require_once('../../../akses.php');

if(isset($_GET['nipt'])) {
  $id = $_GET['nipt'];

  $query = "DELETE FROM `piket` WHERE `nipt` LIKE '$id'";
  $result = mysqli_query($conn, $query);

  header("Location: ../petugas.php");
} else {
  header("Location: ../petugas.php");
}
?>