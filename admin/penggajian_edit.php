<!-- penggajian edit -->

<?php
include 'src/header.php';

if (isset($_GET['id_penggajian'])) {
    $id = $_GET['id_penggajian'];

    $query = mysqli_query($koneksi, "SELECT * FROM data_penggajian WHERE id_penggajian = '$id'");
    $data  = mysqli_fetch_array($query);

    if (isset($_POST['simpan'])) {
        $tggl  = date('Y-m-d', strtotime($_POST['tanggal_gaji']));
        $nip   = $_POST['nip'];
        $keterangan   = $_POST['keterangan'];
        $nama  = $_POST['nama_karyawan'];
        $gaji  = $_POST['banyak_gaji'];

        $gambarFolder = 'gambar/data_penggajian/';
$gambarNama   = $_FILES['gambar']['name'];
$gambar_tmp   = $_FILES['gambar']['tmp_name'];

if (!empty($gambarNama)) {
    $gambarPath = $gambarFolder . $gambarNama;
    if (move_uploaded_file($gambar_tmp, __DIR__ . '/' . $gambarPath)) {
        // Hapus gambar lama jika diperlukan
        if (!empty($data['gambar']) && file_exists(__DIR__ . '/' . $data['gambar'])) {
            unlink(__DIR__ . '/' . $data['gambar']);
        }
    } else {
        echo "<script>
                Swal.fire({
                  title: 'Gagal Mengunggah Gambar',
                  text: 'Terjadi kesalahan saat mengunggah gambar.',
                  icon: 'error',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                });
              </script>";
        exit;
    }
} else {
    $gambarPath = $data['gambar'];
}

// Lanjutkan dengan proses update database
$updateQuery1 = "UPDATE data_penggajian SET nip = '$nip', tanggal_gaji = '$tggl', nama_karyawan = '$nama', keterangan = '$keterangan', banyak_gaji = '$gaji', gambar = '$gambarPath' WHERE id_penggajian = '$id'";
$simpan1 = mysqli_query($koneksi, $updateQuery1);
$updateQuery2 = "UPDATE data_keluar SET tanggal_keluar = '$tggl', jumlah = '$gaji', keterangan = '$keterangan', gambar = '$gambarPath' WHERE id_penggajian = '$id'";
$simpan2 = mysqli_query($koneksi, $updateQuery2);

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
                window.location='data_penggajian.php';
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
    echo "Parameter 'id_penggajian' tidak valid atau tidak ada.";
}
?>

<script>
  function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return 'Rp.' + ribuan;
  }

  function updateFormat() {
    var gajiInput = document.getElementById('format');
    var gajiValue = gajiInput.value.replace(/\D/g, '');
    gajiInput.value = formatRupiah(gajiValue);
  }
</script>

<div class="container">
  <div class="page-header">
    <h1 class="page-title">Penggajian</h1>
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Penggajian</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Edit Data Penggajian</h3>
    </div>
    <div class="card-body">
       <?php
            $id = $_GET['id_penggajian'];
            $query = mysqli_query($koneksi, "SELECT * FROM data_penggajian WHERE id_penggajian = '$id'");
            $data  = mysqli_fetch_array($query);
            ?>

      <form method="post" action="" enctype="multipart/form-data">
        <div class="alert alert-info" role="alert">
          Anda sedang mengedit data <?= $data['nama_karyawan'] ?>
        </div>
         <div class="form-group">
          <label class="form-label" for="tanggal_gaji">Tanggal Penggajian</label>
          <input type="date" class="form-control" name="tanggal_gaji" value="<?= $data['tanggal_gaji'] ?>" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="nip">NIP/NIPTT <small class="text-danger ps-1">Optional </small> </label>
          <input type="text" class="form-control" name="nip" autocomplete="off" value="<?= $data['nip'] ?>" placeholder="Input Nomor Induk Pegawai atau Nomor Induk Pegawai Tidak Tetap">
        </div>
        <div class="form-group">
          <label class="form-label" for="nama_karyawan">Nama Karyawan</label>
          <input type="text" class="form-control" name="nama_karyawan" autocomplete="off" value="<?= $data['nama_karyawan'] ?>" placeholder="Input Nama Karyawan" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="banyak_gaji">Banyak Gaji</label>
          <input type="text" class="form-control" name="banyak_gaji" value="<?= $data['banyak_gaji'] ?>" oninput="updateFormat()" id="format" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="keterangan">Keterangan</label>
          <textarea type="text" required class="form-control" name="keterangan"> <?= $data['keterangan'] ?> </textarea>
        </div>
        <div class="form-group">
          <label class="form-label" for="gambar">Upload Gambar</label>
          <input type="file" required class="form-control" name="gambar" accept="image/*">
        </div>
        <div class="form-group">
          <button type="submit" class='btn btn-md btn-primary' name="simpan">
            <span aria-hidden="true"></span>Simpan
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<?php
function formatRupiah($angka){
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}
?>
<?php include 'src/footer.php'; ?>