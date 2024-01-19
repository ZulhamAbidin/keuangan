<?php include 'src/header.php'; ?>
<section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Penjualan</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
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
        <!-- /.box-body -->
        <div class="box-footer">
        
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Penjualan</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
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
                  while($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data['tanggal_jual'] ?></td>
                  <td><?= $data['nama_barang'] ?></td>
                  <td><?= "Rp. ".number_format($data['jumlah_jual']) ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
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