<?php include 'src/header.php'; ?>

<div class="container">
  <div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel"
    aria-hidden="true">
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
    <h1 class="page-title">Pemasukan List</h1>
    <div>
      <ol class="breadcrumb">
        <a href="masuk_tambah.php" class="btn btn-primary"><i class="fe fe-plus me-2"></i>Tambah Data Pemasukan</a>
      </ol>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Pemasukan</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th>Pemasukan</th>
              <th>Gambar</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM data_masuk");
            while ($data = mysqli_fetch_array($query)) {
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;" title="<?= $data['keterangan'] ?>">
                  <?= $data['keterangan'] ?>
              </td>
              <td>
                <?php
                  $tanggalGaji = $data['tanggal_masuk'];
                  $timestamp = strtotime($tanggalGaji);
                  $tanggalFormat = date('d, F, Y', $timestamp);
                  echo $tanggalFormat;
                  ?>
              </td>
              <td>
                <?= "Rp. " . number_format($data['jumlah_masuk']) ?>
              </td>
              <td>
                <button class="btn btn-primary" onclick="tampilkanGambar('<?php echo $data['gambar']; ?>')"><i
                    class="fe fe-eye"></i></button>
              </td>
              <td>
                <?php

                  $edit_url = '';
                  $edit_label = '';

                  if (!empty($data['id_penjualan'])) {
                      $id_penjualan = $data['id_penjualan'];
                      $edit_url = "penjualan_edit.php?id_penjualan=$id_penjualan";
                      $edit_label = "Edit";
                  } else {
                      $id_masuk = $data['id_masuk'];
                      $edit_url = "masuk_edit.php?id_masuk=$id_masuk";
                      $edit_label = "Edit";
                  }
                ?>
                <a href="<?= $edit_url; ?>" class='btn btn-primary btn-sm'>
                  <span aria-hidden="true"></span><?= $edit_label; ?>
                </a>
                <a href="#" class="btn btn-sm btn-danger shadow-sm"
                  onclick="showDeleteAlertMasuk('<?php echo $data['id_masuk']; ?>')">
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<script>
  function tampilkanGambar(lokasiGambar) {
    $('#gambarLihat').attr('src', lokasiGambar);
    $('#gambarModal').modal('show');
  }
</script>

<script>
  function showDeleteAlertMasuk(id_masuk) {
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
          url: 'masuk_hapus.php?id_masuk=' + id_masuk,
          type: 'GET',
          success: function (response) {
            Swal.fire('Terhapus!', response, 'success').then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          },
          error: function (error) {
            Swal.fire('Error!', 'Terjadi kesalahan saat menghapus item.', 'error');
          }
        });
      } else {
        console.log('Penghapusan dibatalkan oleh pengguna');
      }
    });
  }
</script>
<?php include 'src/footer.php'; ?>