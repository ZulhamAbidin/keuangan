<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
    $tggl = date('Y-m-d', strtotime($_POST['tanggal_jual']));
    $nma = $_POST['nama_barang'];
    $jml = $_POST['jumlah_jual'];

    // Mendapatkan data gambar lama dari database
    $id = $_GET['id_penjualan'];
    $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id'");
    $data = mysqli_fetch_array($query);
    $gambarLama = $data['gambar']; // Sesuaikan dengan nama kolom yang menyimpan path gambar di tabel

    // Mengelola pengunggahan gambar
    $gambar = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $folder = 'gambar/data_penjualan/';

    // Memeriksa apakah ada gambar baru diunggah
    if (!empty($gambar)) {
        // Jika ada gambar baru diunggah
        $gambarPath = $folder . $gambar;
        move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . '/program_uang/admin/' . $gambarPath);
    } else {
        // Jika tidak ada gambar baru diunggah, gunakan gambar lama
        $gambarPath = $gambarLama;
    }

    // Query untuk menyimpan data
    $simpan1 = mysqli_query($koneksi, "UPDATE data_penjualan SET tanggal_jual = '$tggl', nama_barang = '$nma', jumlah_jual = '$jml', gambar = '$gambarPath' WHERE id_penjualan = '$_GET[id_penjualan]'");
    $simpan2 = mysqli_query($koneksi, "UPDATE data_masuk SET tanggal_masuk = '$tggl', jumlah_masuk = '$jml' WHERE id_masuk = '$_GET[id_penjualan]'");

     if ($simpan1 && $simpan2) {
        echo "<script>
                Swal.fire({
                  title: 'Data Berhasil Disimpan',
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location='data_penjualan.php';
                  }
                });
              </script>";
        exit; 
      } else {
        echo "<script>
                Swal.fire({
                  title: 'Gagal Menyimpan Data',
                  text: 'Terjadi kesalahan saat menyimpan data.',
                  icon: 'error',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                });
              </script>";
        exit; 
      }
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
          <form action="" method="POST" enctype="multipart/form-data">
                <!-- ... (bagian yang tidak diubah) ... -->
                <div class="form-group">
                    <label class="form-control-label" for="gambar">Gambar</label>
                    <input type="file" class="form-control" name="gambar" accept="image/*">
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