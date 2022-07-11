<?php
require_once('../../../../vendor/autoload.php');
require_once('../../../../config.php');
require_once('../../../../helper.php');
require_once('../../../akses.php');

define('K_PATH_IMAGES', '../../../../../assets/image/');

// get id for presensi
$id = '';
$templateToday = '';
$manyDays = 0;
if(isset($_GET['id'])) {
  $id = $_GET['id'];

  $dateQuery = "SELECT * FROM `filter_presensi` WHERE `id` LIKE '$id'";
  $dateResult = mysqli_query($conn, $dateQuery);
  $dateData = mysqli_fetch_array($dateResult, MYSQLI_ASSOC);

  $bulan = monthConverter($dateData['bulan']);
  $templateToday = $dateData['tahun']."-".$bulan."-";

  // get many days of the month
  $manyDays = cal_days_in_month(CAL_GREGORIAN,$bulan,$dateData['tahun']);
} else {
  header("Location: ../presensi.php");
}

// get data from database
$query = "SELECT `induk`,`nama_lengkap` FROM `santri`";
$result = mysqli_query($conn, $query);

// Start of TCPDF
// create new PDF
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document info
$pdf->setCreator('Tim Annuur');
$pdf->setTitle('Informasi Absensi');
$pdf->setSubject('Absensi Santri');

// header & footer data
$pdf->setHeaderData('logo-annur-bulat-tanpa-alpha.jpg', 16, 'Informasi Absensi Santri', "Periode ".ucfirst(strtolower($dateData['bulan']))." ".$dateData['tahun'], array(8,138,68), array(0,0,0));
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
$pdf->setFont(PDF_FONT_NAME_MAIN, '', 11, '', true);

$pdf->AddPage();
// End of TCPDF

// Start of Set Data for Table
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
        <th width="4%">#</th>
        <th width="18.5%">Nama</th>
';

// days of the month
for($i=1;$i<=$manyDays;$i++) {
  $setData .= '<th width="2.5%" style="text-align: center">'.$i.'</th>';
}
$setData .= '</tr>';

// add data to the table
$count = 1;
while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  
  $setData .= '
    <tr>
      <td style="text-align: center">'.$count++.'</td>
      <td>'.$data['nama_lengkap'].'</td>';

  // set attendance
  for($i=1;$i<=$manyDays;$i++) {
    // set date for filter
    $today = $templateToday;
    if($i < 10) {
      $today .= "0".$i;
    } else {
      $today .= $i;
    }

    // get attendance data from database
    $cekPresensi = "SELECT keterangan FROM `presensi_santri`
                    WHERE tanggal LIKE '$today' AND santri_induk LIKE '".$data['induk']."'";
    $cekResult = mysqli_query($conn, $cekPresensi);
    $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

    // checking data
    if(!empty($cekData['keterangan'])) {
      if($cekData['keterangan'] == "HADIR") {
        $setData .= '<td style="text-align: center; color: green;">V</td>';
      } else {
        $setData .= '<td style="text-align: center; color: red;">X</td>';
      }
    } else {
      $setData .= '<td></td>';
    }
  }
  $setData .= '</tr>';
}
// End of Set Data for Table

// closing the table
$setData .= '
    </table>
  </body>
</html>
';

$pdf->writeHTMLCell(0, 0, '', '', $setData, 0, 1, 0, true, '', true);

$pdf->Output('absensi.pdf', 'I');
?>