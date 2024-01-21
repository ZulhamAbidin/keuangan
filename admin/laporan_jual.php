<?php include 'src/header.php'; ?>

<div class="container">


  <div class="page-header">
    <h1 class="page-title">Cetak Laporan Penjualan</h1>
    <div>
      <ol class="breadcrumb">

      </ol>
    </div>
  </div>


    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Laporan Penjualan</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="penjualan_cetak.php" target="_blank()">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Dari Tanggal :</label>
                            <input type="date" name="tanggal1" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sampai Tanggal :</label>
                            <input type="date" name="tanggal2" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <button type="submit" name="cetak" id="cetak" class="btn btn-primary">Cetak</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header with-border">
            <h3 class="card-title">Data Penjualan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Jual</th>
                            <th>Nama Barang</th>
                            <th>Jumlah (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM data_penjualan");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td> <?= strftime('%e, %B, %Y', strtotime($data['tanggal_jual'])); ?></td>
                                <td><?= $data['nama_barang'] ?></td>
                                <td><?= "Rp. " . number_format($data['jumlah_jual']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="../sash/js/jquery.min.js"></script>


<?php include 'src/footer.php'; ?>