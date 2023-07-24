<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-<?= Router::baseUrl() ?>/assets-path="<?= Router::baseUrl() ?>/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sistem Informasi Pegawai - CV. Dharma Cipta Pratama</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= Router::baseUrl() ?>/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= Router::baseUrl() ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= Router::baseUrl() ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= Router::baseUrl() ?>/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= Router::baseUrl() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?= Router::baseUrl() ?>/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" type="text/css" href="<?= Router::baseUrl() ?>/assets/vendor/datatables.min.css">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= Router::baseUrl() ?>/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= Router::baseUrl() ?>/assets/js/config.js"></script>
    <script src="<?= Router::baseUrl() ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= Router::baseUrl() ?>/assets/vendor/datatables.min.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="<?= Router::baseUrl() ?>/assets/img/icons/logo.jpg" alt="Logo.jpg" width="25px">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">SI Pegawai</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="<?= Router::baseUrl() ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Data Master</span>
                    </li>

                    <li class="menu-item">
                        <a href="<?= Router::baseUrl('jabatan') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div>Jabatan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= Router::baseUrl('gaji') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-wallet"></i>
                            <div>Gaji</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?= Router::baseUrl('pegawai') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div>Pegawai</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-building"></i>
                            <div>Project</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="<?= Router::baseUrl('bangunan') ?>" class="menu-link">
                                    <div>Bangunan</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= Router::baseUrl('jalan') ?>" class="menu-link">
                                    <div>Jalan</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="<?= Router::baseUrl('jembatan') ?>" class="menu-link">
                                    <div>Jembatan</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-wallet"></i>
                            <div>Keuangan</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="<?= Router::baseUrl('pendapatan') ?>" class="menu-link">
                                    <div>Pendapatan</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= Router::baseUrl('pengeluaran') ?>" class="menu-link">
                                    <div>Pengeluaran</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item ">
                        <a href="<?= Router::baseUrl('pengawasan') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-hard-hat"></i>
                            <div>Pengawasan</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a href="<?= Router::baseUrl('kontraktor') ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-notepad"></i>
                            <div>Kontraktor</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-library"></i>
                            <div>Laporan</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="<?= Router::baseUrl('laporan/bangunan') ?>" class="menu-link">
                                    <div>Project Bangunan</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="<?= Router::baseUrl('laporan/jalan') ?>" class="menu-link">
                                    <div>Project Jalan</div>
                                </a>
                            </li>
                            <li class="menu-item ">
                                <a href="<?= Router::baseUrl('laporan/jembatan') ?>" class="menu-link">
                                    <div>Project Jembatan</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>

            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <ah class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </ah>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="<?= Router::baseUrl() ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="<?= Router::baseUrl() ?>/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"><?= Session::get('username') ?></span>
                                                    <small class="text-muted"><?= Session::get('level') ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="logout">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <?php if (Session::has('success')) : ?>
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <?= Session::retrive('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                        <?php if (Session::has('error')) : ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <?= Session::retrive('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif ?>
                        <?= $content ?>
                    </div>

                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                <a href="#" class="footer-link fw-bolder">CV. Dharma Cipta Pratama</a>
                            </div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <script src="<?= Router::baseUrl() ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= Router::baseUrl() ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?= Router::baseUrl() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= Router::baseUrl() ?>/assets/vendor/js/menu.js"></script>

    <!-- Vendors JS -->
    <script src="<?= Router::baseUrl() ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?= Router::baseUrl() ?>/assets/js/main.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>