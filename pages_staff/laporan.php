<?php
include 'function.php';

if (isset($_POST['start_date'], $_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Sanitasi jika show_data tidak aman
    $start_date = mysqli_real_escape_string($conn, $start_date); // asumsi $conn adalah koneksi
    $end_date = mysqli_real_escape_string($conn, $end_date);

    $query = "
        SELECT
            barang.*,
            COALESCE(SUM(barang_masuk.jumlah), 0) AS total_masuk,
            COALESCE(SUM(barang_keluar.jumlah), 0) AS total_keluar,
            (
                COALESCE(SUM(barang_masuk.jumlah), 0) - COALESCE(SUM(barang_keluar.jumlah), 0)
            ) AS stok
        FROM
            barang
            LEFT JOIN barang_masuk ON barang_masuk.id_barang = barang.id_barang
            LEFT JOIN barang_keluar ON barang_keluar.id_barang = barang.id_barang
        WHERE
            (barang_masuk.tanggal BETWEEN '$start_date' AND '$end_date'
            OR barang_keluar.tanggal BETWEEN '$start_date' AND '$end_date')
        GROUP BY
            barang.id_barang
    ";

    $data_barang = show_data($query);
}
?>


<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>LAPORAN</h5>
                </div>
                <div class="card-body">

                    <form class="mb-4" action="/?page=laporan" method="post">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="startDate" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="startDate" name="start_date" class="form-control" required
                                    value="<?= isset($_POST['start_date']) ? htmlspecialchars($_POST['start_date']) : '' ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="endDate" class="form-label">Tanggal Selesai</label>
                                <input type="date" id="endDate" name="end_date" class="form-control" required
                                    value="<?= isset($_POST['end_date']) ? htmlspecialchars($_POST['end_date']) : '' ?>">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" name="cari" class="btn btn-primary w-100">Cari</button>
                            </div>
                    </form>

                    <?php if (isset($data_barang) && count($data_barang) > 0): ?>
                        <div class="col-md-3">
                            <form action="export_excel.php" method="post" target="_blank">
                                <input type="hidden" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
                                <input type="hidden" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
                                <button type="submit" class="btn btn-success w-100">Download Excel</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tabel Monitoring Stok -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Ukuran</th>
                                <th>Jumlah Barang Masuk</th>
                                <th>Jumlah Barang Keluar</th>
                                <th>Sisa Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($data_barang) && count($data_barang) > 0): ?>
                                <?php foreach ($data_barang as $index => $barang): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($barang['kode']) ?></td>
                                        <td><?= htmlspecialchars($barang['nama']) ?></td>
                                        <td><?= htmlspecialchars($barang['jenis']) ?></td>
                                        <td><?= htmlspecialchars($barang['ukuran']) ?></td>
                                        <td><?= htmlspecialchars($barang['total_masuk']) ?></td>
                                        <td><?= htmlspecialchars($barang['total_keluar']) ?></td>
                                        <td><?= htmlspecialchars($barang['stok']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>