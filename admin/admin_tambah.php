<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_admin'];
  $user  = $_POST['username'];
  $pass  = ($_POST['password']);

  $simpan = mysqli_query($koneksi, "INSERT INTO data_admin VALUES('','$nama','$user','$pass')");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_admin.php'</script>";

}
?>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Admin</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form action="" method="POST">
            <div class="form-group">
              <label class="form-control-label" for="nama_admin">Nama Admin</label>
              <input type="text" class="form-control" name="nama_admin" autocomplete="off" placeholder="Input Nama Admin" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" autocomplete="off" placeholder="Input Username" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="password">Password</label>
              <input type="text" class="form-control" id="password" name="password" autocomplete="off" placeholder="Input Password" required>
            </div>
            <div class="form-group">
              <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Simpan</button>
            </div>
          </form>
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