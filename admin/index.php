<?php 
include 'src/header.php'; 


function formatRupiah($angka)
{
    $rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $rupiah;
}

// tanda1

// Ambil tahun terbaru untuk setiap tabel
$queryTahunGaji = mysqli_query($koneksi, "SELECT max(year(tanggal_gaji)) as MaxGaji FROM data_penggajian");
$dataTahunGaji  = mysqli_fetch_array($queryTahunGaji);

$queryTahunMasuk = mysqli_query($koneksi, "SELECT max(year(tanggal_masuk)) as MaxMasuk FROM data_masuk");
$dataTahunMasuk  = mysqli_fetch_array($queryTahunMasuk);

$queryTahunKeluar = mysqli_query($koneksi, "SELECT max(year(tanggal_keluar)) as MaxKeluar FROM data_keluar");
$dataTahunKeluar  = mysqli_fetch_array($queryTahunKeluar);

$queryTahunJual = mysqli_query($koneksi, "SELECT max(year(tanggal_jual)) as MaxJual FROM data_penjualan");
$dataTahunJual  = mysqli_fetch_array($queryTahunJual);

// tanda2

// Tentukan tahun terbaru
$tahunTerbaru = max($dataTahunGaji['MaxGaji'], $dataTahunMasuk['MaxMasuk'], $dataTahunKeluar['MaxKeluar'], $dataTahunJual['MaxJual']);


// tanda3

// Ambil data penggajian per bulan
$dataGajiBulanan = getDataByMonth($koneksi, 'penggajian', $tahunTerbaru);
// Ambil data penjualan per bulan
$dataPenjualanBulanan = getDataByMonth($koneksi, 'penjualan', $tahunTerbaru);
// Ambil data pengeluaran per bulan
$dataKeluarBulanan = getDataByMonth($koneksi, 'keluar', $tahunTerbaru);
// Ambil data pemasukan per bulan
$dataMasukBulanan = getDataByMonth($koneksi, 'masuk', $tahunTerbaru);

$totalPenjualanTahunan = array_sum($dataPenjualanBulanan);
$totalGajiTahunan = array_sum($dataGajiBulanan);
$totalKeluarTahunan = array_sum($dataKeluarBulanan);
$totalMasukTahunan = array_sum($dataMasukBulanan);

// tanda4

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
            die(mysqli_error($koneksi));  // Output the error
        }
    }

    return $data;
}

// tanda5

$dataPenjualanBulanan[] = $totalPenjualanTahunan;
$dataGajiBulanan[] = $totalGajiTahunan;
$dataKeluarBulanan[] = $totalKeluarTahunan;
$dataMasukBulanan[] = $totalMasukTahunan;

$totalKeluarTahunan = array_sum($dataKeluarBulanan);
$totalMasukTahunan = array_sum($dataMasukBulanan);
$totalPenjualanTahunan = array_sum($dataPenjualanBulanan);
$totalGajiTahunan = array_sum($dataGajiBulanan);

?>



<!-- Main content -->
<section class="content">

  <div class="row">


    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <?php
              $query = mysqli_query($koneksi, "SELECT sum(jumlah_jual) as JumlahJual FROM data_penjualan WHERE year(tanggal_jual) = '$dataTahunJual[MaxJual]'");
              $data  = mysqli_fetch_array($query);
              ?>
          <h4><?= "Rp. ".number_format($data['JumlahJual']) ?></h4>
          <p>/ TAHUN</p>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="data_penjualan.php" class="small-box-footer">PENJUALAN <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <?php
              $query = mysqli_query($koneksi, "SELECT sum(banyak_gaji) as JumlahGaji FROM data_penggajian WHERE year(tanggal_gaji) = '$dataTahunGaji[MaxGaji]'");
              $data  = mysqli_fetch_array($query);
              ?>
          <h4><?= "Rp. ".number_format($data['JumlahGaji']) ?></h4>
          <p>/ TAHUN</p>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="data_penggajian.php" class="small-box-footer">PENGGAJIAN <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <?php
              $query = mysqli_query($koneksi, "SELECT sum(jumlah_masuk) as JumlahMasuk FROM data_masuk WHERE year(tanggal_masuk) = '$dataTahunMasuk[MaxMasuk]'");
              $data  = mysqli_fetch_array($query);
              ?>
          <h4><?= "Rp. ".number_format($data['JumlahMasuk']) ?></h4>
          <p>/ TAHUN</p>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="data_masuk.php" class="small-box-footer">PEMASUKAN <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <?php
              $query = mysqli_query($koneksi, "SELECT sum(jumlah) as JumlahKeluar FROM data_keluar WHERE year(tanggal_keluar) = '$dataTahunKeluar[MaxKeluar]'");
              $data  = mysqli_fetch_array($query);
              ?>
          <h4><?= "Rp. ".number_format($data['JumlahKeluar']) ?></h4>
          <p>/ TAHUN</p>
        </div>
        <div class="icon">
          <i class="fa fa-money"></i>
        </div>
        <a href="data_keluar.php" class="small-box-footer">PENGELUARAN <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

 
<div class="col-lg-12 col-md-12">
    <section class="content">
        <div class="row">

            <!-- Chart container -->
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart2</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="chartBar2" class="h-275"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>  


<script>
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("chartBar2");
    var maxData = Math.max(...<?= json_encode(array_merge($dataMasukBulanan, $dataKeluarBulanan, $dataPenjualanBulanan, $dataGajiBulanan)) ?>);

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "Total"],
            datasets: [{
                label: "Pemasukan",
                data: <?= json_encode($dataMasukBulanan) ?>,
                borderColor: "#6c5ffc",
                borderWidth: "0",
                backgroundColor: "#6c5ffc"
            }, {
                label: "Pengeluaran",
                data: <?= json_encode($dataKeluarBulanan) ?>,
                borderColor: "#05c3fb",
                borderWidth: "0",
                backgroundColor: "#05c3fb"
            }, {
                label: "Penjualan",
                data: <?= json_encode($dataPenjualanBulanan) ?>,
                borderColor: "#34c38f",
                borderWidth: "0",
                backgroundColor: "#34c38f"
            }, {
                label: "Penggajian",
                data: <?= json_encode($dataGajiBulanan) ?>,
                borderColor: "#f76d57",
                borderWidth: "0",
                backgroundColor: "#f76d57"
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    // ... (xAxes configuration)
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontColor: "#9ba6b5",
                        callback: function (value, index, values) {
                            return formatRupiah(value);
                        }
                    },
                    // ... (yAxes configuration)
                }]
            },
            legend: {
                // ... (legend configuration)
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                        var value = formatRupiah(tooltipItem.yLabel); // Format Rupiah disini
                        return datasetLabel + ': ' + value;
                    }
                }
            }
        }
    });

    // Function to update chart based on selected year
    window.updateChart = function () {
        var selectedYear = document.getElementById("tahunDropdown").value;

        // Use AJAX to fetch new data based on selected year
        $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
                year: selectedYear
            },
            dataType: 'json',
            success: function (data) {
                // Update chart with new data
                myChart.data.datasets[0].data = data.dataMasuk;
                myChart.data.datasets[1].data = data.dataKeluar;
                myChart.data.datasets[2].data = data.dataPenjualan;
                myChart.data.datasets[3].data = data.dataGaji;
                myChart.update();
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });
    };

    // Function to format number to Rupiah
    function formatRupiah(angka) {
        var rupiah = "Rp " + number_format(angka, 0, ',', '.');
        return rupiah;
    }

    // Function to format number with comma as a thousand separator
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
});
</script>

  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Dashboard</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'src/footer.php'; ?>