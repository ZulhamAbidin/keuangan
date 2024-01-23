<?php
include 'src/header.php';

if (isset($_POST['simpan'])) {
    $tggl = date('Y-m-d', strtotime($_POST['tanggal_jual']));
    $nma = $_POST['nama_barang'];
    $jml = $_POST['jumlah_jual_numeric'];
    $id = $_GET['id_penjualan'];
    $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE id_penjualan = '$id'");
    $data = mysqli_fetch_array($query);

    if (!$data) {
        echo "ID Penjualan tidak ditemukan.";
        exit;
    }

    $gambarLama = $data['gambar'];
    $gambar = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $folder = 'gambar/data_penjualan/';
    if (!empty($gambar)) {
        $gambarPath = $folder . $gambar;
        if (move_uploaded_file($tmpName, $_SERVER['DOCUMENT_ROOT'] . '/program_uang/admin/' . $gambarPath)) {
        } else {
            echo "Gagal mengunggah gambar.";
            exit;
        }
    } else {
        $gambarPath = $gambarLama;
    }

    $updateDataPenjualan = mysqli_query($koneksi, "UPDATE data_penjualan SET tanggal_jual = '$tggl', nama_barang = '$nma', jumlah_jual = '$jml', gambar = '$gambarPath' WHERE id_penjualan = '$id'");
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

<script>
    function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join('.').split('').reverse().join('');
    return 'Rp.' + ribuan;
    }

    function updateFormat() {
    var jumlahJualInput = document.getElementById('format');
    var jumlahJualValue = jumlahJualInput.value.replace(/\D/g, '');
    jumlahJualInput.value = formatRupiah(jumlahJualValue);
    var numericInput = document.getElementById('jumlah_jual_numeric');
    numericInput.value = jumlahJualValue;
    }
</script>

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
                <input type="hidden" name="jumlah_jual_numeric" id="jumlah_jual_numeric" value="<?= $data['jumlah_jual'] ?>">
                <div class="form-group">
                    <label class="form-control-label" for="jumlah_jual">Harga Jual (Rp)</label>
                    <input type="text" class="form-control" name="jumlah_jual" autocomplete="off" value="<?= $data['jumlah_jual'] ?>" placeholder="Input Jumlah Penjualan (Rp)"  oninput="updateFormat()" id="format" required>
                </div>
                <div class="form-group">
                    <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'src/footer.php'; ?>