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
                            <div class="dropdown-menu dropdown-menu-right" style="max-height: 300px; overflow-y: auto; position: absolute !important;">
                                <div class="dropdown-title">Pilih Kelas</div>
                                <a href="javascript:void(0)"
                                    class="dropdown-item dropdown-grade <?= session()->get('selected_grade') == 'all' ? 'active' : '' ?>"
                                    data-grade="all">Semua Kelas</a>
                                <?php foreach ($grades as $grade): ?>
                                    <a href="javascript:void(0)"
                                        class="dropdown-item dropdown-grade <?= session()->get('selected_grade') == $grade['id'] ? 'active' : '' ?>"
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
                            <div class="card-stats-item-count text-success"><?= $statistics['voted_percentage'] ?>%</div>
                            <div class="card-stats-item-label">Tingkat Partisipasi</div>
                        </div>
                        <div class="card-stats-item text-center">
                            <div class="card-stats-item-count text-danger"><?= $statistics['not_voted_percentage'] ?>%</div>
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
        <!-- <h2 class="section-title">Chart.js</h2>
        <p class="section-lead">
            We use 'Chart.JS' made by @chartjs. You can check the full documentation <a
                href="http://www.chartjs.org/">here</a>.
        </p> -->

        <div class="row">
            <div class="col-12 col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Statistik kandidat</h4>
                        <div class="dropdown">
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="selected-class">
                                <?= session()->get('selected_grade') === 'all' ? 'Semua Kelas' : (isset($grades[session()->get('selected_grade') - 1]) ?
                                    $grades[session()->get(key: 'selected_grade') - 1]['name'] : 'Pilih Kelas') ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="max-height: 300px; overflow-y: auto; position: absolute !important;">
                                <div class="dropdown-title">Pilih Kelas</div>
                                <a href="javascript:void(0)"
                                    class="dropdown-candidate dropdown-item <?= session()->get('selected_grade') == 'all' ? 'active' : '' ?>"
                                    data-grade="all">Semua Kelas</a>
                                <?php foreach ($grades as $grade): ?>
                                    <a href="javascript:void(0)"
                                        class="dropdown-candidate dropdown-item <?= session()->get('selected_grade') == $grade['id'] ? 'active' : '' ?>"
                                        data-grade="<?= $grade['id'] ?>">
                                        <?= $grade['name'] ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="kandidatChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card gradient-bottom">
                    <div class="card-header">
                        <h4>Top 5 Products</h4>
                        <div class="card-header-action dropdown">
                            <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                            <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <li class="dropdown-title">Select Period</li>
                                <li><a href="#" class="dropdown-item">Today</a></li>
                                <li><a href="#" class="dropdown-item">Week</a></li>
                                <li><a href="#" class="dropdown-item active">Month</a></li>
                                <li><a href="#" class="dropdown-item">This Year</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body" id="top-5-scroll">
                        <ul class="list-unstyled list-unstyled-border">
                            <?php foreach ($candidates as $candidate): ?>
                                <li class="media">
                                    <img class="mr-3 rounded" width="55" src="<?= base_url('img/') . $candidate['image'] ?>" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">86 Sales</div>
                                        </div>
                                        <div class="media-title"><?= $candidate['fullname'] ?></div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary" data-width="64%"></div>
                                                <div class="budget-price-label">$68,714</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger" data-width="43%"></div>
                                                <div class="budget-price-label">$38,700</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer pt-3 d-flex justify-content-center">
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-primary" data-width="20"></div>
                            <div class="budget-price-label">Selling Price</div>
                        </div>
                        <div class="budget-price justify-content-center">
                            <div class="budget-price-square bg-danger" data-width="20"></div>
                            <div class="budget-price-label">Budget Price</div>
                        </div>
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
                        <canvas id="bulat"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Pie Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="donat"></canvas>
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
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Statistics',
                        data: [],
                        borderWidth: 2,
                        backgroundColor: '#6777ef',
                        borderColor: '#6777ef',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#ffffff',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                                color: '#f2f2f2',
                            },
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                display: false
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
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
            // let html = '';
            // candidates.forEach(candidate => {
            //     html += `
            //     <div class="statistic-details-item">
            //         <div class="text-small text-muted">
            //             ${candidate.percentage || 0}% <!-- Default to 0 if undefined -->
            //         </div>
            //         <div class="detail-value">${candidate.vote_count}</div>
            //         <div class="detail-name">${candidate.name}</div>
            //     </div>
            // `;
            // });
            // $('#candidate-stats').html(html);
            // console.log('Candidate stats updated in the DOM.');
        }

        // Handle dropdown kelas
        $('.dropdown-grade').click(function(e) {
            e.preventDefault();
            console.log('Dropdown grade clicked.');

            $('#selected-class').text($(this).text());
            $('.dropdown-grade').removeClass('active');
            $(this).addClass('active');

            let gradeId = $(this).data('grade');

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
        updateCandidateStats(<?= json_encode($allCount)?>);


        var ctx = document.getElementById("bulat").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        <?= $statistics['voted_percentage'] ?>,
                        <?= $statistics['not_voted_percentage'] ?>,

                    ],
                    backgroundColor: [
                        '#ffa426',
                        '#fc544b',

                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Sudah vote',
                    'Belum vote',
                ],
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index];
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return label + ': ' + value + '%';
                        }
                    }
                }
            }
        });


        $('.dropdown-candidate').click(function(e) {
            e.preventDefault();

            $('#selected-class2').text($(this).text());
            $('.dropdown-candidate').removeClass('active');
            $(this).addClass('active');

            let gradeId = $(this).data('grade');

            // Ajax request
            $.ajax({
                url: '<?= base_url('dashboard/getStatisticsByGrade') ?>/' + gradeId,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
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

    });


    var ctx = document.getElementById("donat").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    80,
                    50,
                    40,
                    30,
                    20,
                ],
                backgroundColor: [
                    '#191d21',
                    '#63ed7a',
                    '#ffa426',
                    '#fc544b',
                    '#6777ef',
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Black',
                'Green',
                'Yellow',
                'Red',
                'Blue'
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
        }
    });
</script>

<?= $this->endSection() ?>

<?= $this->section('style') ?>
<style>
    .dropdown-menu {
        max-height: 250px;
        overflow-y: auto;
        min-width: 180px;
    }

    .dropdown-item {
        padding: 0.5rem 1.25rem;
        white-space: nowrap;
    }

    .dropdown-menu::-webkit-scrollbar {
        width: 4px;
    }

    .dropdown-menu::-webkit-scrollbar-thumb {
        background: #6777ef;
        border-radius: 4px;
    }
</style>
<?= $this->endSection() ?>