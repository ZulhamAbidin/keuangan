<?php
if(isset($_POST['login'])){
    session_start();
    include 'koneksi.php';
    $user = $_POST['username'];
    $pass = md5($_POST['password']); // Gunakan md5 untuk menghash kata sandi

    $login = mysqli_query($koneksi,"SELECT * FROM data_admin where username = '$user' and password = '$pass'");
    $cek = mysqli_num_rows($login);

    if($cek > 0){
        $data = mysqli_fetch_assoc($login);
        $_SESSION['login']   = "Login";
        $_SESSION['id']      = $data['id_admin'];
        $_SESSION['nama']    = $data['nama_admin'];
        echo "<script>alert('Login Berhasil! Selamat Datang');window.location='admin/index.php'</script>";   
    }else{
        echo "<script>alert('Login Gagal! Username dan Password Tidak Ditemukan');window.location='index.php'</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PENGELOLAAN KEUANGAN</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html">LOGIN</a><b>AREA</b>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">PENGELOLAAN KEUANGAN</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="username" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" name="login" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>

  </div>
</div>

<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/plugins/iCheck/icheck.min.js"></script>
</body>
</html>
