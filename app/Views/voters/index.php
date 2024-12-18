<?= $this->extend('layouts/main'); ?>
<?= $this->section('main') ?>

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
                            <a href="<?= base_url('voter/create') ?>" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <!-- <th>Visi</th>
                                    <th>Misi</th> -->
                                    <th>Action</th>
                                </tr>
                                <?php $i = 1; ?>
                                <?php foreach ($voters as $voter) : ?>
                                    <tr>
                                        <td>
                                            <?= $i++ ?>
                                        </td>
                                        <td class="align-middle">
                                            <?= $voter["nis"] ?>
                                        </td>
                                        <td><?= $voter["fullname"] ?></td>
                                        <td>
                                            <form action="<?= base_url() ?>voter/delete/<?= $voter["user_id"] ?>" method="post" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger" type="submit">hapus</button>
                                            </form>
                                            <a href="<?= base_url("voter/edit/" . $voter['id']) ?>" class="btn btn-warning">edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->endSection() ?>