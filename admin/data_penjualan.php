<?php include 'src/header.php'; ?>
<section class="content">

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
                  <th>Nama Makanan/minuman</th>
                  <th>Harga (Rp)</th>
                  <th><a href="penjualan_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true"></span>Tambah</button></a></th>
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
                  <td>
                    <a href="penjualan_edit.php?id_penjualan=<?php echo $data['id_penjualan']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span aria-hidden="true"></span>Edit</button></a>
                    <a href="penjualan_hapus.php?id_penjualan=<?php echo $data['id_penjualan']; ?>" onclick="return confirm('Apakah Anda Yakin Hapus Data?')"><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true"></span>Hapus</button></a>
                  </td>
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