<?= $this->extend('layouts/main'); ?>

<?= $this->section('content') ?>
<!-- chart  -->

<!-- Kandidat Paling Populer -->
<div class="col-12 mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
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
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-4 mb-lg-0 text-center">
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle"
                        style="width: 75px; height: 75px;">
                    <div class="mt-2 font-weight-bold">ujaa</div>
                    <div class="text-medium font-weight-bold"><span class="text-primary">76<i class="fas fa-percent"></i></span>
                        </div>
                </div>
                <div class="col mb-4 mb-lg-0 text-center">
                    <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle"
                        style="width: 75px; height: 75px;">
                    <div class="mt-2 font-weight-bold">Kandadats</div>
                    <div class="text-medium font-weight-bold"><span class="text-primary">23<i class="fas fa-percent"></i></span>
                        </div>
                </div>
                <div class="col mb-4 mb-lg-0 text-center">
                    <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle"
                        style="width: 75px; height: 75px;">
                    <div class="mt-2 font-weight-bold">Kandadats</div>
                    <div class="text-medium font-weight-bold"><span class="text-primary">23<i class="fas fa-percent"></i></span>
                        </div>
                </div>
                <div class="col mb-4 mb-lg-0 text-center">
                    <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle"
                        style="width: 75px; height: 75px;">
                    <div class="mt-2 font-weight-bold">Kandadats</div>
                    <div class="text-medium font-weight-bold"><span class="text-primary">23<i class="fas fa-percent"></i></span>
                        </div>
                </div>
                <div class="col mb-4 mb-lg-0 text-center">
                    <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle"
                        style="width: 75px; height: 75px;">
                    <div class="mt-2 font-weight-bold">Kandadats</div>
                    <div class="text-medium font-weight-bold"><span class="text-primary">23<i class="fas fa-percent"></i></span>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Data Kelas -
                        <div class="dropdown d-inline">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"
                                id="orders-month">Pilih Kelas</a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li class="dropdown-title">Select Class</li>
                                <li><a href="#" class="dropdown-item active">Semua</a></li>
                                <li><a href="#" class="dropdown-item">X PPLG 1</a></li>
                                <li><a href="#" class="dropdown-item">X PPLG 2</a></li>
                                <li><a href="#" class="dropdown-item">X PPLG 3</a></li>
                                <li><a href="#" class="dropdown-item">XI PPLG 1</a></li>
                                <li><a href="#" class="dropdown-item">XI PPLG 2</a></li>
                                <li><a href="#" class="dropdown-item">XI PPLG 3</a></li>
                                <li><a href="#" class="dropdown-item">XII PPLG 1</a></li>
                                <li><a href="#" class="dropdown-item ">XII PPLG 2</a></li>
                                <li><a href="#" class="dropdown-item">XII PPLG 3</a></li>
                                <li><a href="#" class="dropdown-item">X AKL 1</a></li>
                                <li><a href="#" class="dropdown-item">X AKL 2</a></li>
                                <li><a href="#" class="dropdown-item">X AKL 3</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24</div>
                            <div class="card-stats-item-label">Belum Vote</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">23</div>
                            <div class="card-stats-item-label">Sudah Vote</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total yang Terdaftar</h4>
                    </div>
                    <div class="card-body">
                        200
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <div class="chartjs-size-monitor"
                        style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <canvas id="balance-chart" height="128" width="540"
                        style="display: block; height: 64px; width: 270px;" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Balance</h4>
                    </div>
                    <div class="card-body">
                        $187,13
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <div class="chartjs-size-monitor"
                        style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <canvas id="sales-chart" height="128" width="540"
                        style="display: block; height: 64px; width: 270px;" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Sales</h4>
                    </div>
                    <div class="card-body">
                        4,732
                    </div>
                </div>
            </div>
        </div>
        >
</section>
<section class="section">
    <div class="section-body">
        <h2 class="section-title">Chart.js</h2>
        <p class="section-lead">
            We use 'Chart.JS' made by @chartjs. You can check the full documentation <a
                href="http://www.chartjs.org/">here</a>.
        </p>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Line Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" width="710" height="354"
                            style="display: block; height: 177px; width: 355px;"
                            class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Bar Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Doughnut Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pie Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- JS Libraies -->
<script src="assets/modules/chart.min.js"></script>
<script src="assets/modules/jquery.sparkline.min.js"></script>
<script src="assets/modules/chart.min.js"></script>
<script src="assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="assets/modules/summernote/summernote-bs4.js"></script>
<script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Page Specific JS File -->
<script src="assets/js/page/modules-chartjs.js"></script>
<script src="assets/js/page/index.js"></script>

<?= $this->endSection() ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>