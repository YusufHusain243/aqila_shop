<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="/" class="b-brand text-primary">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="assets/images/logo.png" alt="logo_upr" class="logo logo-lg" width="100" />
                    </div>
                </div>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Menu</label>
                    <i class="ti ti-dashboard"></i>
                </li>

                <li class="pc-item <?= $page === 'dashboard' ? 'active' : '' ?>">
                    <a href="/?page=dashboard" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pc-item <?= $page === 'data-barang' ? 'active' : '' ?>">
                    <a href="/?page=data-barang" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Kelola Data Barang</span>
                    </a>
                </li>
                <li class="pc-item <?= $page === 'data-barang-masuk' ? 'active' : '' ?>">
                    <a href="/?page=data-barang-masuk" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Data Barang Masuk</span>
                    </a>
                </li>
                <li class="pc-item <?= $page === 'data-barang-keluar' ? 'active' : '' ?>">
                    <a href="/?page=data-barang-keluar" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Data Barang Keluar</span>
                    </a>
                </li>
                <li class="pc-item <?= $page === 'monitoring-stok' ? 'active' : '' ?>">
                    <a href="/?page=monitoring-stok" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Monitoring Stok</span>
                    </a>
                </li>
                <li class="pc-item <?= $page === 'laporan' ? 'active' : '' ?>">
                    <a href="/?page=laporan" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Laporan</span>
                    </a>
                </li>
                <li class="pc-item <?= $page === 'logout' ? 'active' : '' ?>">
                    <a href="/?page=logout" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-layout"></i></span>
                        <span class="pc-mtext">Logout</span>
                    </a>
                </li>
            </ul>

            <div class="w-100 text-center">
                <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
            </div>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->