<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-12 text-end">
                            <p class="mb-0">Cetak Data</p>
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
                                        <th>Nama Barang</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    include '../koneksi.php';

                                    $tanggal1 = date('Y-m-d', strtotime($_POST['tanggal1']));
                                    $tanggal2 = date('Y-m-d', strtotime($_POST['tanggal2']));

                                    $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan WHERE tanggal_jual BETWEEN '$tanggal1' AND '$tanggal2'");
                                    while ($lihat = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $lihat['nama_barang']; ?></td>
                                            <td> <?= strftime('%e, %B, %Y', strtotime($lihat['tanggal_jual'])); ?></td>
                                            <td>Rp. <?= number_format($lihat['jumlah_jual']); ?></td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    $query_total = mysqli_query($koneksi, "SELECT SUM(jumlah_jual) as total_jumlah FROM data_penjualan WHERE tanggal_jual BETWEEN '$tanggal1' AND '$tanggal2'");
                                    $total_jumlah = mysqli_fetch_assoc($query_total)['total_jumlah'];
                                    ?>
                                    <tr>
                                        <td colspan="3">Total Pendapatan</td>
                                        <td>Rp. <?= number_format($total_jumlah) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../sash/js/jquery.min.js"></script>
    <script src="../sash/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../sash/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../sash/js/table-data.js"></script>
    <script src="../sash/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../sash/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Include other scripts as needed -->
</body>

</html>
