<?php
include '../koneksi.php';

$delete = mysqli_query($koneksi, "DELETE FROM data_admin WHERE id_admin = '$_GET[id_admin]'");
echo "<script>alert('Data Berhasil Di Hapus');window.location='data_admin.php'</script>";

?>