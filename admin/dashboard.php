<?php include 'src/header.php'; ?>

<div class="container mt-10">
    <div class="card">
        <div class="card-body">
            <form id="tahunForm">
                Pilih Tahun:
                <select id="tahun" name="tahun">
                    <option value="2024">2024</option>
                    <option value="1997">1997</option>
                </select>
                <button type="button" class="form-control" onclick="getDashboardData()">Tampilkan</button>
            </form>
            <div id="hasilDashboard">
                <!-- Tempat untuk menampilkan data -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function getDashboardData() {
        var tahun = $('#tahun').val();

        if (!tahun) {
            alert('Pilih tahun terlebih dahulu.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'dashboard-action.php',
            data: { tahun: tahun },
            dataType: 'json',
            success: function(data) {
                var hasilDashboard = '';
                $.each(data, function(bulan, info) {
                    var jumlahTotal = info.total;
                    hasilDashboard += `<div>${bulan}: ${jumlahTotal}</div>`;

                    $.each(info.gambar_list, function(index, gambar) {
                        hasilDashboard += `<div>Gambar: <img src="${gambar}" alt="gambar"></div>`;
                        hasilDashboard += `<div>Keterangan: ${info.keterangan_list[index]}</div>`;
                    });
                });
                $('#hasilDashboard').html(hasilDashboard);
            },
            error: function(xhr, status, error) {
                console.error('Error: ' + error);
                console.log('XHR:', xhr.responseText);
                $('#hasilDashboard').html('Error! Cek konsol untuk detail.');
            }
        });
    }
</script>

<?php include 'src/footer.php'; ?>
