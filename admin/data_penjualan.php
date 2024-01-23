<?php include 'src/header.php'; ?>

<div class="container">

  <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="gambarModalLabel">Lihat Gambar</h5>
        </div>
        <div class="modal-body">
          <img id="gambarLihat" class="img-fluid" alt="Gambar">
        </div>
      </div>
    </div>
  </div>

  <div class="page-header">
    <h1 class="page-title">Data Penjualan</h1>
    <div>
      <ol class="breadcrumb">
        <a href="penjualan_tambah.php" class="btn btn-primary"><i class="fe fe-plus me-2"></i>Tambah Data Penjualan</a>
      </ol>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Penjualan</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal Jual</th>
              <th>Nama Makanan/minuman</th>
              <th>Harga (Rp)</th>
              <th>Gambar</th>
              <th>Action</th>
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
                <button class="btn btn-primary btn-md" onclick="tampilkanGambar('<?php echo $data['gambar']; ?>')">
                  <i class="fe fe-eye"></i> 
                </button>
              </td>
              <td>
                <a href="penjualan_edit.php?id_penjualan=<?php echo $data['id_penjualan']; ?>" class='btn btn-primary btn-sm'>
                  <span aria-hidden="true"></span>Edit
                </a>
                <a href="#" onclick="showDeleteAlertPenjualan('<?php echo $data['id_penjualan']; ?>')" class='btn btn-danger btn-sm'>
                  <span aria-hidden="true"></span>Hapus
                </a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
  $(document).ready(function () {
    $('#example1').DataTable();
  });

  function tampilkanGambar(lokasiGambar) {
    $('#gambarLihat').attr('src', lokasiGambar);
    $('#gambarModal').modal('show');
  }

  function showDeleteAlertPenjualan(id_penjualan) {
    Swal.fire({
      title: 'Konfirmasi',
      text: 'Anda yakin ingin menghapus data ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'penjualan_hapus.php?id_penjualan=' + id_penjualan,
          type: 'GET',
          success: function (response) {
            Swal.fire('Terhapus!', response, 'success').then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          },
          error: function (xhr, status, error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus item. Error: ' + error, 'error');
          }
        });
      } else {
        console.log('Penghapusan dibatalkan oleh pengguna');
      }
    });
  }
</script>

<?php include 'src/footer.php'; ?>
