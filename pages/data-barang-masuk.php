<?php
include 'function.php';
$data_barang_masuk = show_data("SELECT * FROM barang_masuk INNER JOIN barang ON barang_masuk.id_barang = barang.id_barang");
print_r($_POST);
die;
if(isset($_POST['tambah'])){
    echo 'aaa';
    exit;
}
?>

<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>KELOLA DATA BARANG MASUK</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahJalurModal">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="barangMasukTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_barang_masuk as $value) {
                                ?>
                                    <tr>
                                        <td><?= $no?></td>
                                        <td><?= $value['kode']?></td>
                                        <td><?= $value['jumlah']?></td>
                                        <td><?= $value['total_harga']?></td>
                                        <td><?= $value['tanggal']?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle text-white" data-bs-toggle="dropdown">Aksi</button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item text-primary" href="/admin/mahasiswa_baru/detail/${data}">Detail</a></li>
                                                    <li><a class="dropdown-item text-warning" href="/admin/mahasiswa_baru/edit/${data}">Edit</a></li>
                                                    <li><a class="dropdown-item text-danger" onclick="hapusMahasiswa('${data}')">Hapus</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DATA -->
<div class="modal fade" id="tambahJalurModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Jalur Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/?page=data-barang" method="post">
                    <div class="mb-3">
                        <label for="no" class="form-label">No</label>
                        <input type="text" class="form-control" id="no" required>
                    </div>
                    <div class="mb-3">
                        <label for="kodeBarang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kodeBarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalHarga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="totalHarga" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="text" class="form-control" id="tanggal" required>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>