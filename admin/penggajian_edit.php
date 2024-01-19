<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'src/header.php';

if(isset($_POST['simpan'])){
  $tggl  = date('Y-m-d', strtotime($_POST['tanggal_gaji']));
  $nip   = $_POST['nip'];
  $nama  = $_POST['nama_karyawan'];
  $gaji  = $_POST['banyak_gaji'];

  $gambarFolder = 'gambar/data_penggajian/';
  $gambarNama   = $_FILES['gambar']['name'];
  $gambarPath   = $gambarFolder . $gambarNama; 

  move_uploaded_file($_FILES['gambar']['tmp_name'], $gambarPath);

  $simpan1 = mysqli_query($koneksi, "UPDATE data_penggajian SET nip = '$nip', tanggal_gaji = '$tggl', nama_karyawan = '$nama', banyak_gaji = '$gaji', gambar = '$gambarPath' WHERE id_penggajian = '$_GET[id_penggajian]'");

  $simpan2 = mysqli_query($koneksi, "UPDATE data_keluar SET tanggal_keluar = '$tggl', jumlah = '$gaji' WHERE id_keluar = '$_GET[id_penggajian]'");
  
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
?>

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
        <div class="form-group">
          <label class="form-label" for="tanggal_gaji">Tanggal Penggajian</label>
          <input type="date" class="form-control" name="tanggal_gaji" value="<?= $data['tanggal_gaji'] ?>" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="nip">NIP Karyawan</label>
          <input type="text" class="form-control" name="nip" autocomplete="off" value="<?= $data['nip'] ?>" placeholder="Input NIP Karyawan" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="nama_karyawan">Nama Karyawan</label>
          <input type="text" class="form-control" name="nama_karyawan" autocomplete="off" value="<?= $data['nama_karyawan'] ?>" placeholder="Input Nama Karyawan" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="banyak_gaji">Gaji Karyawan</label>
          <input type="text" class="form-control" name="banyak_gaji" autocomplete="off" value="<?= $data['banyak_gaji'] ?>" placeholder="Input Gaji Karyawan" required>
        </div>
        <div class="form-group">
          <label for="gambar">Upload Gambar</label>
          <input type="file" class="form-control" name="gambar" accept="image/*">
        </div>
        <div class="form-group">
          <button type="submit" class='btn btn-primary' name="simpan">
            <span aria-hidden="true"></span>Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>