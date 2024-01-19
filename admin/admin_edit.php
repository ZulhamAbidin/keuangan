<?php
include 'src/header.php';

if(isset($_POST['simpan'])){
  $nama  = $_POST['nama_admin'];
  $user  = $_POST['username'];
  $pass  = ($_POST['password']);

  $simpan = mysqli_query($koneksi, "UPDATE data_admin SET nama_admin = '$nama', username = '$user', password = '$pass' WHERE id_admin = '$_GET[id_admin]'");
  echo "<script>alert('Data Berhasil Di Simpan');window.location='data_admin.php'</script>";

}
?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Admin</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i></button>
          </div>
        </div>
        <?php
        $id = $_GET['id_admin'];

        $query = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE id_admin = '$id'");
        $data  = mysqli_fetch_array($query);
        ?>
        <div class="box-body">
          <form action="" method="POST">
            <div class="form-group">
              <label class="form-control-label" for="nama_admin">Nama Admin</label>
              <input type="text" class="form-control" name="nama_admin" autocomplete="off" value="<?= $data['nama_admin'] ?>" placeholder="Input Nama Admin" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= $data['username'] ?>" placeholder="Input Username" required>
            </div>
            <div class="form-group">
              <label class="form-control-label" for="password">Password</label>
              <input type="text" class="form-control" id="password" name="password" autocomplete="off" value="<?= $data['password'] ?>" placeholder="Input Password" required>
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