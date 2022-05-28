<?


?>

<!DOCTYPE html>
<html>
  <!-- table -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover" id="dataTables-table">
      <thead class="table-secondary">
        <tr class="text-center align-middle">
          <th scope="col" width="10%">NIS</th>
          <th scope="col">Nama Lengkap</th>
          <th scope="col">Keterangan</th>
          <th scope="col" width="10%">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        echo $searchDate;
          // jika bulan adalah bulan sekarang (today)
          if($today['isToday']) {
            while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              echo "<tr class='text-center align-middle'><td>".$data['induk']."</td>";
              echo "<td>".ucwords(strtolower($data['nama_lengkap']))."</td>";?>
              <td>
                <button type="submit" name="hadir" class="btn btn-outline-success btn-sm">Hadir</button>
                <button type="submit" name="tidakhadir" class="btn btn-outline-danger btn-sm">Tidak Hadir</button>
              </td>
              <!-- button ralat -->
              <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal" disabled>Ralat</button></td></tr><?php
            }
          } else {
            while($data = mysqli_fetch_array($result, MYSQLI_ASSOC)){
              $nis = $data['nis'];
              echo "<tr class='text-center align-middle'><td>".$data['nis']."</td>";
              echo "<td>".ucwords(strtolower($data['nama']))."</td>";
              if($data['keterangan'] == "HADIR") {
                echo "<td><span class='badge bg-success'>Hadir</span></td>";
              } else {
                echo "<td><span class='badge bg-danger'>Tidak Hadir</span></td>";
              } ?>

              <!-- button ralat -->
              <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal">Ralat</button></td></tr>
              
              <!-- Modal Detail -->
              <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ralat Presensi Santri</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <label class="col-sm-5">Nama Lengkap</label>
                        <p class="col-sm-7"><?= ucwords(strtolower($data['nama']))?></p>
                      </div>
                      <div class="row">
                        <label class="col-sm-5">Keterangan</label>
                        <div class="col-sm-7">
                          <input type="radio" class="btn-check" name="keterangan" id="success-outlined2" autocomplete="off" value="HADIR">
                          <label class="btn btn-outline-success btn-sm" for="success-outlined2">Hadir</label>

                          <input type="radio" class="btn-check" name="keterangan" id="danger-outlined2" autocomplete="off" value="TIDAK HADIR">
                          <label class="btn btn-outline-danger btn-sm" for="danger-outlined2">Tidak Hadir</label>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="ralat" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div><?php
            }
          }
        ?>
      </tbody>
    </table>
  </div>
</html>