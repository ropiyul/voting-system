<?= $this->extend('layouts/main'); ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/codemirror/theme/duotone-dark.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/jquery-selectric/selectric.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/toastify/toastify.css">
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Tambah kandidat</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('candidate') ?>">kandidat</a></div>
            <div class="breadcrumb-item">Tambah kandidat</div>
        </div>
    </div>

    <div class="section-body">

        <?= $this->include('auth/_message_block.php') ?>
        <div class="card">
            <form action="<?= base_url('candidate/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-header">
                    <h4>Form Tambah kandidat</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control <?= session('errors') && isset(session('errors')['fullname']) ? 'is-invalid' : ''; ?>"
                                    name="fullname" value="<?= old('fullname') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['fullname']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text"
                                    class="form-control <?= session('errors') && isset(session('errors')['username']) ? 'is-invalid' : ''; ?>"
                                    name="username" value="<?= old('username') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['username']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nomer urut</label>
                                <select
                                    class="form-control <?= session('errors') && isset(session('errors')['candidate_order']) ? 'is-invalid' : ''; ?>"
                                    name="candidate_order" value="<?= old('candidate_order') ?>">
                                    <?php
                                    // Ambil nomor urut yang sudah terpakai
                                    for ($i = 1; $i <= 30; $i++):
                                        // Menyaring nomor urut yang sudah terpakai
                                        if (in_array($i, $used_numbers)): ?>
                                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" disabled><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?> (Terpakai)</option>
                                        <?php else: ?>
                                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></option>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['candidate_order']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select
                                    class="form-control <?= session('errors') && isset(session('errors')['grade_id']) ? 'is-invalid' : ''; ?>"
                                    name="grade_id" value="<?= old('grade_id') ?>">
                                    <?php foreach ($grades as $grade): ?>
                                        <option value="<?= $grade['id'] ?>"><?= $grade['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['grade_id']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                    class="form-control <?= session('errors') && isset(session('errors')['password']) ? 'is-invalid' : ''; ?>"
                                    name="password" value="<?= old('password') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['password']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Ulang Password</label>
                                <input type="password"
                                    class="form-control <?= session('errors') && isset(session('errors')['pass_confirm']) ? 'is-invalid' : ''; ?>"
                                    name="pass_confirm" value="<?= old('pass_confirm') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['pass_confirm']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="vision">Visi</label>
                                <textarea class="form-control summernote" id="vision-summernote"
                                    name="vision"><?= old('vision') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['vision']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="mission">Misi</label>
                                <textarea class="form-control summernote" id="mission-summernote"
                                    name="mission"><?= old('mission') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['mission']) ?? null ?>
                                </div>
                            </div>
                        </div>  
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Upload Gambar</label>
                                <input type="file" name="image" id="image" class="image-preview-filepond image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a class="btn btn-danger" href="<?= base_url('candidate') ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- JS Libraries -->
<script src="<?= base_url() ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?= base_url() ?>assets/modules/codemirror/lib/codemirror.js"></script>
<script src="<?= base_url() ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
<script src="<?= base_url() ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?= base_url() ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="<?= base_url() ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>
<script src="<?= base_url() ?>assets/modules/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= base_url() ?>assets/modules/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- filepond validation -->
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>

<!-- image editor -->
<script
    src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-filter/dist/filepond-plugin-image-filter.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>

<script src="<?= base_url() ?>assets/modules/toastify/toastify.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    FilePond.registerPlugin(
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
        FilePondPluginImageCrop,
        FilePondPluginImagePreview
    );


    // Filepond:
    FilePond.create(document.querySelector(".image"), {
        credits: null,
        allowImagePreview: true,
        allowMultiple: false,
        allowFileEncode: false,
        required: false,
        acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "application/pdf"],
        fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                // Do custom type detection here and return with promise
                resolve(type)
            }),
        storeAsFile: true,
    })
    // Initialize Summernote with minimal toolbar
    $('.summernote').summernote({
        toolbar: [
            ['para', ['ul', 'ol']]
        ]
    });
    $("#vision-summernote").summernote("code", '<?= htmlspecialchars_decode(old('vision')) ?>');
    $("#mission-summernote").summernote("code", "<?= htmlspecialchars_decode(old('mission')) ?>");



    //   /*   server: {
    //         process: '<?= base_url('candidate/upload_temp') ?>',
    //         revert: (uniqueFileId, load, error) => {
    //             handleFileRevert(uniqueFileId, load, error);
    //         },
    //         headers: {
    //             'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
    //         }
    //     }
    // };


    // const handleFileRevert = (uniqueFileId, load, error) => {
    //     fetch('<?= base_url('candidate/remove_temp') ?>', {
    //             method: 'DELETE',
    //             headers: {
    //                 'X-CSRF-TOKEN': '<?= csrf_hash() ?>',
    //                 'Content-Type': 'application/json'
    //             },
    //             body: JSON.stringify({
    //                 filename: uniqueFileId
    //             })
    //         })
    //         .then(response => {
    //             if (response.ok) {
    //                 load();
    //             } else {
    //                 throw new Error('Failed to delete file');
    //             }
    //         })
    //         .catch(err => {
    //             console.error('Error:', err);
    //             error('Network error occurred');
    //         });
    // };


    // const pond = FilePond.create(document.querySelector('input[type="file"]'), pondConfig);




    // pond.on('error', error => {
    //     console.error('FilePond error:', error);
    // });

    // pond.on('processfile', (error, file) => {
    //     if (error) {
    //         console.error('File processing error:', error);
    //         return;
    //     }
    //     console.log('File processed successfully:', file.filename);
    // }); */
</script>
<?= $this->endSection() ?>