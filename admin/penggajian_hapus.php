<?php
include '../koneksi.php';
$delete1 = mysqli_query($koneksi, "DELETE FROM data_penggajian WHERE id_penggajian = '$_GET[id_penggajian]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_penggajian.php'</script>";
?>