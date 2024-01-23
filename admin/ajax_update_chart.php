<?php
// Pastikan koneksi database sudah dilakukan di file lain, atau tambahkan di sini jika belum
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil tahun yang dikirimkan dari permintaan POST
    $selectedYear = $_POST["year"];

    // Panggil fungsi getDataByMonth untuk mendapatkan data baru berdasarkan tahun
    $dataMasukBulanan = getDataByMonth($koneksi, 'masuk', $selectedYear);
    $dataKeluarBulanan = getDataByMonth($koneksi, 'keluar', $selectedYear);
    $dataPenjualanBulanan = getDataByMonth($koneksi, 'penjualan', $selectedYear);
    $dataGajiBulanan = getDataByMonth($koneksi, 'penggajian', $selectedYear);

    // Buat array response dengan data baru
    $response = [
        'dataMasuk' => $dataMasukBulanan,
        'dataKeluar' => $dataKeluarBulanan,
        'dataPenjualan' => $dataPenjualanBulanan,
        'dataGaji' => $dataGajiBulanan,
    ];

    // Kembalikan response dalam format JSON
    echo json_encode($response);
} else {
    // Jika bukan permintaan POST, kembalikan response kosong
    echo json_encode([]);
}

function getDataByMonth($koneksi, $jenisData, $tahun) {
    $data = array();

    for ($i = 1; $i <= 12; $i++) {
        $query = null;

        if ($jenisData == 'keluar') { 
            $query = mysqli_query($koneksi, "SELECT sum(jumlah) as Jumlah FROM data_$jenisData WHERE year(tanggal_$jenisData) = '$tahun' AND month(tanggal_$jenisData) = '$i'");
        } elseif ($jenisData == 'masuk') {
            $query = mysqli_query($koneksi, "SELECT sum(jumlah_masuk) as Jumlah FROM data_$jenisData WHERE year(tanggal_$jenisData) = '$tahun' AND month(tanggal_$jenisData) = '$i'");
        } elseif ($jenisData == 'penjualan') {
            $query = mysqli_query($koneksi, "SELECT sum(jumlah_jual) as Jumlah FROM data_$jenisData WHERE year(tanggal_jual) = '$tahun' AND month(tanggal_jual) = '$i'");
        } elseif ($jenisData == 'penggajian') {
            $query = mysqli_query($koneksi, "SELECT sum(banyak_gaji) as Jumlah FROM data_$jenisData WHERE year(tanggal_gaji) = '$tahun' AND month(tanggal_gaji) = '$i'");
        }

        if ($query !== false) {
            $result = mysqli_fetch_array($query);
            $data[] = $result['Jumlah'] ? $result['Jumlah'] : 0;
        } else {
            die(mysqli_error($koneksi));
        }
    }

    return $data;
}
?>
