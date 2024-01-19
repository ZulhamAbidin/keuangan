<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $tggl  = date('Y-m-d', strtotime($_POST['tanggal_jual']));
  $nma   = $_POST['nama_barang'];
  $jml   = $_POST['jumlah_jual'];
  $ket   = "Transaksi Penjualan ".$nma;

  $simpan = mysqli_query($koneksi, "INSERT INTO data_penjualan VALUES('','$tggl','$nma','$jml')");
  $simpan = mysqli_query($koneksi, "INSERT INTO data_masuk VALUES('','$tggl','$jml','$ket')");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_penjualan.php'</script>";

}
?>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Menu Makanan Dan Minumam</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form action="" method="POST">
            <div class="form-group">
              <label class="form-control-label" for="tanggal_jual">Tanggal Penjualan</label>
              <input type="date" class="form-control" name="tanggal_jual" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="nama_barang">Nama Makanan/minuman</label>
              <input type="text" class="form-control" name="nama_barang" autocomplete="off" placeholder="Masukan Nama Barang" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="jumlah_jual">Harga Jual(Rp)</label>
              <input type="text" class="form-control" name="jumlah_jual" autocomplete="off" placeholder="Input Jumlah Penjualan (Rp)" required>
            </div>
            <div class="form-group">
              <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'src/footer.php'; ?>