<?= $this->extend('layouts/main'); ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/summernote/summernote-bs4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/codemirror/theme/duotone-dark.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/jquery-selectric/selectric.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/modules/dropzonejs/dropzone.css">
<style>
    .dropzone {
        min-height: 150px !important;
        border: 2px dashed #ddd !important;
        border-radius: 5px;
        padding: 10px !important;
    }

    /* Hide all default dropzone elements */
    .dropzone .dz-preview .dz-details,
    .dropzone .dz-preview .dz-progress,
    .dropzone .dz-preview .dz-error-message,
    .dropzone .dz-preview .dz-success-mark,
    .dropzone .dz-preview .dz-error-mark {
        display: none !important;
    }

    /* Style for image preview only */
    .dropzone .dz-preview {
        min-height: 80px !important;
        margin: 8px !important;
    }

    .dropzone .dz-preview .dz-image {
        width: 120px !important;
        height: 120px !important;
        border-radius: 4px !important;
    }

    /* Hide remove link text, show only icon */
    .dropzone .dz-preview .dz-remove {
        position: absolute;
        top: -10px;
        right: -10px;
        z-index: 10;
        width: 20px;
        height: 20px;
        line-height: 20px;
        background-color: #fff;
        border-radius: 50%;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 0;
        /* Hide text */
    }

    .dropzone .dz-preview .dz-remove:before {
        content: "×";
        font-size: 16px;
        color: #dc3545;
    }

    /* Center initial message */
    .dropzone .dz-message {
        margin: 2em 0 !important;
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

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

        <div class="card">
            <form action="<?= base_url('candidate/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-header">
                    <h4>Server-side Validation</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['fullname']) ? 'is-invalid' : ''; ?>" name="fullname" value="<?= old('fullname') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['fullname']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['username']) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['username']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control <?= session('errors') && isset(session('errors')['email']) ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['email']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Visi</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['vision']) ? 'is-invalid' : ''; ?>" name="vision" value="<?= old('vision') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['vision']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control <?= session('errors') && isset(session('errors')['grade_id']) ? 'is-invalid' : ''; ?>" name="grade_id" value="<?= old('grade_id') ?>">
                                    <?php foreach ($grades as $grade): ?>
                                        <option value="<?= $grade['id'] ?>"><?= $grade['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['grade_id']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control <?= session('errors') && isset(session('errors')['password']) ? 'is-invalid' : ''; ?>" name="password" value="<?= old('password') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['password']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Ulang Password</label>
                                <input type="password" class="form-control <?= session('errors') && isset(session('errors')['pass_confirm']) ? 'is-invalid' : ''; ?>" name="pass_confirm" value="<?= old('pass_confirm') ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['pass_confirm']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="mission">Misi</label>
                                <textarea class="form-control summernote" id="mission" name="mission" required><?= old('mission') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= (session('errors')['mission']) ?? null ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Upload Gambar</label>
                                <div class="dropzone" id="myDropzone">
                                    <div class="dz-message">
                                        <h3>Drop gambar atau klik untuk upload</h3>
                                    </div>
                                </div>
                                <input type="hidden" name="dropzone_image" id="dropzone_image" required>
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- JS Libraries -->
<script src="<?= base_url() ?>assets/modules/summernote/summernote-bs4.js"></script>
<script src="<?= base_url() ?>assets/modules/codemirror/lib/codemirror.js"></script>
<script src="<?= base_url() ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
<script src="<?= base_url() ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
<script src="<?= base_url() ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
<script src="<?= base_url() ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>

<script>
    // Summernote initialization
    $('.summernote').summernote({
        toolbar: [
            ['para', ['ul', 'ol']]
        ]
    });


    Dropzone.autoDiscover = false; // Disable auto-discovery
    const myDropzone = new Dropzone("#myDropzone", {
        url: "<?= base_url('candidate/upload_temp') ?>", // Endpoint sementara untuk upload
        method: "post",
        paramName: "file",
        maxFilesize: 2,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        dictRemoveFile: "",
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        maxFiles: 1,

        thumbnailWidth: 120,
        thumbnailHeight: 120,
        previewsContainer: "#myDropzone",
        dictDefaultMessage: "Drop gambar atau klik untuk upload",
        init: function() {

            this.on("addedfile", function(file) {
                let dzMessage = this.element.querySelector(".dz-message");
                if (dzMessage) {
                    dzMessage.style.display = "none";
                }
            });

            this.on("success", function(file, response) {
                // Simpan nama file ke input hidden
                document.getElementById('dropzone_image').value = response.filename;
            });

            this.on("removedfile", function(file) {
                const fileName = document.getElementById('dropzone_image').value;
                document.getElementById('dropzone_image').value = '';
                // Hapus file temporary
                alert(fileName);
                fetch('<?= base_url('candidate/remove_temp') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        filename: fileName
                    })
                });
            });

            this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
            });
        }
    });
</script>
<?= $this->endSection() ?>