<?php
require_once('../../config.php');

// filter tanggal
$start = ""; 
$end = "";
if(isset($_POST['start'])) {
  $start = $_POST['start'];
  $end = $_POST['end'];
} elseif(isset($_POST['end'])) {
  $start = $_POST['start'];
  $end = $_POST['end'];
}
$setStart = '%'.$start.'%';
$setEnd = '%'.$end.'%';

// connect & query database
$query = "SELECT * FROM `keuangan_tpq` WHERE (`tanggal` BETWEEN ? AND ?)";
$setQuery = $conn->prepare($query);
$setQuery->bind_param('ss', $setStart, $setEnd);
$setQuery->execute();
$result = $setQuery->get_result();
?>

<!DOCTYPE html>
<html>
  <!-- table -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover dt-responsive nowrap" id="dataTables-table">
      <thead class="table-secondary">
        <tr class="text-center align-middle">
          <th scope="col">#</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Kas Masuk</th>
          <th scope="col">Kas Keluar</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $count = 1;
          if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $tanggal = $row['tanggal'];
              $keterangan = $row['keterangan'];
              $masuk = $row['masuk'];
              $keluar = $row['keluar']; ?>

              <tr class="text-center align-middle">
                <td><?= $count++?></td>
                <td><?= $tanggal?></td>
                <td><?= $keterangan?></td>
                <td><?= $masuk?></td>
                <td><?= $keluar?></td>
              </tr> <?php
            }
          } else {
            echo "<tr><td colspan='5'>Tidak ada data ditemukan</td></tr>";
          }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3" class="fw-bold">Jumlah</td>
          <td class='text-center align-middle'>Rp 0</td>
          <td class='text-center align-middle'>Rp 0</td>
        </tr>
        <tr>
          <td colspan="3" class="fw-bold">Saldo Saat Ini</td>
          <td colspan="2" class='text-center align-middle'>Rp 0</td>
        </tr>
      </tfoot>
    </table>
  </div>
</html>