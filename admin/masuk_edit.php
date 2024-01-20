<?php
include 'src/header.php';

if (isset($_GET['id_masuk'])) {
    $id = $_GET['id_masuk'];

    $query = mysqli_query($koneksi, "SELECT * FROM data_masuk WHERE id_masuk = '$id'");
    $data  = mysqli_fetch_array($query);

    if (isset($_POST['simpan'])) {
        $tggl  = date('Y-m-d', strtotime($_POST['tanggal_masuk']));
        $jml   = mysqli_real_escape_string($koneksi, $_POST['jumlah_masuk']);
        $ket   = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

        // Mengelola pengunggahan gambar
        $gambar = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $folder = 'gambar/data_masuk/';

        // Memeriksa apakah ada gambar baru diunggah
        if (!empty($gambar)) {
            // Jika ada gambar baru diunggah
            $gambarPath = $folder . $gambar;
            move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . '/program_uang/admin/' . $gambarPath);
        } else {
            // Jika tidak ada gambar baru diunggah, gunakan gambar lama
            $gambarPath = $data['gambar'];
        }

        $updateQuery = "UPDATE data_masuk SET tanggal_masuk = '$tggl', jumlah_masuk = '$jml', keterangan = '$ket', gambar = '$gambarPath' WHERE id_masuk = '$id'";
        $simpan1 = mysqli_query($koneksi, $updateQuery);

        if ($simpan1) {
            echo "<script>
                    Swal.fire({
                      title: 'Data Berhasil Disimpan',
                      icon: 'success',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location='data_masuk.php';
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
} else {
    echo "Parameter 'id_masuk' tidak valid atau tidak ada.";
}
?>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">Pemasukan</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pemasukan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Data Pemasukan</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" name="tanggal_masuk" value="<?= $data['tanggal_masuk'] ?>" autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_masuk" class="form-label">Jumlah Pemasukan (Rp)</label>
                    <input type="text" class="form-control" name="jumlah_masuk" autocomplete="off" value="<?= $data['jumlah_masuk'] ?>" placeholder="Input Jumlah Pemasukan (Rp)" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" autocomplete="off" value="<?= $data['keterangan'] ?>" placeholder="Input Keterangan Pemasukan" required>
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
