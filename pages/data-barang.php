<?php
include 'function.php';
$data_barang = show_data("SELECT * FROM barang");

if (isset($_POST['tambah'])) {
    $namaBarang = $_POST['namaBarang'];
    $kodeBarang = $_POST['kodeBarang'];
    $jenisBarang = $_POST['jenisBarang'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $query = "INSERT INTO barang (nama, kode, jenis, ukuran, harga) VALUES ('$namaBarang', '$kodeBarang', '$jenisBarang', '$ukuran', '$harga')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href = '/?page=data-barang';</script>";
    } else {
        echo "<script>alert('Error: Data gagal ditambahkan'); window.location.href = '/?page=data-barang';</script>";
    }
}
?>

<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>KELOLA DATA BARANG</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarang">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableBarang" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_barang as $value) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['kode'] ?></td>
                                        <td><?= $value['jenis'] ?></td>
                                        <td><?= $value['ukuran'] ?></td>
                                        <td><?= $value['harga'] ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle text-white" data-bs-toggle="dropdown">Aksi</button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item text-primary" onclick="detailBarang(<?= json_encode($value) ?>)">Detail</a></li>
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

<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/?page=data-barang" method="post">
                    <div class="mb-3">
                        <label for="no" class="form-label">No</label>
                        <input type="text" class="form-control" name="no" id="no" required>
                    </div>
                    <div class="mb-3">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="namaBarang" id="namaBarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="kodeBarang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="kodeBarang" id="kodeBarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenisBarang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenisBarang" id="jenisBarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="ukuran" class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" id="ukuran" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" required>
                    </div>
                    <button type="submit" name="tambah" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function detailBarang(id) {
        $('#tambahBarang').modal('show');
    }
</script>