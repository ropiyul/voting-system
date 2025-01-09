<?= $this->extend('layouts/main'); ?>
<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <!-- Statistik -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistik kandidat</h4>
                    <div class="card-header-action">
                        <a href="#" class="btn active">PPLG</a>
                        <a href="#" class="btn">AKL</a>
                        <a href="#" class="btn">TJKT</a>
                        <a href="#" class="btn">MPLB</a>
                        <a href="#" class="btn">ULP</a>
                        <a href="#" class="btn">PM</a>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="180"></canvas>
                    <div class="statistic-details mt-1">
                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 7%</div>
                            <div class="detail-value">Ujaaa</div>
                            <div class="detail-name">bang uja</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 23%</div>
                            <div class="detail-value">Djawa</div>
                            <div class="detail-name">el jawir</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 9%</div>
                            <div class="detail-value">Kandidut</div>
                            <div class="detail-name">kandiduted</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                            <div class="detail-value">Kandadat</div>
                            <div class="detail-name">kandadatss</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 19%</div>
                            <div class="detail-value">Kandudut</div>
                            <div class="detail-name">kandudutss</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kandidat Paling Populer -->
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Kandidat Paling Populer</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col mb-4 mb-lg-0 text-center">
                        <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle" style="width: 75px; height: 75px;">
                            <div class="mt-2 font-weight-bold">ujaa</div>
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 48%</div>
                        </div>
                        <div class="col mb-4 mb-lg-0 text-center">
                        <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle" style="width: 75px; height: 75px;">
                            <div class="mt-2 font-weight-bold">Kandadats</div>
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 26%</div>
                        </div>
                        <div class="col mb-4 mb-lg-0 text-center">
                        <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle" style="width: 75px; height: 75px;">
                            <div class="mt-2 font-weight-bold">Djawa</div>
                            <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 14%</div>
                        </div>
                        <div class="col mb-4 mb-lg-0 text-center">
                        <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle" style="width: 75px; height: 75px;">
                            <div class="mt-2 font-weight-bold">Opera</div>
                            <div class="text-small text-muted">7%</div>
                        </div>
                        <div class="col mb-4 mb-lg-0 text-center">
                        <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" style="width: 75px; height: 75px;">
                            <div class="mt-2 font-weight-bold">IE</div>
                            <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 5%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

  <!-- JS Libraies -->
  <script src="<?= base_url()?> assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?= base_url()?>assets/modules/chart.min.js"></script>
  <script src="<?= base_url()?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?= base_url()?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?= base_url()?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url()?> assets/js/page/components-statistic.js"></script>
<?= $this->endSection() ?>

<?= $this->section('style') ?>

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url()?> assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/modules/flag-icon-css/css/flag-icon.min.css">
<?= $this->endSection() ?>
