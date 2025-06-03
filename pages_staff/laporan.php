<div class="pc-content">
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>MONITORING STOK</h5>
                </div>
                <div class="card-body">

                    <!-- Form Filter Tanggal -->
                    <form class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="startDate" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="startDate" name="start_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="endDate" class="form-label">Tanggal Selesai</label>
                                <input type="date" id="endDate" name="end_date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">Cari</button>
                            </div>
                        </div>
                    </form>

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
                                <tr>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>