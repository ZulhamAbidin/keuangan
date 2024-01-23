
<?php
include 'src/header.php';

$alertMessage = '';
$namaValue = ''; 
$usernameValue = '';

if(isset($_POST['simpan'])){
    $id = $_GET['id_admin'];
    $nama = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    if (strlen($_POST['password']) < 6) {
        $alertMessage = 'Password harus memiliki minimal 6 karakter';
    } else {
        $check_username = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE username='$username' AND id_admin != '$id'");
        if (mysqli_num_rows($check_username) > 0) {
            $alertMessage = 'Username sudah digunakan';
        } else {
            $update = mysqli_query($koneksi, "UPDATE data_admin SET nama_admin = '$nama', username = '$username', password = '$password' WHERE id_admin = '$id'");
            if ($update) {
                $alertMessage = 'Data Berhasil Diupdate';
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: "' . $alertMessage . '",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then(function() {
                            window.location.href = "data_admin.php";
                        });
                      </script>';
                exit;
            } else {
                $alertMessage = 'Gagal mengupdate data';
            }
        }
    }
    $namaValue = $nama;
    $usernameValue = $username;
}

?>

<div class="container">
  <div class="page-header">
        <h1 class="page-title">Edit Data Admin</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Pengaturan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
  
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Data Admin</h3>
        </div>
        <?php
        $id = $_GET['id_admin'];

        $query = mysqli_query($koneksi, "SELECT * FROM data_admin WHERE id_admin = '$id'");
        $data  = mysqli_fetch_array($query);
        ?>
        <div class="card-body">
            <form action="" method="POST">
                <?php
                if (!empty($alertMessage)) {
                    echo '<div class="alert alert-danger" role="alert">' . $alertMessage . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="nama_admin">Nama Admin</label>
                    <input type="text" class="form-control" name="nama_admin" value="<?= $data['nama_admin'] ?>"  autocomplete="off" placeholder="Input Nama Admin" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>" autocomplete="off" placeholder="Input Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" placeholder="Input Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class='btn btn-primary' name="simpan"><span aria-hidden="true"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'src/footer.php'; ?>
