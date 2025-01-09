<?= $this->extend('layouts/main'); ?>

<?= $this->section('content') ?>
<!-- chart  -->
<section class="section">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Order Statistics -
                        <div class="dropdown d-inline">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"
                                id="orders-month">August</a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li class="dropdown-title">Select Month</li>
                                <li><a href="#" class="dropdown-item">January</a></li>
                                <li><a href="#" class="dropdown-item">February</a></li>
                                <li><a href="#" class="dropdown-item">March</a></li>
                                <li><a href="#" class="dropdown-item">April</a></li>
                                <li><a href="#" class="dropdown-item">May</a></li>
                                <li><a href="#" class="dropdown-item">June</a></li>
                                <li><a href="#" class="dropdown-item">July</a></li>
                                <li><a href="#" class="dropdown-item ">August</a></li>
                                <li><a href="#" class="dropdown-item">September</a></li>
                                <li><a href="#" class="dropdown-item">October</a></li>
                                <li><a href="#" class="dropdown-item">November</a></li>
                                <li><a href="#" class="dropdown-item">December</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">24</div>
                            <div class="card-stats-item-label">Pending</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">12</div>
                            <div class="card-stats-item-label">Shipping</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count">23</div>
                            <div class="card-stats-item-label">Completed</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Orders</h4>
                    </div>
                    <div class="card-body">
                        59
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
    </div>
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