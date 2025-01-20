<?= $this->extend('layouts/main'); ?>

<?= $this->section('content') ?>
<!-- chart  -->
<?php

?>

<section class="section">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title d-flex justify-content-between align-items-center">
                        <span>Data Kelas</span>
                        <div class="dropdown">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="selected-class">
                                <?= session()->get('selected_grade') === 'all' ? 'Semua Kelas' : (isset($grades[session()->get('selected_grade') - 1]) ?
                                    $grades[session()->get(key: 'selected_grade') - 1]['name'] : 'Pilih Kelas') ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Pilih Kelas</div>
                                <a href="javascript:void(0)"
                                    class="dropdown-item <?= session()->get('selected_grade') == 'all' ? 'active' : '' ?>"
                                    data-grade="all">Semua Kelas</a>
                                <?php foreach ($grades as $grade): ?>
                                    <a href="javascript:void(0)"
                                        class="dropdown-item <?= session()->get('selected_grade') == $grade['id'] ? 'active' : '' ?>"
                                        data-grade="<?= $grade['id'] ?>">
                                        <?= $grade['name'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="not-voted-count">
                                <?= $statisticByGrade['not_voted'] ?>
                            </div>
                            <div class="card-stats-item-label">Belum Vote</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count" id="voted-count">
                                <?= $statisticByGrade['voted'] ?>
                            </div>
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
                    <div class="card-body" id="total-users">
                        <?= $statisticByGrade['total_users'] ?>
                    </div>
                </div>
            </div>
        </div>

       <!-- Card Kedua (Statistik Kandidat) -->
<div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
        <div class="card-stats">
            <div class="card-stats-title">Statistik Kandidat</div>
            <div class="card-stats-items d-flex justify-content-around">
                <div class="card-stats-item text-center">
                    <div class="card-stats-item-count">3</div>
                    <div class="card-stats-item-label">Total Kandidat</div>
                </div>
                <div class="card-stats-item text-center">
                    <div class="card-stats-item-count">150</div>
                    <div class="card-stats-item-label">Vote Tertinggi</div>
                </div>
            </div>
        </div>
        <div class="card-icon shadow bg-primary">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header bg-transparent border-0">
                <h4 class="mb-0">Total Suara Masuk</h4>
            </div>
            <div class="card-body pt-0">
                450
            </div>
        </div>
    </div>
</div>

<!-- Card Ketiga (Persentase Partisipasi) -->
<div class="col-lg-4 col-md-4 col-sm-12">
    <div class="card card-statistic-2">
        <div class="card-stats">
            <div class="card-stats-title">Persentase Partisipasi</div>
            <div class="card-stats-items d-flex justify-content-around">
                <div class="card-stats-item text-center">
                    <div class="card-stats-item-count text-success">75%</div>
                    <div class="card-stats-item-label">Tingkat Partisipasi</div>
                </div>
                <div class="card-stats-item text-center">
                    <div class="card-stats-item-count text-danger">25%</div>
                    <div class="card-stats-item-label">Belum Berpartisipasi</div>
                </div>
            </div>
        </div>
        <div class="card-icon shadow bg-primary">
            <i class="fas fa-chart-pie"></i>
        </div>
        <div class="card-wrap">
            <div class="card-header bg-transparent border-0">
                <h4 class="mb-0">Target Partisipasi</h4>
            </div>
            <div class="card-body pt-0">
                100%
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
                        <canvas id="kandidatChart"></canvas>
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
            <div class="col-12 col-sm-12 col-lg-12">
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
                                <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-1.png" class="rounded-circle" style="width: 75px; height: 75px;">
                                <div class="mt-2 font-weight-bold">ujaa</div>
                                <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 48%</div>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-2.png" class="rounded-circle" style="width: 75px; height: 75px;">
                                <div class="mt-2 font-weight-bold">Kandadats</div>
                                <div class="text-small text-muted"><span class="text-primary"><i class="fas fa-caret-up"></i></span> 26%</div>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-3.png" class="rounded-circle" style="width: 75px; height: 75px;">
                                <div class="mt-2 font-weight-bold">Djawa</div>
                                <div class="text-small text-muted"><span class="text-danger"><i class="fas fa-caret-down"></i></span> 14%</div>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-4.png" class="rounded-circle" style="width: 75px; height: 75px;">
                                <div class="mt-2 font-weight-bold">Opera</div>
                                <div class="text-small text-muted">7%</div>
                            </div>
                            <div class="col mb-4 mb-lg-0 text-center">
                                <img alt="image" src="<?= base_url() ?>assets/img/avatar/avatar-5.png" class="rounded-circle" style="width: 75px; height: 75px;">
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
<script src="<?= base_url() ?>assets/modules/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?= base_url() ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url() ?>assets/modules/chart.min.js"></script>
<script src="<?= base_url() ?>assets/js/page/modules-chartjs.js"></script>
<script src="<?= base_url() ?>assets/js/page/index.js"></script>


<!-- Page Specific JS File -->
<script>
    $(document).ready(function() {
        console.log('Document ready - script initialized.');

        // Inisialisasi chart
        let kandidatChart = null;

        function initializeKandidatChart() {
            console.log('Initializing chart...');
            const ctx = document.getElementById('kandidatChart').getContext('2d');
            kandidatChart = new Chart(ctx, {
                type: 'bar',
                labels: [],
                data: {
                    datasets: [{
                        label: "Kandidat",
                        data: [],
                        backgroundColor: 'rgba(63,82,227,.8)',
                        borderWidth: 10
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            console.log('Chart initialized.');
        }

        // Fungsi untuk update statistik kandidat
        function updateCandidateStats(candidates) {
            console.log('Updating candidate stats with data:', candidates);

            // Update chart
            if (kandidatChart) {
                console.log('Updating chart with candidates:', candidates);
                kandidatChart.data.labels = candidates.map(c => c.name);
                kandidatChart.data.datasets[0].data = candidates.map(c => c.vote_count);
                kandidatChart.update();
            }

            // Update detail statistik
            let html = '';
            candidates.forEach(candidate => {
                html += `
                <div class="statistic-details-item">
                    <div class="text-small text-muted">
                        ${candidate.percentage || 0}% <!-- Default to 0 if undefined -->
                    </div>
                    <div class="detail-value">${candidate.vote_count}</div>
                    <div class="detail-name">${candidate.name}</div>
                </div>
            `;
            });
            $('#candidate-stats').html(html);
            console.log('Candidate stats updated in the DOM.');
        }

        // Handle dropdown kelas
        $('.dropdown-item').click(function(e) {
            e.preventDefault();
            console.log('Dropdown item clicked.');

            $('#selected-class').text($(this).text());
            $('.dropdown-item').removeClass('active');
            $(this).addClass('active');

            let gradeId = $(this).data('grade');
            console.log('Selected grade ID:', gradeId);

            // Tambahkan loading state
            $('#not-voted-count, #voted-count, #total-users').html('<i class="fas fa-spinner fa-spin"></i>');
            $('#candidate-stats').html('<i class="fas fa-spinner fa-spin"></i>');

            // Ajax request
            $.ajax({
                url: '<?= base_url('dashboard/getStatisticsByGrade') ?>/' + gradeId,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Response received:', response);

                    // Update statistik umum
                    $('#not-voted-count').text(response.statistics.not_voted || 0);
                    $('#voted-count').text(response.statistics.voted || 0);
                    $('#total-users').text(response.statistics.total_users || 0);

                    // Update statistik kandidat
                    updateCandidateStats(response.candidates);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', {
                        status: status,
                        error: error,
                        response: xhr.responseText
                    });

                    // Reset nilai
                    $('#not-voted-count, #voted-count, #total-users').text('0');
                    $('#candidate-stats').html('');
                    if (kandidatChart) {
                        kandidatChart.data.labels = [];
                        kandidatChart.data.datasets[0].data = [];
                        kandidatChart.update();
                    }

                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        });

        // Inisialisasi chart saat halaman dimuat
        initializeKandidatChart();
    });
</script>

<?= $this->endSection() ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>