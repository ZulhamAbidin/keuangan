
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

    if (!$data) {
        // ID penjualan tidak ditemukan, berikan pesan kesalahan atau redirect ke halaman lain
        echo "ID Penjualan tidak ditemukan.";
        exit;
    }

    $gambarLama = $data['gambar'];

    // Mengelola pengunggahan gambar
    $gambar = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $folder = 'gambar/data_penjualan/';

    // Memeriksa apakah ada gambar baru diunggah
    if (!empty($gambar)) {
        // Jika ada gambar baru diunggah
        $gambarPath = $folder . $gambar;
        if (move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . '/program_uang/admin/' . $gambarPath)) {
            // Pengunggahan berhasil
        } else {
            // Pengunggahan gagal
            echo "Gagal mengunggah gambar.";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru diunggah, gunakan gambar lama
        $gambarPath = $gambarLama;
    }

    // Query untuk menyimpan data di tabel data_penjualan
    $updateDataPenjualan = mysqli_query($koneksi, "UPDATE data_penjualan SET tanggal_jual = '$tggl', nama_barang = '$nma', jumlah_jual = '$jml', gambar = '$gambarPath' WHERE id_penjualan = '$id'");

    // Query untuk menyimpan data di tabel data_masuk
    $updateDataMasuk = mysqli_query($koneksi, "UPDATE data_masuk SET tanggal_masuk = '$tggl', keterangan = '$nma', jumlah_masuk = '$jml' WHERE id_penjualan = '$id'");

    if ($updateDataPenjualan && $updateDataMasuk) {
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

<div class="container">
    <div class="page-header">
        <h1 class="page-title">Penjualan</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Penjualan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Edit Data Penjualan</h3>
        </div>
        <div class="card-body">
            <?php
            $id = $_GET['id_penjualan'];
            $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id'");
            $data  = mysqli_fetch_array($query);
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
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
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
</div>

<?php include 'src/footer.php'; ?>