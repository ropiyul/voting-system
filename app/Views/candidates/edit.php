<?= $this->extend('layouts/main'); ?>
<?= $this->section('main') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="section-header">
        <h1>Form Validation</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Form Validation</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Form Validation</h2>
        <p class="section-lead">
            Form validation using default from Bootstrap 4
        </p>

        <!-- <div class="row"> -->

        <div class="card">
            <form Action="<?= base_url('candidate/save') ?>" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <h4>Server-side Validation</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['name']) ? 'is-invalid' : ''; ?>" name="name" value="<?= old('name', $candidate['name']) ?>">
                                <div class="valid-feedback">
                                    <?= (session('errors')['name']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Visi</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['vision']) ? 'is-invalid' : ''; ?>" name="vision" value="<?= old('vision', $candidate['vision'])  ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['vision']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Misi</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['mission']) ? 'is-invalid' : ''; ?>" name="mission" value="<?= old('mission'), $candidate['mission']  ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['mission']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group mb-0">
                                <label for="image" class="form-label">Image</label>
                                <input class="form-control  <?= session('errors') && isset(session('errors')['image']) ? 'is-invalid' : ''; ?>" id="image" name="image" type="file" value="<?= old('image', $candidate['image']) ?>">
                                <div class="invalid-feedback" id="validationServerUsernameFeedback">
                                    <?= (session('errors')['image']) ?? null ?>
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