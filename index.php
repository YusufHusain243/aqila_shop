<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="assets/fonts/phosphor/duotone/style.css">
    <link rel="stylesheet" href="assets/fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="assets/css/style-preset.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <!-- Loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <?php
    $page = $_GET['page'] ?? 'dashboard';
    include('components/sidebar.php');
    include('components/header.php');
    ?>

    <!-- Main Content -->
    <div class="pc-container">
        <?php
        if ($role === 'owner') {
            switch ($page) {
                case 'dashboard':
                    include('pages_owner/dashboard.php');
                    break;
                case 'kelola-user':
                    include('pages_owner/kelola-user.php');
                    break;
                case 'monitoring-stok':
                    include('pages_owner/monitoring-stok.php');
                    break;
                case 'laporan':
                    include('pages_owner/laporan.php');
                    break;
                default:
                    echo "<h1 class='text-center'>Halaman tidak ditemukan</h1>";
                    break;
            }
        } else {
            switch ($page) {
                case 'dashboard':
                    include('pages_staff/dashboard.php');
                    break;
                case 'data-barang':
                    include('pages_staff/data-barang.php');
                    break;
                case 'data-barang-masuk':
                    include('pages_staff/data-barang-masuk.php');
                    break;
                case 'data-barang-keluar':
                    include('pages_staff/data-barang-keluar.php');
                    break;
                case 'monitoring-stok':
                    include('pages_staff/monitoring-stok.php');
                    break;
                case 'laporan':
                    include('pages_staff/laporan.php');
                    break;
                case 'logout':
                    include('logout.php');
                    break;
                default:
                    echo "<h1 class='text-center'>Halaman tidak ditemukan</h1>";
                    break;
            }
        }
        ?>
    </div>

    <?php
    include('components/footer.php');
    ?>

    <!-- Scripts -->
    <script src="assets/js/plugins/popper.min.js"></script>
    <script src="assets/js/plugins/simplebar.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>

    <!-- Load jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#tableBarang').DataTable({});
        });
        $(document).ready(function() {
            $('#barangMasukTable').DataTable({});
        });
        $(document).ready(function() {
            $('#barangKeluarTable').DataTable({});
        });
        $(document).ready(function() {
            $('#tableUser').DataTable({});
        });
    </script>
</body>

</html>