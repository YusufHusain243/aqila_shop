<?php
include 'function.php';
$data_barang_keluar = show_data("SELECT 
                                    barang_keluar.*, 
                                    barang.kode, 
                                    barang.nama, 
                                    barang.jenis, 
                                    barang.ukuran, 
                                    barang.harga, 
                                    pengguna.nama as nama_pengguna
                                FROM 
                                    barang_keluar 
                                INNER JOIN barang ON barang_keluar.id_barang = barang.id_barang
                                INNER JOIN pengguna ON barang_keluar.id_pengguna = pengguna.id_pengguna
                            ");

$listBarang = show_data("SELECT * FROM barang");

// Tambah data
if (isset($_POST['tambah'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $total_harga = preg_replace('/[^\d]/', '', $_POST['total_harga']);
    $tanggal = $_POST['tanggal'];
    $id_pengguna = $_SESSION['id_pengguna'] ?? '1';

    $sisa_barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) AS jumlah FROM barang_masuk WHERE id_barang = '$id_barang'"))['jumlah'];

    if ($sisa_barang >= $jumlah) {
        $query = "INSERT INTO barang_keluar (id_barang, id_pengguna, total_harga, jumlah, tanggal) 
              VALUES ('$id_barang', '$id_pengguna', '$total_harga', '$jumlah', '$tanggal')";
              
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = '/?page=data-barang-keluar';</script>";
        } else {
            echo "<script>alert('Error: Data gagal ditambahkan'); window.location.href = '/?page=data-barang-keluar';</script>";
        }
    } else {
        echo "<script>alert('Error: Stok barang tidak cukup'); window.location.href = '/?page=data-barang-keluar';</script>";
        exit;
    }
}

// Edit data barang keluar
if (isset($_POST['edit'])) {
    $id_barang_keluar = $_POST['id_barang_keluar'];
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $total_harga = preg_replace('/[^\d]/', '', $_POST['total_harga']);
    $tanggal = $_POST['tanggal'];

    $query = "UPDATE barang_keluar SET 
                id_barang = '$id_barang', 
                jumlah = '$jumlah', 
                total_harga = '$total_harga', 
                tanggal = '$tanggal' 
              WHERE id_barang_keluar = '$id_barang_keluar'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href = '/?page=data-barang-keluar';</script>";
    } else {
        echo "<script>alert('Error: Data gagal diubah'); window.location.href = '/?page=data-barang-keluar';</script>";
    }
}


// Hapus data
if (isset($_POST['hapus']) && isset($_POST['id_barang_keluar'])) {
    $id_barang_keluar = $_POST['id_barang_keluar'];
    $query = "DELETE FROM barang_keluar WHERE id_barang_keluar = '$id_barang_keluar'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href = '/?page=data-barang-keluar';</script>";
    } else {
        echo "<script>alert('Error: Data gagal dihapus'); window.location.href = '/?page=data-barang-keluar';</script>";
    }
}
?>

