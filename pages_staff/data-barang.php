<?php
include 'function.php';
$data_barang = show_data("SELECT * FROM barang");

// Tambah data
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

// Edit data
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $namaBarang = $_POST['namaBarang'];
    $kodeBarang = $_POST['kodeBarang'];
    $jenisBarang = $_POST['jenisBarang'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];

    $query = "UPDATE barang SET nama='$namaBarang', kode='$kodeBarang', jenis='$jenisBarang', ukuran='$ukuran', harga='$harga' WHERE id_barang=$id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href = '/?page=data-barang';</script>";
    } else {
        echo "<script>alert('Error: Data gagal diubah'); window.location.href = '/?page=data-barang';</script>";
    }
}

if (isset($_POST['hapus'])) {
    $id_barang = $_POST['id_barang'];

    $query = "DELETE FROM barang WHERE id_barang = $id_barang";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href = '/?page=data-barang';</script>";
    } else {
        echo "<script>alert('Error: Data gagal dihapus'); window.location.href = '/?page=data-barang';</script>";
    }
}

?>

<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>KELOLA DATA BARANG</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahEditBarang" onclick="resetForm()">
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
                                <?php $no = 1;
                                foreach ($data_barang as $value): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['kode'] ?></td>
                                        <td><?= $value['jenis'] ?></td>
                                        <td><?= $value['ukuran'] ?></td>
                                        <td><?= $value['harga'] ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle text-white" data-bs-toggle="dropdown">Aksi</button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="#" data-barang-detail='<?= json_encode($value) ?>' onclick="detailBarang(this)">
                                                            Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-warning" href="#" data-barang-edit='<?= json_encode($value) ?>' onclick="editBarang(this)">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" data-barang-hapus='<?= json_encode($value) ?>' onclick="hapusBarang(this)">Hapus</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="tambahEditBarang" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/?page=data-barang" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah/Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="barangId">
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
                    <button type="submit" name="tambah" id="submitButton" class="btn btn-primary w-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailBarangModal" tabindex="-1" aria-labelledby="detailBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama :</strong> <span id="detailNama"></span></li>
                    <li class="list-group-item"><strong>Kode :</strong> <span id="detailKode"></span></li>
                    <li class="list-group-item"><strong>Jenis :</strong> <span id="detailJenis"></span></li>
                    <li class="list-group-item"><strong>Ukuran :</strong> <span id="detailUkuran"></span></li>
                    <li class="list-group-item"><strong>Harga :</strong> <span id="detailHarga"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function detailBarang(el) {
        const data = JSON.parse(el.getAttribute('data-barang-detail'));

        document.getElementById('detailNama').textContent = data.nama;
        document.getElementById('detailKode').textContent = data.kode;
        document.getElementById('detailJenis').textContent = data.jenis;
        document.getElementById('detailUkuran').textContent = data.ukuran;
        document.getElementById('detailHarga').textContent = data.harga;

        const modal = new bootstrap.Modal(document.getElementById('detailBarangModal'));
        modal.show();
    }

    function editBarang(el) {
        const data = JSON.parse(el.getAttribute('data-barang-edit'));

        document.getElementById('barangId').value = data.id_barang;
        document.getElementById('namaBarang').value = data.nama;
        document.getElementById('kodeBarang').value = data.kode;
        document.getElementById('jenisBarang').value = data.jenis;
        document.getElementById('ukuran').value = data.ukuran;
        document.getElementById('harga').value = data.harga;

        document.getElementById('modalTitle').textContent = "Edit Barang";
        document.getElementById('submitButton').setAttribute('name', 'edit');

        const modal = new bootstrap.Modal(document.getElementById('tambahEditBarang'));
        modal.show();
    }

    function resetForm() {
        document.getElementById('barangId').value = '';
        document.getElementById('namaBarang').value = '';
        document.getElementById('kodeBarang').value = '';
        document.getElementById('jenisBarang').value = '';
        document.getElementById('ukuran').value = '';
        document.getElementById('harga').value = '';

        document.getElementById('modalTitle').textContent = "Tambah Barang";
        document.getElementById('submitButton').setAttribute('name', 'tambah');
    }

    function hapusBarang(el) {
        const data = JSON.parse(el.getAttribute('data-barang-hapus'));

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat form secara dinamis untuk submit POST hapus
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/?page=data-barang';

                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'id_barang';
                inputId.value = data.id_barang;
                form.appendChild(inputId);

                const inputHapus = document.createElement('input');
                inputHapus.type = 'hidden';
                inputHapus.name = 'hapus';
                inputHapus.value = '1';
                form.appendChild(inputHapus);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>