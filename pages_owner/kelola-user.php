<?php
include 'function.php';
$data_pengguna = show_data("SELECT * FROM pengguna");

// Tambah data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = 'staff'; 

    $query = "INSERT INTO pengguna (nama, username, password, role) VALUES ('$nama', '$username', '$password', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href = '/?page=kelola-user';</script>";
    } else {
        echo "<script>alert('Error: Data gagal ditambahkan'); window.location.href = '/?page=kelola-user';</script>";
    }
}

// Edit data
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "UPDATE pengguna SET nama='$nama', username='$username', password='$password' WHERE id_pengguna=$id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil diubah'); window.location.href = '/?page=kelola-user';</script>";
    } else {
        echo "<script>alert('Error: Data gagal diubah'); window.location.href = '/?page=kelola-user';</script>";
    }
}

if (isset($_POST['hapus'])) {      
    $id_pengguna = $_POST['id_pengguna'];

    $query = "DELETE FROM pengguna WHERE id_pengguna = $id_pengguna";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href = '/?page=kelola-user';</script>";
    } else {
        echo "<script>alert('Error: Data gagal dihapus'); window.location.href = '/?page=kelola-user';</script>";
    }
}

?>

<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>KELOLA DATA USER</h5>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahEditUser" onclick="resetForm()">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableUser" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_pengguna as $value): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['nama'] ?></td>
                                        <td><?= $value['username'] ?></td>
                                        <td><?= $value['password'] ?></td>
                                        <td><?= $value['role'] ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle text-white" data-bs-toggle="dropdown">Aksi</button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item text-warning" href="#" data-user-edit='<?= json_encode($value) ?>' onclick="editUser(this)">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#" data-user-hapus='<?= json_encode($value) ?>' onclick="hapusUser(this)">Hapus</a>
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
<div class="modal fade" id="tambahEditUser" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/?page=kelola-user" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah/Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="userId">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" name="tambah" id="submitButton" class="btn btn-primary w-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editUser(el) {
        const data = JSON.parse(el.getAttribute('data-user-edit'));

        document.getElementById('userId').value = data.id_pengguna;
        document.getElementById('nama').value = data.nama;
        document.getElementById('username').value = data.username;
        document.getElementById('password').value = data.password;

        document.getElementById('modalTitle').textContent = "Edit User";
        document.getElementById('submitButton').setAttribute('name', 'edit');

        const modal = new bootstrap.Modal(document.getElementById('tambahEditUser'));
        modal.show();
    }

    function resetForm() {
        document.getElementById('userId').value = '';
        document.getElementById('nama').value = '';
        document.getElementById('username').value = '';
        document.getElementById('password').value = '';

        document.getElementById('modalTitle').textContent = "Tambah User";
        document.getElementById('submitButton').setAttribute('name', 'tambah');
    }

    function hapusUser(el) {
        const data = JSON.parse(el.getAttribute('data-user-hapus'));

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
                form.action = '/?page=kelola-user';

                const inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'id_pengguna';
                inputId.value = data.id_pengguna;
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