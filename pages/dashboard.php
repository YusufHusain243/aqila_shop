<?php
include 'function.php';
$data_barang = show_data("SELECT COUNT(*) as data_barang FROM barang");
$data_barang_masuk = show_data("SELECT SUM(jumlah) as data_barang_masuk FROM barang_masuk");
$data_barang_keluar = show_data("SELECT SUM(jumlah) as data_barang_keluar FROM barang_keluar");
?>

<div class="pc-content">
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <div class="card bg-blue-900 dashnum-card text-white overflow-hidden">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body">
                    <div class="avtar avtar-lg"><i class="text-white ti ti-receipt"></i></div>
                    <span class="text-white d-block f-34 f-w-500 my-2">
                        <?= $data_barang[0]['data_barang'] ?> <i class="ti ti-layout opacity-50"></i>
                    </span>
                    <p class="mb-0 opacity-50">Jumlah Barang</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4">
            <div class="card bg-green-900 dashnum-card text-white overflow-hidden">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body">
                    <div class="avtar avtar-lg"><i class="text-white ti ti-receipt"></i></div>
                    <span class="text-white d-block f-34 f-w-500 my-2">
                        <?= $data_barang_masuk[0]['data_barang_masuk'] ?> <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                    </span>
                    <p class="mb-0 opacity-50">Jumlah Barang Masuk</p>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4">
            <div class="card bg-red-900 dashnum-card text-white overflow-hidden">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body">
                    <div class="avtar avtar-lg"><i class="text-white ti ti-receipt"></i></div>
                    <span class="text-white d-block f-34 f-w-500 my-2">
                        <?= $data_barang_keluar[0]['data_barang_keluar'] ?><i class="ti ti-arrow-down-right-circle opacity-50"></i>
                    </span>
                    <p class="mb-0 opacity-50">Jumlah Barang Keluar</p>
                </div>
            </div>
        </div>
    </div>
</div>