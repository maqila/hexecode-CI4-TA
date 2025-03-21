<!DOCTYPE html>
<html lang="en"> <!-- Sebaiknya gunakan "en" atau bahasa yang sesuai -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= esc($title) ?></title>
    <link rel="icon" href="<?= base_url('assets/images/favicon.png') ?>" sizes="20x20" type="image/png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css?v=1.0.1') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.min.css?v=1.0.3') ?>">
    <script src="https://kit.fontawesome.com/2bbd03827e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/slick.css?v=1.0.1') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/navbar-after-login.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/homepage-admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/penampilan-admin.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/approve-acc.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/audisi-admin.css') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Finger+Paint&family=Lexend+Deca:wght@100..900&family=Playpen+Sans:wght@100..800&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <style>
        .social-link {
            color: #6c757d;
            transition: color 0.3s ease-in-out, transform 0.2s ease-in-out;
            text-decoration: none;
        }

        .social-link:hover {
            color: #007bff;
            transform: scale(1.2);
        }
    </style>
</head>

<body>
    <div class="page-wrapper">

        <!-- Navbar start -->
        <nav class="navbar navbar-area style-three navbar-expand-lg">
            <div class="container nav-container">
                <div class="logo">
                    <a href="<?= base_url('Admin/homepage') ?>">
                        <img src="<?= base_url('assets/images/logos/logo-one.png') ?>" alt="img">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="Iitechie_main_menu">
                    <ul class="navbar-nav menu-open">

                        <!-- Menu tambahan untuk Audisi dan Penampilan -->
                        <li>
                            <a href="<?= base_url('Admin/listAudisi') ?>">Audisi</a>
                        </li>
                        <li>
                            <a href="<?= base_url('Admin/listPenampilan') ?>">Penampilan</a>
                        </li>
                        <li>
                            <a href="<?= base_url('Admin/approveMitra') ?>">Mitra Teater</a>
                        </li>
                        <li>
                            <a href="<?= base_url('aboutUs.html') ?>">Tentang Kami</a>
                        </li>

                        <!-- Start Notification -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn btn-sm top-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                                <i class="fa-solid fa-bell align-middle"></i>
                                <span class="btn-marker"><i class="marker marker-dot text-danger"></i></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3 bg-info">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-white m-0"><i class="fa-regular fa-bell me-2"></i> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="badge bg-info-subtle text-info"> 8+</a>
                                        </div>
                                    </div>
                                </div>
                                <div style="max-height: 230px; overflow-y: auto;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xs avatar-label-primary me-3">
                                                <span class="rounded fs-16">
                                                    <i class="fa-regular fa-file-lines"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">New report has been received</h6>
                                                <div class="fs-12 text-muted">
                                                    <p class="mb-0"><i class="fa-regular fa-clock"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right align-middle ms-2"></i>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xs avatar-label-success me-3">
                                                <span class="rounded fs-16">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Last order was completed</h6>
                                                <div class="fs-12 text-muted">
                                                    <p class="mb-0"><i class="fa-regular fa-clock"></i> 1 hour ago</p>
                                                </div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right align-middle ms-2"></i>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xs avatar-label-danger me-3">
                                                <span class="rounded fs-16">
                                                    <i class="fa-solid fa-users"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Completed meeting canceled</h6>
                                                <div class="fs-12 text-muted">
                                                    <p class="mb-0"><i class="fa-regular fa-clock"></i> 5 hour ago</p>
                                                </div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right align-middle ms-2"></i>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xs avatar-label-warning me-3">
                                                <span class="rounded fs-16">
                                                    <i class="fa-regular fa-paper-plane"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">New feedback received</h6>
                                                <div class="fs-12 text-muted">
                                                    <p class="mb-0"><i class="fa-regular fa-clock"></i> 6 hour ago</p>
                                                </div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right align-middle ms-2"></i>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xs avatar-label-secondary me-3">
                                                <span class="rounded fs-16">
                                                    <i class="fa-solid fa-download"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">New update was available</h6>
                                                <div class="fs-12 text-muted">
                                                    <p class="mb-0"><i class="fa-regular fa-clock"></i> 1 day ago</p>
                                                </div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right align-middle ms-2"></i>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar avatar-xs avatar-label-info me-3">
                                                <span class="rounded fs-16">
                                                    <i class="fa-solid fa-key"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-1">Your password was changed</h6>
                                                <div class="fs-12 text-muted">
                                                    <p class="mb-0"><i class="fa-regular fa-clock"></i> 2 day ago</p>
                                                </div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right align-middle ms-2"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="fa-solid fa-circle-arrow-right me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Notification -->

                        <!-- Start Profile -->
                        <div class="dropdown d-inline-block" data-bs-auto-close="outside">
                            <button type="button" class="btn btn-sm top-icon p-0" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded avatar-2xs p-0" src="<?= base_url('assets/images/logos/avatar-6.png') ?>" alt="Header Avatar">
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end dropdown-menu-animated overflow-hidden py-0" id="user-dropdown-menu">
                                <div class="card border-0">
                                    <div class="card-header bg-primary rounded-0">
                                        <div class="rich-list-item w-100 p-0">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-label-light avatar-circle">
                                                    <div class="avatar-display"><i class="fa-solid fa-user"></i></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <!-- Menampilkan nama dan email dari data user yang diteruskan ke view -->
                                                <h3 class="rich-list-title text-white"><?= esc($user['nama']) ?></h3>
                                                <span class="rich-list-subtitle text-white"><?= esc($user['email']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <a href="apps-contact.html" class="grid-nav-item">
                                            <div class="grid-nav-icon"><i class="fa-regular fa-address-card"></i></div>
                                            <span class="grid-nav-content">Profile</span>
                                        </a>
                                    </div>
                                    <div class="card-footer card-footer-bordered rounded-0">
                                        <a href="<?= base_url('User/logout') ?>" class="btn btn-label-danger">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Profile -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>