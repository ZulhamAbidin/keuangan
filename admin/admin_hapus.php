<?php
include '../koneksi.php';

// Ambil id_admin dari data POST
$id_admin = $_POST['id_admin'];

$delete = mysqli_query($koneksi, "DELETE FROM data_admin WHERE id_admin = '$id_admin'");

if ($delete) {
    // Jika penghapusan berhasil
    $response = array(
        'status' => 'success',
        'message' => 'Data berhasil dihapus!'
    );
} else {
    // Jika terjadi kesalahan
    $response = array(
        'status' => 'error',
        'message' => 'Gagal menghapus data. Silakan coba lagi.'
    );
}

echo json_encode($response);
exit();
?>
