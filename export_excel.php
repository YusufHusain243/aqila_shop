<?php
include 'function.php';

if (isset($_POST['start_date'], $_POST['end_date'])) {
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=monitoring_stok_$start_date-$end_date.xls");

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

    $data = show_data($query);

    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Ukuran</th>
            <th>Jumlah Barang Masuk</th>
            <th>Jumlah Barang Keluar</th>
            <th>Sisa Stok</th>
        </tr>";

    foreach ($data as $index => $row) {
        echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td>" . htmlspecialchars($row['kode']) . "</td>
            <td>" . htmlspecialchars($row['nama']) . "</td>
            <td>" . htmlspecialchars($row['jenis']) . "</td>
            <td>" . htmlspecialchars($row['ukuran']) . "</td>
            <td>" . htmlspecialchars($row['total_masuk']) . "</td>
            <td>" . htmlspecialchars($row['total_keluar']) . "</td>
            <td>" . htmlspecialchars($row['stok']) . "</td>
        </tr>";
    }

    echo "</table>";
    exit;
}
