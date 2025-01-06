<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="<?= base_url() ?>assets/img/logo.png" alt="Logo" class="rounded-circle" style="height: 50px;">
                <span class="d-none d-sm-block fw-bold">SMKN 2 KUNINGAN</span>
            </a>
            <form class="d-flex ms-auto">
                <input class="form-control me-2 rounded-pill" type="search" placeholder="Cari Kandidat..."
                    aria-label="Search">
                <button class="btn btn-outline-light rounded-pill" type="submit">
                    <img src="<?= base_url() ?>assets/img/search icon.png" alt="search-icon" style="width: 20px;">
                </button>
            </form>
        </div>
    </nav>

    <?= $this->renderSection('content') ?>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/stisla.js"></script>
    <?= $this->renderSection("script") ?>
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>