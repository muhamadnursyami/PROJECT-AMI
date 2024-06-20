<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/logo-title.png') ?>" />
    <link rel="stylesheet" href=" <?= base_url('assets/css/backend-plugin.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/backend.css?v=1.0.0') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/remixicon/fonts/remixicon.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css') ?>">
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
            <div class="loader"></div>
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center border-bottom">
                <a href="/auditor/dashboard" class="header-logo ml-2">
                    <img src="<?= base_url('assets/images/logo-umrah.png') ?>" alt="logo">
                </a>
                <div class="iq-menu-bt-sidebar ml-0">
                    <i class="las la-bars wrapper-menu"></i>
                </div>
            </div>

            <div class="data-scrollbar" data-scroll="1">
                <nav class="iq-sidebar-menu">
                    <ul id="iq-sidebar-toggle" class="iq-menu">
                        <li <?= ($currentPage == 'dashboard') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/dashboard" class="svg-icon">
                                <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <small class="ml-4"> Dashboard </small>

                            </a>
                        </li>
                        <li <?= ($currentPage == 'lihat-form-ed') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/form-ed/view" class="svg-icon">
                                <svg class="svg-icon" id="p-dash13" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <small class="ml-4">Isi Form ED</small>
                            </a>
                        </li>
                        <li <?= ($currentPage == 'form-1') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/form-1" class="svg-icon">
                                <svg class="svg-icon" id="p-dash13" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <small class="ml-4">Form 1</small>
                            </a>
                        </li>
                        <li <?= ($currentPage == 'form-2') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/form-2" class="svg-icon">
                                <svg class="svg-icon" id="p-dash13" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <small class="ml-4">Form 2</small>
                            </a>
                        </li>
                        <li <?= ($currentPage == 'form-3') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/form-3" class="svg-icon">
                                <svg class="svg-icon" id="p-dash13" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <small class="ml-4">Form 3</small>
                            </a>
                        </li>
                        <li <?= ($currentPage == 'form-4') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/form-4" class="svg-icon">
                                <svg class="svg-icon" id="p-dash13" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <small class="ml-4">Form 4</small>
                            </a>
                        </li>
                        <li <?= ($currentPage == 'form-5') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/form-5" class="svg-icon">
                                <svg class="svg-icon" id="p-dash13" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                </svg>
                                <small class="ml-4">Form 5</small>
                            </a>
                        </li>
                        <li <?= ($currentPage == 'upload-berkas') ? 'class="active"' : ''; ?>>
                            <a href="/auditor/upload-berkas" class="svg-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M15 4H5V20H19V8H15V4ZM3 2.9918C3 2.44405 3.44749 2 3.9985 2H16L20.9997 7L21 20.9925C21 21.5489 20.5551 22 20.0066 22H3.9934C3.44476 22 3 21.5447 3 21.0082V2.9918ZM13 12V16H11V12H8L12 8L16 12H13Z"></path>
                                </svg>
                                <small class="ml-4">Upload Berkas</small>
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="pt-5 pb-2"></div>
            </div>
        </div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="../backend/index.html" class="header-logo">
                            <h4 class="logo-title text-uppercase">AMI UMRAH</h4>

                        </a>
                    </div>
                    <div class="navbar-breadcrumb">

                    </div>
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?= base_url('assets/images/user/user.png') ?>" class="img-fluid rounded-circle" alt="user">
                                        <div class="caption ml-2 mt-2">
                                            <small class="mb-0 line-height text-uppercase"><?= session()->get('name') ?><i class="las la-angle-down ml-2 w-50%"></i></small>
                                            <p><?= session()->get('role_id') ?></p>
                                        </div>

                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-item  d-flex svg-icon">
                                            <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <a href="<?= base_url('logout') ?>">Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-page">
            <div class="container-fluid">

                <?= $this->renderSection('content') ?>

            </div>
        </div>
    </div>
    <!-- Wrapper End-->


    <footer class="iq-footer">
        <div class="container-fluid">

            <p class="text-center">Copyright © UMRAH 2024 </p>

        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="<?= base_url('assets/js/backend-bundle.min.js') ?>"></script>

    <!-- Table Treeview JavaScript -->
    <script src="<?= base_url('assets/js/table-treeview.js') ?>"></script>

    <!-- Chart Custom JavaScript -->
    <script src="<?= base_url('assets/js/customizer.js') ?>"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="<?= base_url('assets/js/chart-custom.js') ?>"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="<?= base_url('assets/js/slider.js') ?>"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/moment.min.js') ?>"></script>
</body>

</html>