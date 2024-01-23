<?php 
include 'src/header.php'; 


function formatRupiah($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}

$queryTahunGaji = mysqli_query($koneksi, "SELECT max(year(tanggal_gaji)) as MaxGaji FROM data_penggajian");
$dataTahunGaji  = mysqli_fetch_array($queryTahunGaji);

$queryTahunMasuk = mysqli_query($koneksi, "SELECT max(year(tanggal_masuk)) as MaxMasuk FROM data_masuk");
$dataTahunMasuk  = mysqli_fetch_array($queryTahunMasuk);

$queryTahunKeluar = mysqli_query($koneksi, "SELECT max(year(tanggal_keluar)) as MaxKeluar FROM data_keluar");
$dataTahunKeluar  = mysqli_fetch_array($queryTahunKeluar);

$queryTahunJual = mysqli_query($koneksi, "SELECT max(year(tanggal_jual)) as MaxJual FROM data_penjualan");
$dataTahunJual  = mysqli_fetch_array($queryTahunJual);

$tahunTerbaru = max($dataTahunGaji['MaxGaji'], $dataTahunMasuk['MaxMasuk'], $dataTahunKeluar['MaxKeluar'], $dataTahunJual['MaxJual']);

$dataGajiBulanan = getDataByMonth($koneksi, 'penggajian', $tahunTerbaru);
$dataPenjualanBulanan = getDataByMonth($koneksi, 'penjualan', $tahunTerbaru);
$dataKeluarBulanan = getDataByMonth($koneksi, 'keluar', $tahunTerbaru);
$dataMasukBulanan = getDataByMonth($koneksi, 'masuk', $tahunTerbaru);

$totalPenjualanTahunan = array_sum($dataPenjualanBulanan);
$totalGajiTahunan = array_sum($dataGajiBulanan);
$totalKeluarTahunan = array_sum($dataKeluarBulanan);
$totalMasukTahunan = array_sum($dataMasukBulanan);

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


$dataPenjualanBulanan[] = $totalPenjualanTahunan;
$dataGajiBulanan[] = $totalGajiTahunan;
$dataKeluarBulanan[] = $totalKeluarTahunan;
$dataMasukBulanan[] = $totalMasukTahunan;

$totalKeluarTahunan = array_sum($dataKeluarBulanan);
$totalMasukTahunan = array_sum($dataMasukBulanan);
$totalPenjualanTahunan = array_sum($dataPenjualanBulanan);
$totalGajiTahunan = array_sum($dataGajiBulanan);

?>

<div class="container">

    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="row">
        
        <div class="col-12">
            <div class="form-group">
                <label for="tahunDropdown">Pilih Tahun:</label>
                <select class="form-control" id="tahunDropdown" onchange="updateChart()">
                    <?php
                    $queryDistinctYears = mysqli_query($koneksi, "SELECT DISTINCT YEAR(tanggal) AS Year FROM (
                        SELECT tanggal_gaji AS tanggal FROM data_penggajian
                        UNION
                        SELECT tanggal_masuk AS tanggal FROM data_masuk
                        UNION
                        SELECT tanggal_keluar AS tanggal FROM data_keluar
                        UNION
                        SELECT tanggal_jual AS tanggal FROM data_penjualan
                    ) AS TahunDistinct ORDER BY Year DESC");

                    while ($dataDistinctYear = mysqli_fetch_array($queryDistinctYears)) {
                        $selected = ($dataDistinctYear['Year'] == $tahunTerbaru) ? 'selected' : '';
                        echo "<option value=\"" . $dataDistinctYear['Year'] . "\" $selected>" . $dataDistinctYear['Year'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
            <div class="row text-white">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden" style="background-color: #2B5F9B !important">
                        <div class="card-body">
                            <h6 class="">Pemasukan/Tahun</h6>
                            <h5 id="jumlahMasuk" class="mb-0 number-font">
                                <?= "Rp. " . formatRupiah($totalMasukTahunan) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden bg-danger" style="background-color: #f7b731 !important">
                        <div class="card-body">
                            <h6 class="">Pengeluaran/Tahun</h6>
                            <h5 id="jumlahKeluar" class="mb-0 number-font">
                                <?= "Rp. " . formatRupiah($totalKeluarTahunan) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden bg-info" style="background-color: #09ad95 !important">
                        <div class="card-body">
                            <h6 class="">Penjualan/Tahun</h6>
                            <h5 id="jumlahPenjualan" class="mb-0 number-font">
                                <?= "Rp. " . formatRupiah($totalPenjualanTahunan) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                    <div class="card overflow-hidden bg-success" style="background-color: #e82646 !important">
                        <div class="card-body">
                            <h6 class="">Penggajian/Tahun</h6>
                            <h5 id="jumlahGaji" class="mb-0 number-font"><?= "Rp. " . formatRupiah($totalGajiTahunan) ?>
                                </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Chart</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="chartBar2" class="h-275"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        function createChart(dataMasuk, dataKeluar, dataPenjualan, dataGaji) {
    var ctx = document.getElementById("chartBar2").getContext("2d");

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: "Pemasukan",
                data: dataMasuk,
                borderColor: "#2B5F9B",
                borderWidth: 0,
                backgroundColor: "#2B5F9B"
            }, {
                label: "Pengeluaran",
                data: dataKeluar,
                borderColor: "#f7b731",
                borderWidth: 0,
                backgroundColor: "#f7b731"
            }, {
                label: "Penjualan",
                data: dataPenjualan,
                borderColor: "#09ad95",
                borderWidth: 0,
                backgroundColor: "#09ad95"
            }, {
                label: "Penggajian",
                data: dataGaji,
                borderColor: "#e82646",
                borderWidth: 0,
                backgroundColor: "#e82646"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{}],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#9ba6b5",
                        callback: function (value, index, values) {
                            return formatRupiah(value);
                        }
                    },
                }]
            },
            legend: {},
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        var value = formatRupiah(tooltipItem.yLabel);
                        return datasetLabel + ': ' + value;
                    }
                }
            }
        }
    });

    return myChart;
}
        function formatRupiah(angka) {
            var rupiah = "Rp " + number_format(angka, 0, ',', '.');
            return rupiah;
        }

        function updateChart(selectedYear) {
    $.ajax({
        type: "POST",
        url: "ajax_update_chart.php",
        data: { year: selectedYear },
        success: function (response) {
            var data = JSON.parse(response);
            myChart.data.labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            myChart.data.datasets[0].data = data.dataMasuk;
            myChart.data.datasets[1].data = data.dataKeluar;
            myChart.data.datasets[2].data = data.dataPenjualan;
            myChart.data.datasets[3].data = data.dataGaji;
            myChart.update();
            $("#jumlahMasuk").text("Rp. " + formatRupiah(data.totalMasukTahunan));
            $("#jumlahKeluar").text("Rp. " + formatRupiah(data.totalKeluarTahunan));
            $("#jumlahPenjualan").text("Rp. " + formatRupiah(data.totalPenjualanTahunan));
            $("#jumlahGaji").text("Rp. " + formatRupiah(data.totalGajiTahunan));
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

        $("#tahunDropdown").on("change", function () {
            var selectedYear = $(this).val();
            updateChart(selectedYear);
        });

        myChart = createChart(
            <?= json_encode($dataMasukBulanan) ?>,
            <?= json_encode($dataKeluarBulanan) ?>,
            <?= json_encode($dataPenjualanBulanan) ?>,
            <?= json_encode($dataGajiBulanan) ?>
        );
    });

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>


<?php include 'src/footer.php'; ?>