<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>KELOLA DATA BARANG KELUAR</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahEditBarangKeluar">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="barangKeluarTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_barang_keluar as $value) {
                                ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= htmlspecialchars($value['kode']) ?></td>
                                        <td><?= htmlspecialchars($value['nama']) ?></td>
                                        <td><?= $value['jumlah'] ?></td>
                                        <td><?= $value['total_harga'] ?></td>
                                        <td><?= $value['tanggal'] ?></td>
                                        <td><?= htmlspecialchars($value['nama_pengguna']) ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle text-white" data-bs-toggle="dropdown">Aksi</button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-primary" href="#" data-barang-keluar-detail='<?= json_encode($value) ?>' onclick="detailBarangKeluar(this)">
                                                            Detail
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-warning" href="#" data-barang-keluar-edit='<?= json_encode($value) ?>' onclick="editBarangKeluar(this)">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" data-barang-keluar-hapus='<?= json_encode($value) ?>' onclick="hapusBarangKeluar(this)">Hapus</a>
                                                    </li>
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
<div class="modal fade" id="tambahEditBarangKeluar" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah/Edit Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/?page=data-barang-keluar" method="post" id="formBarangKeluar">
                    <input type="hidden" id="id_barang_keluar" name="id_barang_keluar" value="">

                    <div class="mb-3">
                        <label for="id_barang" class="form-label">Barang</label>
                        <div class="dropdown">
                            <button class="form-control text-start dropdown-toggle" type="button" id="dropdownBarang"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Barang
                            </button>
                            <ul class="dropdown-menu w-100" id="listBarangDropdown" aria-labelledby="dropdownBarang">
                                <li>
                                    <input type="text" class="form-control" id="searchBarang"
                                        placeholder="Cari barang..."
                                        onkeyup="filterDropdown('searchBarang', 'listBarangDropdown')">
                                </li>
                                <?php foreach ($listBarang as $barang): ?>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            onclick="selectOption('dropdownBarang', '<?= htmlspecialchars($barang['id_barang']) ?>', '<?= htmlspecialchars($barang['nama']) ?>', <?= htmlspecialchars($barang['harga']) ?>)">
                                            <?= htmlspecialchars($barang['nama']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <input type="hidden" id="id_barang" name="id_barang" required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" min="1" class="form-control" id="jumlah" name="jumlah" oninput="inputJumlah()" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalHarga" class="form-label">Total Harga</label>
                        <input type="text" class="form-control" id="totalHarga" name="total_harga" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <button type="submit" name="tambah" id="submitButton" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="detailBarangModal" tabindex="-1" aria-labelledby="detailBarangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Barang :</strong> <span id="detailNama"></span></li>
                    <li class="list-group-item"><strong>Kode Barang :</strong> <span id="detailKode"></span></li>
                    <li class="list-group-item"><strong>Jenis :</strong> <span id="detailJenis"></span></li>
                    <li class="list-group-item"><strong>Ukuran :</strong> <span id="detailUkuran"></span></li>
                    <li class="list-group-item"><strong>Harga Satuan :</strong> <span id="detailHarga"></span></li>
                    <li class="list-group-item"><strong>Jumlah Barang Keluar :</strong> <span id="detailJumlah"></span></li>
                    <li class="list-group-item"><strong>Total Harga :</strong> <span id="detailTotalHarga"></span></li>
                    <li class="list-group-item"><strong>Tanggal :</strong> <span id="detailTanggal"></span></li>
                    <li class="list-group-item"><strong>Dibuat Oleh :</strong> <span id="detailPengguna"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    let hargaTerpilih = 0;

    function filterDropdown(inputId, listId) {
        let input = document.getElementById(inputId);
        let filter = input.value.toUpperCase();
        let ul = document.getElementById(listId);
        let li = ul.getElementsByTagName("li");

        for (let i = 1; i < li.length; i++) { // indeks ke-0 adalah input
            let a = li[i].getElementsByTagName("a")[0];
            if (a) {
                let txtValue = a.textContent || a.innerText;
                li[i].style.display = txtValue.toUpperCase().includes(filter) ? "" : "none";
            }
        }
    }

    function selectOption(dropdownId, value, text, harga) {
        document.getElementById(dropdownId).textContent = text;
        document.getElementById('id_barang').value = value;
        hargaTerpilih = parseFloat(harga);
        // Reset jumlah ke 1 dan hitung total harga
        const jumlahInput = document.getElementById('jumlah');
        jumlahInput.value = 1;
        hitungTotalHarga();
    }

    function hitungTotalHarga() {
        const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
        const total = hargaTerpilih * jumlah;
        document.getElementById('totalHarga').value = total.toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
    }

    function inputJumlah() {
        hitungTotalHarga();
    }

    function detailBarangKeluar(el) {
        const data = JSON.parse(el.getAttribute('data-barang-keluar-detail'));
        document.getElementById('detailNama').textContent = data.nama;
        document.getElementById('detailKode').textContent = data.kode;
        document.getElementById('detailJenis').textContent = data.jenis;
        document.getElementById('detailUkuran').textContent = data.ukuran;
        document.getElementById('detailHarga').textContent = Number(data.harga).toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        document.getElementById('detailJumlah').textContent = data.jumlah;
        document.getElementById('detailTotalHarga').textContent = Number(data.total_harga).toLocaleString('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        document.getElementById('detailTanggal').textContent = data.tanggal;
        document.getElementById('detailPengguna').textContent = data.nama_pengguna;

        const modal = new bootstrap.Modal(document.getElementById('detailBarangModal'));
        modal.show();
    }

    function resetFormBarangKeluar() {
        document.getElementById('formBarangKeluar').reset();
        document.getElementById('id_barang_keluar').value = '';
        document.getElementById('id_barang').value = '';
        document.getElementById('dropdownBarang').textContent = 'Pilih Barang';
        hargaTerpilih = 0;
        document.getElementById('totalHarga').value = '';
        document.getElementById('submitButton').setAttribute('name', 'tambah');
        document.getElementById('modalTitle').textContent = 'Tambah Barang Keluar';
    }

    // Fungsi untuk edit barang keluar
    function editBarangKeluar(el) {
        const data = JSON.parse(el.getAttribute('data-barang-keluar-edit'));

        document.getElementById('id_barang_keluar').value = data.id_barang_keluar;
        document.getElementById('id_barang').value = data.id_barang;
        document.getElementById('dropdownBarang').textContent = data.nama;
        hargaTerpilih = parseFloat(data.harga);
        document.getElementById('jumlah').value = data.jumlah;
        hitungTotalHarga();
        document.getElementById('tanggal').value = data.tanggal;

        document.getElementById('modalTitle').textContent = "Edit Barang Keluar";
        document.getElementById('submitButton').setAttribute('name', 'edit');

        const modal = new bootstrap.Modal(document.getElementById('tambahEditBarangKeluar'));
        modal.show();
    }

    // Reset form saat modal ditutup (optional)
    const modalElement = document.getElementById('tambahEditBarangKeluar');
    modalElement.addEventListener('hidden.bs.modal', resetFormBarangKeluar);

    function hapusBarangKeluar(el) {
        const data = JSON.parse(el.getAttribute('data-barang-keluar-hapus'));

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
                form.action = '/?page=data-barang-keluar';

                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'id_barang_keluar';
                inputId.value = data.id_barang_keluar;
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