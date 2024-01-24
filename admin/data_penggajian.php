<?php include 'src/header.php'; ?>

    <div class="page-header">
    <h1 class="page-title">Penggajian List</h1>
    <div>
        <ol class="breadcrumb">
        <a href="penggajian_tambah.php" class="btn btn-primary"><i class="fe fe-plus me-2"></i>Tambah Data Penggajian</a>
        </ol>
    </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" id="example1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>NIP</th>
                                    <th>Nama Karyawan</th>
                                    <th>Gaji</th>
                                    <th>Gambar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = mysqli_query($koneksi, "SELECT * FROM data_penggajian");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?php
                                            $tanggalGaji = $data['tanggal_gaji'];
                                            $timestamp = strtotime($tanggalGaji);
                                            $tanggalFormat = date('d, F, Y', $timestamp);
                                            echo $tanggalFormat;
                                            ?>
                                        </td>
                                        <td><?= $data['nip'] ?></td>
                                        <td><?= $data['nama_karyawan'] ?></td>
                                        <td><?= "Rp. " . number_format($data['banyak_gaji']) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImageModal('/keuangan/admin/<?= $data['gambar'] ?>')">
                                                <i class="fe fe-eye"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="penggajian_edit.php?id_penggajian=<?php echo $data['id_penggajian']; ?>" class="btn btn-sm btn-primary shadow-sm">
                                                <span aria-hidden="true"></span>Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger shadow-sm" onclick="showDeleteAlert('<?php echo $data['id_penggajian']; ?>')">
                                                <span aria-hidden="true"></span>Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteAlert(id_penggajian) {
        Swal.fire({
            title: 'Peringatan',
            
            text: 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'penggajian_hapus.php?id_penggajian=' + id_penggajian,
                    type: 'GET',
                    success: function(response) {
                        Swal.fire('Terhapus!', response, 'success').then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        Swal.fire('Error!', 'Terjadi kesalahan saat menghapus item.', 'error');
                    }
                });
                return false;
            } else {
                console.log('Penghapusan dibatalkan oleh pengguna');
            }
        });
    }
    </script>

    <script>
        function showImageModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            $('#imageModal').modal('show');
        }
    </script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="../sash/js/jquery.min.js"></script>
<?php include 'src/footer.php'; ?>