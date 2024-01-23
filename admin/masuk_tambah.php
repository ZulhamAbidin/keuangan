<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $lokasi_gambar = "gambar/data_masuk/$gambar";
    move_uploaded_file($gambar_tmp, $lokasi_gambar);
    $tggl  = date('Y-m-d', strtotime($_POST['tanggal_masuk']));
    $jml   = preg_replace("/[^0-9]/", "", $_POST['jumlah_masuk']);
    $ket   = $_POST['keterangan'];
    $query = "INSERT INTO data_masuk (tanggal_masuk, jumlah_masuk, gambar, keterangan) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $tggl, $jml, $lokasi_gambar, $ket);
    $simpan = mysqli_stmt_execute($stmt);

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
                window.location='data_masuk.php';
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
    <h1 class="page-title">Pemasukan</h1>
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Pemasukan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Data Pemasukan</h3>
    </div>
    <div class="card-body">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="tanggal_masuk">Tanggal Masuk:</label>
          <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" required>
        </div>

        <div class="form-group">
          <label for="jumlah_masuk">Jumlah Masuk:</label>
          <input type="text" class="form-control" name="jumlah_masuk" oninput="updateFormat()" id="format" required>
        </div>

        <div class="form-group">
          <label for="keterangan">Keterangan:</label>
          <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
        </div>

        <div class="form-group">
          <label for="gambar">Gambar:</label>
          <input type="file" class="form-control" name="gambar" id="gambar">
        </div>

        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
      </form>
    </div>
  </div>
</div>

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

<?php include 'src/footer.php'; ?>