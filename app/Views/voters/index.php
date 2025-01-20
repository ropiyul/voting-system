<?= $this->extend('layouts/main'); ?>


<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Table</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Table</h2>
        <p class="section-lead">Example of some Bootstrap table components.</p>
        <div class="row">
            <div class="col-12">
                <?= $this->include('auth/_message_block.php') ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Advanced Table</h4>
                        <div class="card-header-form">
                            <!-- <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form> -->
                            <form action="<?= base_url('voter/import_excel') ?>" method="post" enctype="multipart/form-data" style="display: inline;">
                                <?= csrf_field() ?>
                                <label for="excel_file" class="btn btn-success mr-2" style="cursor: pointer;">Import Excel</label>
                                <input type="file" name="excel_file" id="excel_file" accept=".xlsx" style="display: none;" required onchange="this.form.submit()">
                            </form>


                            <a href="<?= base_url('voter/export_excel') ?>" class="btn btn-success mr-2">Export Excel</a>
                            <a href="<?= base_url('voter/create') ?>" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($voters as $voter) : ?>
                                        <tr>
                                            <td>
                                                <?= $i++ ?>
                                            </td>
                                            <td><?= $voter["username"] ?></td>
                                            <td><?= $voter["fullname"] ?></td>
                                            <td><?= $voter["grade"] ?></td>
                                            <td>
                                                <form action="<?= base_url() ?>voter/delete/<?= $voter["user_id"] ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button class="btn btn-danger" type="submit">hapus</button>
                                                </form>
                                                <a href="<?= base_url("voter/edit/" . $voter['id']) ?>" class="btn btn-warning">edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>

<?= $this->endSection() ?>


<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/datatables.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url() ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?= base_url() ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="<?= base_url() ?>assets/js/page/modules-datatables.js"></script>
<?= $this->endSection() ?>