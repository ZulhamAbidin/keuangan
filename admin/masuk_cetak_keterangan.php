<?php
include '../koneksi.php';

$ket = $_POST['keterangan'];
$tanggal1 = date('Y-m-d', strtotime($_POST['tanggal1']));
$tanggal2 = date('Y-m-d', strtotime($_POST['tanggal2']));

$query = mysqli_query($koneksi, "SELECT * FROM data_masuk WHERE keterangan = '$ket' AND tanggal_masuk BETWEEN '$tanggal1' AND '$tanggal2'");
$data = [];

while ($lihat = mysqli_fetch_array($query)) {
    $data[] = $lihat;
}

$totalPemasukan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah_masuk) as jumlahMasuk FROM data_masuk WHERE keterangan = '$ket' AND tanggal_masuk BETWEEN '$tanggal1' AND '$tanggal2'"));
?>


<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords"	content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">
	<link rel="shortcut icon" type="image/x-icon" href="../sash/images/brand/favicon.ico" />
	<title>Cetak</title>
	<link id="style" href="../sash/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../sash/css/style.css" rel="stylesheet" />
	<link href="../sash/css/dark-style.css" rel="stylesheet" />
	<link href="../sash/css/transparent-style.css" rel="stylesheet">
	<link href="../sash/css/skin-modes.css" rel="stylesheet" />
	<link href="../sash/css/icons.css" rel="stylesheet" />
	<link id="theme" rel="stylesheet" type="text/css" media="all" href="../sash/colors/color1.css" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
  
	<script>
    $(document).ready(function () {
        $('#laporanTable').DataTable({
            "paging": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true
        });
    });
</script>

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
							<div class="col-lg-12 text-end">
								<p class="mb-0">Cetak Data Dengan Keterangan <?php echo isset($data[0]['keterangan']) ? $data[0]['keterangan'] : ''; ?></p>
								<p class="mb-0">Mulai Tanggal <?= date('d-m-Y', strtotime($_POST['tanggal1'])) ?></p>
								<p class="mb-0">Sampai dengan <?= date('d-m-Y', strtotime($_POST['tanggal2'])) ?></p>
							</div>
					</div>
					<div class="card-body">
						<?php include('header.php'); ?>
						<div class="table-responsive push">
							    <table id="laporanTable" class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Keterangan</th>
										<th>Tanggal</th>
										<th>Pemasukan</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1;
									$totalPemasukan = 0;

									foreach ($data as $item) {
										?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $item['keterangan']; ?></td>
											<td><?php echo date('d F Y', strtotime($item['tanggal_masuk'])); ?></td>
											<td><?php echo isset($item['jumlah_masuk']) ? 'Rp ' . number_format($item['jumlah_masuk'], 0, ',', '.') : ''; ?></td>
										</tr>
										<?php
										$totalPemasukan += isset($item['jumlah_masuk']) ? $item['jumlah_masuk'] : 0;
										$no++;
									}
									?>
									<tr>
										<td colspan="3">Total Pemasukan</td>
										<td><?php echo 'Rp ' . number_format($totalPemasukan, 0, ',', '.'); ?></td>
									</tr>

								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
	<script src="../sash/js/jquery.min.js"></script>
	<script src="../sash/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../sash/plugins/datatable/js/dataTables.bootstrap5.js"></script>
	<script src="../sash/plugins/datatable/js/dataTables.buttons.min.js"></script>
	<script src="../sash/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
	<script src="../sash/plugins/datatable/js/jszip.min.js"></script>
	<script src="../sash/plugins/datatable/pdfmake/pdfmake.min.js"></script>
	<script src="../sash/plugins/datatable/pdfmake/vfs_fonts.js"></script>
	<script src="../sash/plugins/datatable/js/buttons.html5.min.js"></script>
	<script src="../sash/plugins/datatable/js/buttons.print.min.js"></script>
	<script src="../sash/plugins/datatable/js/buttons.colVis.min.js"></script>
	<script src="../sash/plugins/datatable/dataTables.responsive.min.js"></script>
	<script src="../sash/plugins/datatable/responsive.bootstrap5.min.js"></script>
	<script src="../sash/js/table-data.js"></script>

	<script src="../sash/plugins/bootstrap/js/popper.min.js"></script>
	<script src="../sash/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="../sash/js/jquery.sparkline.min.js"></script>
	<script src="../sash/js/sticky.js"></script>
	<script src="../sash/plugins/peitychart/jquery.peity.min.js"></script>
	<script src="../sash/plugins/peitychart/peitychart.init.js"></script>
	<script src="../sash/plugins/p-scroll/perfect-scrollbar.js"></script>
	<script src="../sash/plugins/p-scroll/pscroll.js"></script>
	<script src="../sash/plugins/p-scroll/pscroll-1.js"></script>
	<script src="../sash/plugins/chart/Chart.bundle.js"></script>
	<script src="../sash/plugins/chart/rounded-barchart.js"></script>
	<script src="../sash/plugins/chart/utils.js"></script>
	<script src="../sash/plugins/select2/select2.full.min.js"></script>
	<script src="../sash/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../sash/plugins/datatable/js/dataTables.bootstrap5.js"></script>
	<script src="../sash/plugins/datatable/dataTables.responsive.min.js"></script>
	<script src="../sash/js/apexcharts.js"></script>
	<script src="../sash/plugins/apexchart/irregular-data-series.js"></script>
	<script src="../sash/plugins/flot/jquery.flot.js"></script>
	<script src="../sash/plugins/flot/jquery.flot.fillbetween.js"></script>
	<script src="../sash/plugins/flot/chart.flot.sampledata.js"></script>
	<script src="../sash/plugins/flot/dashboard.sampledata.js"></script>
	<script src="../sash/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="../sash/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../sash/plugins/sidemenu/sidemenu.js"></script>
	<script src="../sash/plugins/bootstrap5-typehead/autocomplete.js"></script>
	<script src="../sash/js/typehead.js"></script>
	<script src="../sash/js/index1.js"></script>
	<script src="../sash/js/themeColors.js"></script>
	<script src="../sash/js/custom.js"></script>
</body>

</html>


