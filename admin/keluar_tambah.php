<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $tggl  = date('Y-m-d', strtotime($_POST['tanggal_keluar']));
  $jml   = $_POST['jumlah'];
  $ket   = $_POST['keterangan'];

  // Proses gambar
  $gambar = $_FILES['gambar']['name'];
  $tmpName = $_FILES['gambar']['tmp_name'];
  $folder = 'gambar/data_keluar/';

  // Jika ada gambar baru diupload
  if (!empty($gambar)) {
      $gambarPath = $folder . $gambar;
      move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . '/program_uang/admin/' . $gambarPath);
  } else {
      // Jika tidak ada gambar baru diupload, set nilai gambar ke string kosong
      $gambarPath = '';
  }

  $simpan = mysqli_query($koneksi, "INSERT INTO data_keluar (tanggal_keluar, jumlah, keterangan, gambar) VALUES('$tggl','$jml','$ket','$gambarPath')");

  if ($simpan) {
      echo "<script>
            Swal.fire({
              title: 'Data Berhasil Disimpan',
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location='data_keluar.php';
              }
            });
          </script>";
      exit;
  } else {
      echo "<script>
            Swal.fire({
              title: 'Gagal Menyimpan Data',
              text: 'Terjadi kesalahan saat menyimpan data: " . mysqli_error($koneksi) . "',
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
        <h1 class="page-title">Tambah Data Pengeluaran</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengeluaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Pengeluaran</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="tanggal_keluar" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal_keluar" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pengeluaran (Rp)</label>
                    <input type="text" class="form-control" name="jumlah" autocomplete="off" placeholder="Input Jumlah Pengeluaran (Rp)" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" autocomplete="off" placeholder="Input Keterangan Pengeluaran" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar" accept="image/*">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" name="simpan">
                        <span aria-hidden="true"></span>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>
