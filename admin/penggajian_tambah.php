<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $tggl  = date('Y-m-d', strtotime($_POST['tanggal_gaji']));
  $nip   = $_POST['nip'];
  $nama  = $_POST['nama_karyawan'];
  // $gaji  = preg_replace("/[^0-9]/", "", $_POST['banyak_gaji']); // Remove non-numeric characters
  $gaji = mysqli_real_escape_string($koneksi, $_POST['banyak_gaji_numeric']);


  // Mengelola pengunggahan gambar
  $gambarFolder = 'gambar/data_penggajian/';
  $gambarNama   = $_FILES['gambar']['name'];
  $gambarPath   = $gambarFolder . $gambarNama;

  move_uploaded_file($_FILES['gambar']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/program_uang/admin/' . $gambarPath);

  $keterangan = "Penggajian Karyawan: $nama"; // Sesuaikan keterangan sesuai kebutuhan

  // Validasi: Pastikan semua data yang dibutuhkan terisi
  if (empty($tggl) || empty($nip) || empty($nama) || empty($gaji) || empty($gambarNama)) {
    echo "<script>
            Swal.fire({
              title: 'Gagal Menyimpan Data',
              text: 'Mohon lengkapi semua field.',
              icon: 'error',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'OK'
            });
          </script>";
    exit;
  }

  // Simpan data ke dalam tabel data_penggajian
  $simpan = mysqli_query($koneksi, "INSERT INTO data_penggajian (nip, tanggal_gaji, nama_karyawan, banyak_gaji, gambar) VALUES ('$nip', '$tggl', '$nama', '$gaji', '$gambarPath')");

  // Ambil ID terakhir yang di-generate oleh AUTO_INCREMENT
  $lastId = mysqli_insert_id($koneksi);

  // Simpan data ke dalam tabel data_keluar
  $simpanKeluar = mysqli_query($koneksi, "INSERT INTO data_keluar (id_penggajian, tanggal_keluar, jumlah, keterangan, gambar) VALUES ('$lastId', '$tggl', '$gaji', '$keterangan', '$gambarPath')");
  
  if ($simpan && $simpanKeluar) {
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
  var gajiValue = gajiInput.value.replace(/\D/g, ''); // Remove non-digit characters
  gajiInput.value = formatRupiah(gajiValue);

  // Update the hidden input with the numeric value
  var numericInput = document.getElementById('banyak_gaji_numeric');
  numericInput.value = gajiValue;
}
</script>


<div class="container">
  <div class="page-header">
    <h1 class="page-title">Penggajian</h1>
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Penggajian</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Data Penggajian</h3>
    </div>
    <div class="card-body">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label for="tanggal_gaji">Tanggal Penggajian</label>
          <input type="date" class="form-control" name="tanggal_gaji" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="nip">NIP Karyawan</label>
          <input type="text" class="form-control" name="nip" autocomplete="off" placeholder="Input NIP Karyawan"
           " required>
        </div>
        <div class="form-group">
          <label for="nama_karyawan">Nama Karyawan</label>
          <input type="text" class="form-control" name="nama_karyawan" autocomplete="off"
            placeholder="Input Nama Karyawan"  required>
        </div>
        <div class="form-group">
  <label for="banyak_gaji">Banyak Gaji</label>
  <input type="text" class="form-control" name="banyak_gaji" autocomplete="off" oninput="updateFormat()" id="format" placeholder="Input Gaji Karyawan" required>
  <!-- Hidden input for storing the numeric value -->
  <input type="hidden" name="banyak_gaji_numeric" id="banyak_gaji_numeric">
</div>

        <div class="form-group">
          <label for="nip">Gambar</label>
          <input type="file" class="form-control" name="gambar" accept="image/*" autocomplete="off" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn btn-primary" name="simpan">
            <span aria-hidden="true"></span>Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>
