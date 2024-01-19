<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $tggl  = date('Y-m-d', strtotime($_POST['tanggal_jual']));
  $nma   = $_POST['nama_barang'];
  $jml   = $_POST['jumlah_jual'];

  $simpan1 = mysqli_query($koneksi, "UPDATE data_penjualan SET tanggal_jual = '$tggl', nama_barang = '$nma', jumlah_jual = '$jml' WHERE id_penjualan = '$_GET[id_penjualan]'");

  $simpan2 = mysqli_query($koneksi, "UPDATE data_masuk SET tanggal_masuk = '$tggl', jumlah_masuk = '$jml' WHERE id_masuk = '$_GET[id_penjualan]'");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_penjualan.php'</script>";

}
?>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Penjualan</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php
          $id = $_GET['id_penjualan'];
          $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id'");
          $data  = mysqli_fetch_array($query);
          ?>
          <form action="" method="POST">
            <div class="form-group">
              <label class="form-control-label" for="tanggal_jual">Tanggal Penjualan</label>
              <input type="date" class="form-control" name="tanggal_jual" value="<?= $data['tanggal_jual'] ?>" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="nama_barang">Nama Makanan</label>
              <input type="text" class="form-control" name="nama_barang" value="<?= $data['nama_barang'] ?>" placeholder="Masukan Nama Barang" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="jumlah_jual">Harga Jual (Rp)</label>
              <input type="text" class="form-control" name="jumlah_jual" autocomplete="off" value="<?= $data['jumlah_jual'] ?>" placeholder="Input Jumlah Penjualan (Rp)" required>
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