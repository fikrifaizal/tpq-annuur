<?php
require_once('../../../vendor/autoload.php');
require_once('../../../config.php');
require_once('../../helper.php');
require_once('../../akses.php');

define('K_PATH_IMAGES', '../../../assets/image/');

$setMonth = date("m");
$setYear = date("Y");
$setDate = monthConverter2($setMonth)." ".$setYear;

// create new PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document info
$pdf->setCreator('Tim Annuur');
$pdf->setTitle('Rekap SPP');
$pdf->setSubject('Rekap SPP Santri');

// header & footer data
$pdf->setHeaderData('logo-annur-bulat.png', 30, 'Rekap SPP', "Periode $setDate", array(8,138,68), array(0,0,0));
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

$setData = <<<EOD
<table>
  <thead>
    <tr>
      <th scope="col" width="5%">#</th>
      <th scope="col">NIS</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Nama Wali</th>
    </tr>
  </thead>
  <tbody>
    <td>1</td>
    <td>1</td>
    <td>A</td>
    <td>B</td>
  </tbody>
</table>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $setData, 0, 1, 0, true, '', true);

$pdf->Output('tes.pdf', 'I');
?>