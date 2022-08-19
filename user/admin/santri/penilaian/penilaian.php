<?php
include_once('../../../config.php');
require_once('../../akses.php');

// connect & query database
$query = "SELECT `induk`,`nama_lengkap` FROM `santri` WHERE `status` LIKE 'AKTIF'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TPQ - Masjid Annuur</title>
    <!-- style css -->
    <link rel="stylesheet" href="/user/admin/layout/style.css" />
    <link rel="shortcut icon" href="/assets/image/logo-annur-bulat.png">
  </head>

  <body>
    <!-- sidebar & navbar -->
    <?php
      include('../../layout/sidebar.php');
    ?>

    <!-- konten -->
    <main>
      <div class="container-fluid content transition">
        <h3>Penilaian Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col" width="5%">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jenjang Awal</th>
                    <th scope="col" width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $count = $jilid = 1;
                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      // cek penilaian
                      $cekQuery = "SELECT EXISTS
                                  (SELECT id FROM `penilaian` WHERE `santri_induk` LIKE '".$data['induk']."')
                                  as ket";
                      $cekResult = mysqli_query($conn, $cekQuery);
                      $cekData = mysqli_fetch_array($cekResult, MYSQLI_ASSOC);

                      echo "<tr class='text-center align-middle'><th>".$count++."</th>";
                      echo "<td>".$data['nama_lengkap']."</td>";

                      if($cekData['ket'] > 0) {
                        $getJenjangQuery = "SELECT jenjang.jenjang as jenjang, penilaian.jenjang_id as jenjang_id FROM `penilaian`
                                            LEFT JOIN `jenjang` ON penilaian.jenjang_id = jenjang.id
                                            WHERE penilaian.santri_induk LIKE '".$data['induk']."' ORDER BY tanggal DESC LIMIT 1";
                        $getJenjangResult = mysqli_query($conn, $getJenjangQuery);
                        $getJenjangData = mysqli_fetch_array($getJenjangResult, MYSQLI_ASSOC);

                        echo "<td>".ucwords(strtolower($getJenjangData['jenjang']))."</td>";
                        $jilid = $getJenjangData['jenjang_id'];
                      }
                      else {
                        echo "<td>Santri Baru</td>";
                        $jilid = 10;
                      } ?>
                      <td>
                        <a type="button" class="btn btn-success btn-sm" href="detail-penilaian.php?induk=<?= $data['induk']?>&jilid=<?= $jilid?>">Nilai</a>
                      </td></tr><?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>