<?= $this->extend('layouts/main'); ?>
<?= $this->section('main') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Edit pemilih</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('voter') ?>">Pemilih</a></div>
            <div class="breadcrumb-item">Edit pemilih</div>
        </div>

        <div class="section-body">


            <!-- <div class="row"> -->

            <div class="card">
                <form Action="<?= base_url('voter/update/' . $voter['id']) ?>" method="post">
                    <?php csrf_field() ?>
                    <input type="hidden" name="user_id" value="<?= $voter['user_id'] ?>" hidden>
                    <div class="card-header">
                        <h4>Form Edit pemilih</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control <?= session('errors') && isset(session('errors')['fullname']) ? 'is-invalid' : ''; ?>" name="fullname" value="<?= old('fullname', $voter['fullname']) ?>">
                                    <div class="invalid-feedback">
                                        <?= (session('errors')['fullname']) ?? null ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control <?= session('errors') && isset(session('errors')['username']) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username', $voter['username']) ?>">
                                    <div class="invalid-feedback">
                                        <?= (session('errors')['username']) ?? null ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select class="form-control <?= session('errors') && isset(session('errors')['grade_id']) ? 'is-invalid' : ''; ?>" name="grade_id" value="<?= old('grade_id', $voter['grade_id']) ?>">
                                        <?php foreach ($grades as $grade): ?>
                                            <option <?= $voter['grade_id'] == $grade['id']  ? 'selected' : '' ?> value="<?= $grade['id'] ?>"><?= $grade['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= (session('errors')['grade_id']) ?? null ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>


        </div>
</section>

<?= $this->endSection('content') ?>


<?= $this->endSection() ?>