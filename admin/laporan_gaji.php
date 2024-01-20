<?php include 'src/header.php'; ?>
<div class="container">

  <div class="page-header">
    <h1 class="page-title">Cetak Laporan Penggajian</h1>
    <div>
      <ol class="breadcrumb">

      </ol>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Cetak Laporan Penggajian</div>
        </div>
        <div class="card-body">
          <form method="POST" action="penggajian_cetak.php" target="_blank()">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Dari Tanggal :</label>
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                    <input type="date" name="tanggal1" class="form-control" autocomplete="off" required>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Sampai Tanggal :</label>
                  <div class="input-group">
                    <div class="input-group-text">
                      <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                    </div>
                    <input type="date" name="tanggal2" class="form-control" autocomplete="off" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <button type="submit" name="cetak" id="cetak" class="btn btn-primary">Cetak</button>
                <button type="reset" class="btn btn-danger">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" id="example1" width="100%"
          cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>NIP</th>
              <th>Nama Karyawan</th>
              <th>Gaji</th>
            </tr>
          </thead>
          <tbody>
            <?php
                      $no = 1;
                      $query = mysqli_query($koneksi, "SELECT * FROM data_penggajian");
                      while ($data = mysqli_fetch_array($query)) {
                      ?>
            <tr>
              <td><?= $no++ ?></td>
              <td>
                <?php
                                        // Mendapatkan tanggal dari variabel $data['tanggal_gaji']
                                        $tanggalGaji = $data['tanggal_gaji'];

                                        // Mengonversi tanggal menjadi format yang diinginkan
                                        $timestamp = strtotime($tanggalGaji);
                                        $tanggalFormat = date('d, F, Y', $timestamp);
                                        
                                        // Menampilkan tanggal yang telah di-format
                                        echo $tanggalFormat;
                                        ?>
              </td>

              <td><?= $data['nip'] ?></td>
              <td><?= $data['nama_karyawan'] ?></td>
              <td><?= $data['banyak_gaji'] ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


<script>
    function showImageModal(imageUrl) {
        // Tetapkan gambar pada elemen img di dalam modal
        document.getElementById('modalImage').src = imageUrl;
        // Tampilkan modal
        $('#imageModal').modal('show');
    }
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="../sash/js/jquery.min.js"></script>


<?php include 'src/footer.php'; ?>