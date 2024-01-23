<?php
include '../koneksi.php';
$delete1 = mysqli_query($koneksi, "DELETE FROM data_keluar WHERE id_keluar = '$_GET[id_keluar]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_keluar.php'</script>";

?>