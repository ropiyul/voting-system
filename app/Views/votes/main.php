<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/modules/toastr/toastr.min.css">
    <?= $this->renderSection("style") ?>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <style>
        .modal-xl-custom {
            max-width: 90%;
            width: 90%;
        }

        .btn-custom {
            width: 8rem;
        }

        .large {
            width: 8rem;
            height: 8rem;
        }
    </style>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');
    </script>
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>

            <!-- Main Navbar -->
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="index.html" class="navbar-brand sidebar-gone-hide">SMKN 2 Kuningan</a>
                <a href="#" class="nav-link sidebar-gone-show m-3" data-toggle="sidebar"> <i
                        class="fas fa-bars large"></i></a>

                <form class="form-inline ml-auto">
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Cari Kandidat" aria-label="Search"
                            data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="#" class="dropdown-item has-icon text-primary">
                                <i class="fas fa-sign-out-alt"></i> Profile
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Secondary Navbar -->
            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-users"></i> <span>Para Kandidat</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-poll"></i> <span>Voting</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-cogs"></i> <span>Pengaturan</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="#"><i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span></a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="main-content">
                <?= $this->renderSection('content') ?>
                <!-- <section class="section mt-3">
                    <div class="section-header">
                        <h1>Para Kandidat</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item"><a href="#">Para Kandidat</a></div>
                            <div class="breadcrumb-item"><a href="#">Voting</a></div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <article class="article">
                                    <div class="article-header rounded">
                                        <div class="article-image bg-secondary img-fluid"
                                            style="background-image: url('https://picsum.photos/400/300');">
                                        </div>
                                    </div>
                                    <div class="article-details">
                                        <h3 class="text-center font-weight-bold">Gustavo Fring</h3>
                                        <p class="text-center text-muted">Kandidat 1</p>
                                        <div class="article-cta">
                                            <button type="button" class="btn btn-primary btn-custom" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Visi & Misi
                                            </button>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </section> -->
            </div>
        </div>
    </div>



    <!-- General JS Scripts -->
    <script src="assets/modules/jquery.min.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/js/stisla.js"></script>
    <script src="assets/modules/toastr/toastr.min.js"></script>

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <?= $this->renderSection('script') ?>
</body>

</html>