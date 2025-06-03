<?php
include 'function.php';

if (isset($_POST['cari'])) {
    $kode = $_POST['kode_barang'];

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
            barang.kode LIKE '%$kode%'
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
                    <h5>MONITORING STOK</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <form action="/?page=monitoring-stok" method="post" class="d-flex align-items-center gap-3">
                            <div class="col-3 p-0">
                                <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="Masukkan Kode Barang">
                            </div>
                            <div class="col-auto p-0">
                                <button type="submit" name="cari" id="btn-cari" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
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
                                <?php if (isset($data_barang) && count($data_barang) > 0): ?>
                                    <?php $no = 1; foreach ($data_barang as $barang): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($barang['kode']); ?></td>
                                            <td><?= htmlspecialchars($barang['nama']); ?></td>
                                            <td><?= htmlspecialchars($barang['jenis']); ?></td>
                                            <td><?= htmlspecialchars($barang['ukuran']); ?></td>
                                            <td><?= htmlspecialchars($barang['stok']); ?></td>
                                            <td>
                                                <a href="/?page=detail-barang&id=<?= $barang['id_barang']; ?>" class="btn btn-info btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
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