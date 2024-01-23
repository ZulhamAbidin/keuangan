<?php
include '../koneksi.php';
$delete1 = mysqli_query($koneksi, "DELETE FROM data_masuk WHERE id_masuk = '$_GET[id_masuk]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_masuk.php'</script>";
?>