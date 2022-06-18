<?php
require_once('../../config.php');
require_once('../helper.php');

// ambil data setelah search
if(!empty($_GET['start']) && !empty($_GET['end'])){
  $getStartDate = $_GET['start'];
  $getEndDate = $_GET['end'];

  $query = "SELECT * FROM `keuangan_tpq` WHERE `masuk` LIKE '0' AND (`tanggal` BETWEEN '$getStartDate' AND '$getEndDate') ORDER BY `tanggal`";
} else {
  $query = "SELECT * FROM `keuangan_tpq` WHERE `masuk` LIKE '0' ORDER BY `tanggal`";
}

// connect & query database
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <!-- table -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover dt-responsive nowrap" id="dataTables-keluar">
      <thead class="table-secondary">
        <tr class="text-center align-middle">
          <th scope="col">#</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Kas Keluar</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $count = 1;
          $uangMasuk = 0;
          $uangKeluar = 0;

          // fetch data menjadi array asosisasi
          while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            echo "<tr class='text-center align-middle'><td>".$count++."</td>";
            echo "<td>".customDateFormat($data['tanggal'])."</td>";
            echo "<td>".$data['keterangan']."</td>";
            echo "<td>".setIDRFormat($data['keluar'])."</td>";
            
            $uangKeluar = $uangKeluar+intval($data['keluar']);
          }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="fw-bold">Jumlah</td>
          <td class='text-center align-middle'><?= setIDRFormat($uangKeluar)?></td>
        </tr>
      </tfoot>
    </table>
  </div>
  
  <script>
    $(document).ready(function () {
      $('#dataTables-keluar').dataTable();
    });
  </script>
</html>