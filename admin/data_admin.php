<?php include 'src/header.php'; ?>
<section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Admin</h3>
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
                  <th>Nama Admin</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th><a href="admin_tambah.php"><button type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span aria-hidden="true"></span>Tambah</button></a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($koneksi, "SELECT * FROM data_admin");
                  while($data = mysqli_fetch_array($query)){
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data['nama_admin'] ?></td>
                  <td><?= $data['username'] ?></td>
                  <td><?= $data['password'] ?></td>
                  <td>
                    <a href="admin_edit.php?id_admin=<?php echo $data['id_admin']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span aria-hidden="true"></span>Edit</button></a>
                    <a href="admin_hapus.php?id_admin=<?php echo $data['id_admin']; ?>"><button type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm'><span aria-hidden="true"></span>Hapus</button></a>
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