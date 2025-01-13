<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <style>
     

     


        /* Optional: Add hover effect for smooth image scaling */
    </style>
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <img src="<? base_url() ?>assets/" alt="">
                <a href="index.html" class="navbar-brand sidebar-gone-hide">SMKN 2 Kuningan</a>
                <a href="#" class="nav-link sidebar-gone-show m-3" data-toggle="sidebar">SMKN 2 Kuningan</a>

                <form class="form-inline ml-auto">
                    <ul class="navbar-nav ">
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Cari Kandidat" aria-label="Search"
                            data-width="250">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        
                        <li class="nav-item active">
                            <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Home</span></a>
                        </li>
                    </ul>
                </div>
            </nav>


            <!-- Main Content -->
            <div class="main-content">
                <!-- <section class="section bg-primary rounded p-1 mb-3">
                    <h1 class="text-center text-white text-uppercase mt-2">Para Kandidat</h1>
                </section> -->

                <section class="section">
                    <div class="section-header">
                        <h1>Top Navigation</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Layout</a></div>
                            <div class="breadcrumb-item">Top Navigation</div>
                        </div>
                    </div>

                    <div class="section-body">

                        <div class="row justify-content-center ">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                <article class="article ">
                                    <div class="article-header rounded">
                                        <div class="article-image bg-secondary"
                                            data-background="https://picsum.photos/400/300">
                                        </div>
                                    </div>
                                    <div class="article-details">
                                        <h3 class="text-center font-weight-bold">Gustavo Fring</h3>
                                        <p class="text-center text-muted">Kandidat 1</p>
                                        <div class="article-cta">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Vote
                                            </button>
                                        </div>
                                    </div>
                                </article>

                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-4">
                                <article class="article ">
                                    <div class="article-header rounded">
                                        <div class="article-image bg-secondary"
                                            data-background="https://picsum.photos/400/300">
                                        </div>
                                    </div>
                                    <div class="article-details">
                                        <h3 class="text-center font-weight-bold">Gustavo Fring</h3>
                                        <p class="text-center text-muted">Kandidat 1</p>
                                        <div class="article-cta">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Vote
                                            </button>
                                        </div>
                                    </div>
                                </article>

                            </div>
                            
                        </div>
                    </div>
                </section>

                <!-- card kandidat -->


            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid p-0">
                    <div class="row">
                        <!-- Bagian kiri untuk gambar -->
                        <div class="col-lg-4 col-md-12 mb-4">
                            <img src="<?= base_url() ?>assets/img/avatar/avatar-1.png" class="img-fluid rounded mx-auto d-block" alt="kandidat" style="max-height: 300px;">
                        </div>
                        <!-- Bagian kanan untuk detail -->
                        <div class="col-lg-8 col-md-12">
                            <h3 class="mb-4 text-center text-lg-left">Gustavo Fring</h3>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h5><strong>Visi:</strong></h5>
                                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum quis fuga eos facere pariatur laudantium deleniti, accusamus modi doloremque architecto, minus enim sed aliquam quasi laborum iure id accusantium temporibus.</p>
                                    </div>
                                    <div>
                                        <h5><strong>Misi:</strong></h5>
                                        <ul class="pl-3">
                                            <li>1. ambasing</li>
                                            <li>2. ambasing</li>
                                            <li>3. ambasing</li>
                                            <li>4. ambasing</li>
                                            <li>5. ambasing</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Vote Kandidat</button>
            </div>
        </div>
    </div>
</div>


    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>