<?php
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

$id = $_SESSION['id'];
$date = date("Y-m-d");

if(isset($_GET['induk']) && isset($_GET['periode'])) {
  $induk = $_GET['induk'];
  $periode = $_GET['periode'];
  $explodeData = explode("-",$periode);
  $setDate = monthConverter2($explodeData[1])." ".$explodeData[0];

  // PROCESSING INSERT INTO SPP
  $getQuery = "SELECT `induk`,`infak_bulanan` FROM `santri` WHERE `induk` LIKE '$induk'";
  $getResult = mysqli_query($conn, $getQuery);
  $getData = mysqli_fetch_array($getResult, MYSQLI_ASSOC);

  $query = "INSERT INTO `spp`(`santri_induk`,`periode`,`tgl_bayar`,`user_id`)
            VALUES ('$induk','$periode','$date','$id')";
  $result = mysqli_query($conn, $query);

  // PROCESSING INSERT INTO KEUANGAN TPQ
  $cekQuery = "SELECT COUNT(id) as ket FROM `keuangan_tpq` WHERE `keterangan` LIKE '%$setDate%'";
  $cekResult = mysqli_query($conn, $cekQuery);
  $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

  if($cekData['ket'] > 0) {
    $getKasQuery = "SELECT `masuk` FROM `keuangan_tpq` WHERE `keterangan` LIKE '%$setDate%'";
    $getKasResult = mysqli_query($conn, $getKasQuery);
    $getKasData = mysqli_fetch_array($getKasResult, MYSQLI_ASSOC);

    $sppTotal = $getKasData['masuk']+$getData['infak_bulanan'];
    $queryKeuangan = "UPDATE `keuangan_tpq` SET `masuk`='$sppTotal',`user_id`='$id' WHERE `keterangan` LIKE '%$setDate%'";
    $resultKeuangan = mysqli_query($conn, $queryKeuangan);
  }
  else {
    $queryKeuangan = "INSERT INTO `keuangan_tpq`(`keterangan`,`keluar`,`masuk`,`tanggal`,`user_id`) VALUES
              ('Kumulatif SPP Periode $setDate',
              '0',
              ".$getData['infak_bulanan'].",
              '$date',
              '$id')";
    $resultKeuangan = mysqli_query($conn, $queryKeuangan);
  }

  if($_GET['filter'] == "yes") {
    header("Location: riwayat.php?periode=$periode");
  } else {
    header("Location: spp.php");
  }
} else {
  header("Location: spp.php");
}
?>