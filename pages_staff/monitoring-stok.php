<?php
include 'function.php';

if (isset($_POST['kode_barang'])) {
    // Ini bagian AJAX
    $kode = $_POST['kode_barang'];

    $query = "
        SELECT
            barang.*,
            (COUNT(barang_masuk.id_barang_masuk) - COUNT(barang_keluar.id_barang_keluar)) AS stok
        FROM
            barang
            LEFT JOIN barang_masuk ON barang_masuk.id_barang = barang.id_barang
            LEFT JOIN barang_keluar ON barang_keluar.id_barang = barang.id_barang
        WHERE
            barang.kode LIKE '%$kode%'
        GROUP BY
            barang.id_barang
    ";

    $data = show_data($query);
    echo json_encode($data);
    // exit; // Hentikan eksekusi setelah kirim data AJAX
}
?>

<!-- HTML DAN JAVASCRIPT -->
<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>MONITORING STOK</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" id="kode_barang" class="form-control" placeholder="Masukkan Kode Barang">
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="btn-cari" class="btn btn-primary w-100">Cari</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Ukuran</th>
                                    <th>Sisa Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- AJAX content loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn-cari').click(function() {
            var kode = $('#kode_barang').val();
            $.ajax({
                url: '', // Arahkan ke file yang sama
                method: 'POST',
                data: {
                    kode_barang: kode
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    let tbody = '';
                    if (response.length > 0) {
                        response.forEach((item, index) => {
                            tbody += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.kode}</td>
                                    <td>${item.nama}</td>
                                    <td>${item.jenis}</td>
                                    <td>${item.ukuran}</td>
                                    <td>${item.stok}</td>
                                    <td><button class="btn btn-sm btn-info">Detail</button></td>
                                </tr>
                            `;
                        });
                    } else {
                        tbody = `<tr><td colspan="7" class="text-center">Data tidak ditemukan</td></tr>`;
                    }
                    $('table tbody').html(tbody);
                },
                error: function() {
                    alert('Terjadi kesalahan saat mencari data.');
                }
            });
        });
    });
</script>