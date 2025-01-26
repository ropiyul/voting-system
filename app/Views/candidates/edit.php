<?= $this->extend('layouts/main'); ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/codemirror/theme/duotone-dark.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/jquery-selectric/selectric.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/dropzonejs/dropzone.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/toastify/toastify.css">
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet" />

<style>
    .dropzone {
        min-height: 150px !important;
        border: 2px dashed #ddd !important;
        border-radius: 5px;
        padding: 10px !important;
    }

    /* Custom styles for the Dropzone */
    .dropzone .dz-message {
        margin: 2em 0 !important;
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Edit Candidate</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?= base_url('dashboard') ?>">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="<?= base_url('candidate') ?>">kandidat</a></div>
            <div class="breadcrumb-item">Edit Candidate</div>
        </div>
    </div>

    <div class="section-body">
        <?= $this->include('auth/_message_block.php') ?>
        <div class="card">
            <form action="<?= base_url('candidate/update/' . $candidate['id']) ?>" method="post"
                enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="oldImage" value="<?= $candidate['image'] ?>">
                <div class="card-header">
                    <h4>Update Candidate Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Full Name Field -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control <?= session('errors') && isset(session('errors')['fullname']) ? 'is-invalid' : ''; ?>"
                                    name="fullname" value="<?= old('fullname', $candidate['fullname']) ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['fullname']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <!-- Username Field -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text"
                                    class="form-control <?= session('errors') && isset(session('errors')['username']) ? 'is-invalid' : ''; ?>"
                                    name="username" value="<?= old('username', $candidate['username']) ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['username']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <!--  visi -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="vision">Visi</label>
                                <textarea class="form-control summernote" id="vision-summernote" name="vision"
                                    required><?= old('vision') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['vision']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <!-- misi -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="mission">Misi</label>
                                <textarea class="form-control summernote" id="mission-summernote" name="mission"
                                    value="alalal" required><?= old('mission') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['mission']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nomor Urut</label>
                                <select class="form-control <?= session('errors') && isset(session('errors')['candidate_order']) ? 'is-invalid' : ''; ?>"
                                    name="candidate_order">
                                    <?php
                                    // Loop nomor urut dari 1 sampai 30
                                    for ($i = 1; $i <= 30; $i++):
                                        $formatted_order = str_pad($i, 2, '0', STR_PAD_LEFT); // Format nomor urut jadi 2 digit
                                        $is_selected = ($candidate['candidate_order'] === $formatted_order) ? 'selected' : ''; // Cek jika nomor urut sama dengan yang ada di database
                                        $is_disabled = (in_array($formatted_order, $used_numbers) && $is_selected === '') ? 'disabled' : ''; // Disabled jika nomor urut sudah terpakai
                                    ?>
                                        <option value="<?= $formatted_order ?>" <?= $is_selected ?> <?= $is_disabled ?>>
                                            <?= $formatted_order ?> <?= ($is_disabled === 'disabled') ? '(Terpakai)' : '' ?>
                                        </option>
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
                                    name="grade_id" value="<?= old('grade_id', $candidate['grade_id']) ?>">
                                    <?php foreach ($grades as $grade): ?>
                                        <option <?= $candidate['grade_id'] == $grade['id'] ? 'selected' : '' ?>
                                            value="<?= $grade['id'] ?>"><?= $grade['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['grade_id']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Image -->
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Upload Gambar</label>
                                <input type="file" name="image" id="image"
                                    class="image-preview-filepond is-invalid image">
                                <div class="invalid-feedback">
                                    <?= "rararara" ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a class="btn btn-danger" href="<?= base_url('candidate') ?>">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>

        <!-- ganti pw -->
        <div class="card">
            <div class="card-header">
                <h4>Ganti Password</h4>
                <div class="card-header-action">
                    <a data-collapse="#password-form" class="btn btn-icon btn-info" href="#"><i
                            class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="collapse" id="password-form">
                <form action="<?= base_url('candidate/updatePassword/' . $candidate['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_id" value="<?= $candidate['user_id'] ?>" hidden>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password"
                                        class="form-control <?= session('errors') && isset(session('errors')['password']) ? 'is-invalid' : ''; ?>"
                                        name="password">
                                    <div class="invalid-feedback">
                                        <?= session('errors')['password'] ?? null ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control <?= session('errors') && isset(session('errors')['password_confirm']) ? 'is-invalid' : ''; ?>"
                                        name="password_confirm">
                                    <div class="invalid-feedback">
                                        <?= session('errors')['password_confirm'] ?? null ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-warning">Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url() ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?= base_url() ?>assets/modules/codemirror/lib/codemirror.js"></script>
<script src="<?= base_url() ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
<script src="<?= base_url() ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?= base_url() ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
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
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>

<script src="<?= base_url() ?>assets/modules/toastify/toastify.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    console.log("<?= old('mission', $candidate['mission']) ?>             <?= $candidate['mission'] ?>")

    // Register plugins yang diperlukan untuk preview
    FilePond.registerPlugin(
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
        FilePondPluginImagePreview,
        FilePondPluginFilePoster,
        FilePondPluginImageExifOrientation,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageFilter
    );


    const imageUrl = '<?= base_url('img/' . $candidate['image']) ?>';
    console.log('Image URL:', imageUrl);


    const pond = FilePond.create(document.querySelector('.image'), {
        allowImagePreview: true,
        allowFilePoster: true,
        allowImageFilter: false,
        allowImageExifOrientation: false,
        allowImageCrop: false,
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],


        files: [{
            source: '<?= $candidate['image'] ?>',
            options: {
                type: 'local',
                metadata: {
                    poster: imageUrl
                },
                file: {
                    name: '<?= $candidate['image'] ?>',
                    size: 0,
                    type: 'image/png'
                }
            }
        }],
        acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "application/pdf"],
        fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                resolve(type)
            }),
        storeAsFile: true,
    })
    $('.summernote').summernote({
        toolbar: [
            ['para', ['ul', 'ol']]
        ]
    });
    $("#vision-summernote").summernote("code", '<?= htmlspecialchars_decode(old('vision', $candidate['vision'])) ?>');
    $("#mission-summernote").summernote("code", "<?= htmlspecialchars_decode(old('mission', $candidate['mission'])) ?>");
</script>
<?= $this->endSection() ?>