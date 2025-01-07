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
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Forms</a></div>
            <div class="breadcrumb-item">Edit Candidate</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <form action="<?= base_url('candidate/update/' . $candidate['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card-header">
                    <h4>Update Candidate Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Full Name Field -->
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['fullname']) ? 'is-invalid' : ''; ?>" name="fullname" value="<?= old('fullname', $candidate['fullname']) ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['fullname']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <!-- Username Field -->
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control <?= session('errors') && isset(session('errors')['username']) ? 'is-invalid' : ''; ?>" name="username" value="<?= old('username', $candidate['username']) ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['username']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="col-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control <?= session('errors') && isset(session('errors')['email']) ? 'is-invalid' : ''; ?>" name="email" value="<?= old('email', $candidate['email']) ?>">
                                <div class="invalid-feedback">
                                    <?= (session('errors')['email']) ?? null ?>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Image -->
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
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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
<script src="<?= base_url() ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>

<script>
    // Nonaktifkan auto-discovery Dropzone
    Dropzone.autoDiscover = false;

    // Inisialisasi Dropzone
    let myDropzone = new Dropzone("#myDropzone", {
        url: "<?= base_url('candidate/upload_temp') ?>", // URL untuk mengupload file
        method: "post", // HTTP method yang digunakan
        paramName: "file", // Nama parameter file yang dikirimkan
        maxFilesize: 2, // Maksimum ukuran file (dalam MB)
        acceptedFiles: "image/*", // Hanya menerima file gambar
        addRemoveLinks: true, // Menampilkan link untuk menghapus file
        dictRemoveFile: "Remove", // Pesan untuk link hapus
        maxFiles: 1, // Maksimum jumlah file yang bisa diupload
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // CSRF Token untuk keamanan
        },
        init: function() {
            const dropzone = this;
            const currentImage = '<?= $candidate['image'] ?? '' ?>'; // Ambil gambar yang sudah ada

          
            // Jika gambar sudah ada, tampilkan gambar tersebut
            if (currentImage) {
                // Membuat file tiruan (mock file)
                let mockFile = {
                    name: currentImage,
                    size: 12345 // Ukuran file (boleh disesuaikan)
                };

                // Emit event untuk menambahkan file
                dropzone.emit("addedfile", mockFile);

                // Buat thumbnail untuk file yang ada
                dropzone.emit("thumbnail", mockFile, `<?= base_url('img/') ?>${currentImage}`);

                // Tandai file sebagai diterima
                dropzone.emit("success", mockFile);
                dropzone.emit("complete", mockFile);

                // Simpan nama file di input tersembunyi
                document.getElementById('dropzone_image').value = currentImage;

                // Tambahkan mock file ke dalam daftar file
                dropzone.files.push(mockFile);
            }

            this.on("addedfile", function(file) {
                let dzMessage = this.element.querySelector(".dz-message");
                if (dzMessage) {
                    dzMessage.style.display = "none";
                }
            });

            // Event ketika file berhasil diupload
            this.on("success", function(file, response) {
                if (response.success) {
                    // Simpan nama file di input tersembunyi
                    document.getElementById('dropzone_image').value = response.filename;
                } else {
                    // Jika gagal upload, hapus file yang baru saja ditambahkan
                    this.removeFile(file);
                    alert('Upload failed: ' + response.error);
                }
            });

            // Event ketika melebihi batas file yang diizinkan
            this.on("maxfilesexceeded", function(file) {
                // Hapus semua file dan tambahkan file yang baru
                this.removeAllFiles();
                this.addFile(file);
            });

            // Event ketika file dihapus
            this.on("removedfile", function(file) {
                const fileName = document.getElementById('dropzone_image').value;
                document.getElementById('dropzone_image').value = '';
                // Hapus file temporary
                alert(fileName);
                fetch('<?= base_url('candidate/remove_temp') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    },
                    body: JSON.stringify({
                        filename: fileName
                    })
                });
            });
        }
    });

    // Handling pengiriman form
    document.querySelector('form').addEventListener('submit', function(e) {
        // Cek apakah file sudah diupload, jika belum tampilkan alert
        if (!document.getElementById('dropzone_image').value) {
            e.preventDefault();
            alert('Please upload an image');
        }
    });
</script>
<?= $this->endSection() ?>