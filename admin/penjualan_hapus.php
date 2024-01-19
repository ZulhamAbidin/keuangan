<?php
include '../koneksi.php';

$delete1 = mysqli_query($koneksi, "DELETE FROM data_penjualan WHERE id_penjualan = '$_GET[id_penjualan]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_penjualan.php'</script>";

?>