<?php
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

$id = $_SESSION['id'];
$date = date("Y-m-d");

if(isset($_GET['nis']) && isset($_GET['periode'])) {
  $nis = $_GET['nis'];
  $periode = $_GET['periode'];

  $getQuery = "SELECT `nis`,`infak_bulanan` FROM `santri` WHERE `nis` LIKE '$nis'";
  $getResult = mysqli_query($conn, $getQuery);
  $getData = mysqli_fetch_array($getResult, MYSQLI_ASSOC);

  $query = "INSERT INTO `keuangan_tpq`(`keterangan`,`keluar`,`masuk`,`tanggal`,`user_id`) VALUES
            (concat('SPP ','".$getData['nis']."',' [$periode]'),
            '0',
            ".$getData['infak_bulanan'].",
            '$date',
            '$id')";
  $result = mysqli_query($conn, $query);

  if($_GET['filter'] == "yes") {
    header("Location: riwayat.php?periode=$periode");
  } else {
    header("Location: spp.php");
  }
} else {
  header("Location: spp.php");
}
?>