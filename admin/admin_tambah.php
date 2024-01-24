<?php
include 'src/header.php';

$alertMessage = '';
$namaValue = ''; 
$usernameValue = '';
$insert_stmt = null; // Inisialisasi variabel untuk menghindari undefined variable notice

if (isset($_POST['simpan'])) {
    $namaValue = $_POST['nama_admin'];
    $usernameValue = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 6) {
        $alertMessage = 'Password harus memiliki minimal 6 karakter';
    } else {
        // Gunakan prepared statement untuk mencegah SQL injection
        $check_username_stmt = mysqli_prepare($koneksi, "SELECT * FROM data_admin WHERE username=?");
        mysqli_stmt_bind_param($check_username_stmt, "s", $usernameValue);
        mysqli_stmt_execute($check_username_stmt);
        mysqli_stmt_store_result($check_username_stmt);

        // Periksa apakah username sudah digunakan
        if (mysqli_stmt_num_rows($check_username_stmt) > 0) {
            $alertMessage = 'Gagal menyimpan data. Username sudah digunakan.';
        } else {
            // Gunakan prepared statement untuk mencegah SQL injection
            $insert_stmt = mysqli_prepare($koneksi, "INSERT INTO data_admin (nama_admin, username, password) VALUES (?, ?, ?)");
            
            // Periksa apakah prepared statement berhasil dibuat
            if ($insert_stmt) {
                $hashed_password = md5($password);
                mysqli_stmt_bind_param($insert_stmt, "sss", $namaValue, $usernameValue, $hashed_password);
                $simpan = mysqli_stmt_execute($insert_stmt);

                // Periksa apakah penyimpanan data berhasil
                if ($simpan) {
                    $alertMessage = 'Data Berhasil Disimpan';

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
                    $alertMessage = 'Gagal menyimpan data';
                }
            } else {
                $alertMessage = 'Gagal membuat prepared statement untuk penyimpanan data';
            }
        }

        // Tutup prepared statements
        mysqli_stmt_close($check_username_stmt);
        
        // Hanya tutup $insert_stmt jika sudah didefinisikan
        if ($insert_stmt) {
            mysqli_stmt_close($insert_stmt);
        }
    }
}
?>



<div class="container">
    <div class="page-header">
        <h1 class="page-title">Tambah Data Admin</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Admin</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <?php
                if (!empty($alertMessage)) {
                    echo '<div class="alert alert-danger" role="alert">' . $alertMessage . '</div>';
                }
                ?>
                <div class="form-group">
                    <label for="nama_admin">Nama Admin</label>
                    <input type="text" class="form-control" name="nama_admin" value="<?= $namaValue ?>" autocomplete="off"
                        placeholder="Input Nama Admin" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $usernameValue ?>"
                        autocomplete="off" placeholder="Input Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off"
                        placeholder="Input Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class='btn btn-md btn-primary' name="simpan"><span aria-hidden="true"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'src/footer.php'; ?>