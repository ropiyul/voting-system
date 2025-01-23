<!-- View (admin/configuration/index.php) -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="section">
    <div class="section-header">
        <h1>Konfigurasi</h1>
    </div>

    <div class="section-body">
        <?= $this->include('auth/_message_block') ?>
        <div class="card">
            <form action="<?= base_url('configuration/update') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="oldLogo" value="<?= $config['logo'] ?? '' ?>">

                <div class="card-body">
                    <div class="row">
                        <!-- Nama -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>"
                                    value="<?= old('name', $config['name'] ?? '') ?>" required>
                                <div class="invalid-feedback">
                                    <?= session('errors.name') ?>
                                </div>
                            </div>
                        </div>

                        <!-- Logo -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="image-preview-filepond">
                                <div class="invalid-feedback">
                                    <?= session('errors.logo') ?>
                                </div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
                                    value="<?= old('email', $config['email'] ?? '') ?>" required>
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telepon</label>
                                <input type="text" name="phone" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>"
                                    value="<?= old('phone', $config['phone'] ?? '') ?>" required>
                                <div class="invalid-feedback">
                                    <?= session('errors.phone') ?>
                                </div>
                            </div>
                        </div>

                        <!-- Website -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Website</label>
                                <input type="url" name="website" class="form-control <?= session('errors.website') ? 'is-invalid' : '' ?>"
                                    value="<?= old('website', $config['website'] ?? '') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.website') ?>
                                </div>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="address" class="form-control <?= session('errors.address') ? 'is-invalid' : '' ?>"
                                    rows="3"><?= old('address', $config['address'] ?? '') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= session('errors.address') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan Konfigurasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- FilePond Plugins -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    // Register plugins
    FilePond.registerPlugin(
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview,
        FilePondPluginFilePoster
    );

    // Get existing file info
    const existingFile = '<?= $config['logo'] ?? '' ?>';
    const baseUrl = '<?= base_url() ?>';

    // Initialize FilePond
    const pond = FilePond.create(document.querySelector('.image-preview-filepond'), {
        allowImagePreview: true,
        allowFilePoster: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        maxFileSize: '5MB',
        storeAsFile: true,
        labelIdle: 'Seret & Lepas file atau <span class="filepond--label-action"> Pilih File </span>',

        // Konfigurasi file yang sudah ada
        files: existingFile ? [{
            // source adalah nama file
            source: existingFile,
            options: {
                type: 'local',
                // Informasi file
                file: {
                    name: existingFile,
                    size: 0,
                    type: 'image/png'
                },
                // Metadata untuk preview
                metadata: {
                    poster: `${baseUrl}/img/${existingFile}`
                }
            }
        }] : [],


        server: {
            load: (source, load, error, progress, abort, headers) => {
                // Create URL
                const url = `${baseUrl}/img/${source}`;

                // Fetch file
                fetch(url)
                    .then(response => response.blob())
                    .then(blob => {
                        load(blob);
                    })
                    .catch(err => {
                        console.error('Error loading file:', err);
                        error('Error loading file');
                    });

                return {
                    abort: () => {
                        abort();
                    }
                };
            }
        }
    });
</script>
<?= $this->endSection() ?>
