<?php
require_once('../../../config.php');
require_once('../../../helper.php');
require_once('../../akses.php');

// connect & query database
$query = "SELECT * FROM `santri`";
$result = mysqli_query($conn, $query);

// function for date formatting
function formatTanggal($date){
  return date('d-m-Y', strtotime($date));
}
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
        <h3>Data Santri</h3>
        
        <!-- card content -->
        <div class="card border shadow">
          <div class="card-body m-3">
            <!-- button tambah data -->
            <div>
              <a href="action/tambah.php" class="btn btn-success">
                <span>Tambah Data Santri</span>
              </a>
            </div><hr class="my-3">

            <!-- table -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover dt-responsive nowrap" id="dataTables-table">
                <thead class="table-secondary">
                  <tr class="text-center align-middle">
                    <th scope="col">NIS</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Nama Panggilan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    // fetch data menjadi array asosisasi
                    while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                      echo "<tr class='text-center'><td>".$data['nis']."</td>";
                      echo "<td class='text-start'>".$data['nama_lengkap']."</td>";
                      echo "<td class='text-start'>".$data['panggilan']."</td>";?>
                      <!-- button trigger modal detail -->
                      <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="Detail" data-bs-toggle="modal" data-bs-target="#detailModal<?=$data['nis']?>">
                          <span><i class="bi bi-journal"></i><span>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModalDanger<?=$data['nis']?>">
                          <span><i class="bi bi-trash"></i><span>
                        </button>
                      </td></tr>
                      
                      <!-- Modal Detail -->
                      <div class="modal fade" id="detailModal<?=$data['nis']?>" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Data Lengkap Santri</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <label class="col-sm-5">Nomor Induk Santri</label>
                                <p class="col-sm-7"><?=$data['nis']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Lengkap</label>
                                <p class="col-sm-7"><?=$data['nama_lengkap']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Panggilan</label>
                                <p class="col-sm-7"><?=$data['panggilan']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Tempat, Tanggal Lahir</label>
                                <p class="col-sm-7"><?=$data['tempat_lahir']?>, <?=formatTanggal($data['tgl_lahir'])?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Jenjang Sekolah</label>
                                <p class="col-sm-7"><?=$data['jenjang_sekolah']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Kelas</label>
                                <p class="col-sm-7"><?=$data['kelas']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Bapak</label>
                                <p class="col-sm-7"><?=$data['nama_bapak']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Pekerjaan Bapak</label>
                                <p class="col-sm-7"><?=$data['pekerjaan_bapak']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nama Ibu</label>
                                <p class="col-sm-7"><?=$data['nama_ibu']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Pekerjaan Ibu</label>
                                <p class="col-sm-7"><?=$data['pekerjaan_ibu']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Nomor Telepon Wali</label>
                                <p class="col-sm-7"><?=$data['no_telp_ortu']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Alamat</label>
                                <p class="col-sm-7"><?=$data['alamat_ortu']?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Infak Bulanan</label>
                                <p class="col-sm-7"><?=setIDRFormat($data['infak_bulanan'])?></p>
                              </div>
                              <div class="row">
                                <label class="col-sm-5">Status</label>
                                <p class="col-sm-7"><?=$data['status']?></p>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <a role="button" class="btn btn-warning" href="action/ubah.php?nis=<?=$data['nis']?>">Edit</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Delete Modal Danger -->
                      <div class="modal fade" tabindex="-1" id="deleteModalDanger<?= $data['nis']?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Peringatan!</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <span>Apakah anda yakin untuk menghapus data ini?</span>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                              <a href="action/delete.php?nis=<?=$data['nis']?>" class="btn btn-danger">
                                <span>Hapus</span>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div><?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script>
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
      });
    </script>
  </body>
</html>