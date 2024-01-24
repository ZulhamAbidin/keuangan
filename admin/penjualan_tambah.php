<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
    $tggl  = date('Y-m-d', strtotime($_POST['tanggal_jual']));
    $nma   = $_POST['nama_barang'];
    $jml   = preg_replace("/[^0-9]/", "", $_POST['jumlah_jual']); 
    $ket   = "Transaksi Penjualan ".$nma;
    $tanggal_jual = $_POST['tanggal_jual'];
$tggl = date('Y-m-d', strtotime($tanggal_jual));
    $gambar = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $folder = 'gambar/data_penjualan/';
    if (!empty($gambar)) {
        $gambarPath = $folder . $gambar;
        move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'].'keuangan/admin/'.$gambarPath);
    } else {
        $gambarPath = NULL;
    }
    $simpanPenjualan = mysqli_query($koneksi, "INSERT INTO data_penjualan (tanggal_jual, nama_barang, jumlah_jual, gambar) VALUES ('$tggl', '$nma', '$jml', '$gambarPath')");
    $id_penjualan = mysqli_insert_id($koneksi);
    $simpanMasuk = mysqli_query($koneksi, "INSERT INTO data_masuk (tanggal_masuk, jumlah_masuk, keterangan, gambar, id_penjualan) VALUES ('$tggl', '$jml', '$ket', '$gambarPath', '$id_penjualan')");
    
    if ($simpanPenjualan && $simpanMasuk) {
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
    <h1 class="page-title">Penjualan</h1>
    <div>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Penjualan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Data Menu Makanan Dan Minuman</h3>
    </div>
    <div class="card-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label class="form-control-label" for="tanggal_jual">Tanggal Penjualan</label>
          <input type="date" class="form-control" name="tanggal_jual" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label class="form-control-label" for="nama_barang">Nama Makanan/Minuman</label>
          <input type="text" class="form-control" name="nama_barang" autocomplete="off" placeholder="Masukkan Nama Barang" required>
        </div>
        <div class="form-group">
          <label class="form-control-label" for="jumlah_jual">Harga Jual(Rp)</label>
          <input type="text" class="form-control" name="jumlah_jual" autocomplete="off" placeholder="Input Jumlah Penjualan (Rp)" oninput="updateFormat()" id="format" required>
        </div>
         <div class="form-group">
          <label class="form-control-label" for="gambar">Gambar</label>
          <input type="file" class="form-control" name="gambar" accept="image/*" required>
        </div>
        <div class="form-group">
          <button type="submit" class='btn btn-primary btn-md' name="simpan">Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
<?php include 'src/footer.php'; ?>