<?php
require_once('../../../vendor/autoload.php');
require_once('../../../config.php');
require_once('../../helper.php');
require_once('../../akses.php');

define('K_PATH_IMAGES', '../../../assets/image/');

// get month & year
$setMonth = date("m");
$setYear = date("Y");
$setDate = monthConverter2($setMonth)." ".$setYear;

// create new PDF
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document info
$pdf->setCreator('Tim Annuur');
$pdf->setTitle('Informasi SPP');
$pdf->setSubject('Informasi SPP Santri');

// header & footer data
$pdf->setHeaderData('logo-annur-bulat-tanpa-alpha.jpg', 16, 'Informasi SPP', "Periode $setDate", array(8,138,68), array(0,0,0));
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', 16));

$pdf->setFooterData(array(0,0,0),array(0,0,0));
$pdf->setFooterFont(array(PDF_FONT_NAME_MAIN, '', 12));

$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margin
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, null);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set page break
$pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set imgae scalling
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set font subsetting
$pdf->setFontSubsetting(true);
$pdf->setFont(PDF_FONT_NAME_MAIN, '', 12, '', true);

$pdf->AddPage();

// set data
$query = "SELECT * FROM `santri`";
$result = mysqli_query($conn, $query);

// opening the table
$setData = '
<html>
  <head>
    <style>
      table {
        font-family: arial, sans-serif;
        width: 100%;
      }
      th {
        border: 1px solid #CBCCCE;
        text-align: center;
        font-weight: bold;
        background-color: #E2E3E5;
      }
      td {
        border: 1px solid #DEE2E6;
        text-align: left;
      }
    </style>
  </head>

  <body>
    <table>
      <tr>
        <th width="5%">#</th>
        <th width="15%">NIS</th>
        <th width="30%">Nama Lengkap</th>
        <th width="30%">Nama Wali</th>
        <th width="20%">Keterangan</th>
      </tr>';

// add data to the table
$count = 1;
while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  // cek pembayaran
  $pembayaran = '';
  $pembayaranColor = '';
  
  $cekQuery = "SELECT COUNT(id) as id FROM `keuangan_tpq`
              WHERE `tanggal` LIKE '%$setMonth%' AND
              `keterangan` LIKE '%".$data['nama_lengkap']."%'";
  $cekResult = mysqli_query($conn, $cekQuery);
  $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);
  
  if($cekData['id'] > 0) {
    $pembayaran = 'Sudah Bayar';
  } else {
    $pembayaran = 'Belum Bayar';
    $pembayaranColor = 'color: red;';
  }

  $setData .= '
  <tr>
    <td style="text-align: center">'.$count++.'</td>
    <td style="text-align: center">'.$data['induk'].'</td>
    <td>'.$data['nama_lengkap'].'</td>
    <td>'.$data['nama_ortu'].'</td>
    <td style="text-align: center; '.$pembayaranColor.'">'.$pembayaran.'</td>
  </tr>';
}

// closing the table
$setData .= '
    </table>
  </body>
</html>
';

$pdf->writeHTMLCell(0, 0, '', '', $setData, 0, 1, 0, true, '', true);

$pdf->Output('spp.pdf', 'I');
?>