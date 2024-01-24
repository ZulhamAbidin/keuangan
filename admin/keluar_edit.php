<?php
include 'src/header.php';

if (isset($_GET['id_keluar'])) {
    $id = $_GET['id_keluar'];

    $query = mysqli_query($koneksi, "SELECT * FROM data_keluar WHERE id_keluar = '$id'");
    $data  = mysqli_fetch_array($query);

    if (isset($_POST['simpan'])) {
        $tggl  = date('Y-m-d', strtotime($_POST['tanggal_keluar']));
        $jml   = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
        $ket   = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

        $gambar = $_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $folder = 'gambar/data_keluar/';

        if (!empty($gambar)) {
            $gambarPath = $folder . $gambar;
            move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . '/keuangan/admin/' . $gambarPath);
        } else {
            $gambarPath = $data['gambar'];
        }

        $updateQuery = "UPDATE data_keluar SET tanggal_keluar = '$tggl', jumlah = '$jml', keterangan = '$ket', gambar = '$gambarPath' WHERE id_keluar = '$id'";
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
} else {
    echo "Parameter 'id_keluar' tidak valid atau tidak ada.";
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
        <h1 class="page-title">Pengeluaran</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengeluaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
  <div class="card">
    <div class="card-header with-border">
      <h3 class="card-title">Edit Data Pengeluaran</h3>
    </div>
    <div class="card-body">
      <?php
      $id = $_GET['id_keluar'];
      $query = mysqli_query($koneksi, "SELECT * FROM data_keluar WHERE id_keluar = '$id'");
      $data  = mysqli_fetch_array($query);
      ?>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="form-control-label" for="tanggal_keluar">Tanggal</label>
          <input type="date" class="form-control" name="tanggal_keluar" value="<?= $data['tanggal_keluar'] ?>" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label class="form-control-label" for="jumlah">Jumlah Pengeluaran (Rp)</label>
          <input type="text" class="form-control" name="jumlah" autocomplete="off" value="<?= $data['jumlah'] ?>" placeholder="Input Jumlah Pengeluaran (Rp)" oninput="updateFormat()" id="format"  required> 
        </div>
        <div class="form-group">
          <label class="form-control-label" for="keterangan">Keterangan</label>
          <input type="text" class="form-control" name="keterangan" autocomplete="off" value="<?= $data['keterangan'] ?>" placeholder="Input Keterangan Pengeluaran" required>
        </div>
        <div class="form-group">
          <label class="form-control-label" for="gambar">Gambar</label>
          <input type="file" class="form-control" name="gambar" accept="image/*">
        </div>
        <div class="form-group">
          <button type="submit" class='btn btn-md btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>