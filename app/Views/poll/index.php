<?= $this->extend('poll/main') ?>

<?= $this->section('content') ?>
<style>
    .search-input {
        width: 100%;
        max-width: 500px;
    }
</style>

<section class="container my-5 text-center">
    <div class="d-flex justify-content-center my-2">
        <input class="form-control me-2 rounded-pill search-input" type="search" placeholder="Cari Kandidat..."
            aria-label="Search">
    </div>
    <h1 class="display-4 fw-bold text-uppercase mb-4">Para Kandidat</h1>
    <div id="card-parent" class="row g-4">
        <?php foreach ($candidates as $candidate): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <img src="<?= base_url() . "img/" . $candidate["image"] ?>" class="img-fluid mt-1 pt-2 w-50 mx-auto"
                        alt="<?= $candidate["fullname"] ?>">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title"><?= $candidate["fullname"] ?></h5>
                        <button class="btn btn-primary vote-button" data-id="<?= $candidate['id'] ?>"
                            data-image="<?= base_url() . "img/" . $candidate["image"] ?>"
                            data-name="<?= $candidate["fullname"] ?>"
                            data-vision="<?= htmlspecialchars($candidate["vision"]) ?>"
                            data-mission="<?= htmlspecialchars($candidate["mission"]) ?>">
                            Vote
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Modals and Toast -->
<div class="modal fade" id="candidateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kandidat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <img id="modalImage" class="rounded img-fluid" alt="kandidat">
                    </div>
                    <div class="col-12 col-md-8">
                        <h5 id="modalName" class="fs-1"></h5>
                        <div>
                            <h6 class="fw-bold">Visi:</h6>
                            <p id="modalVision"></p>
                        </div>
                        <div>
                            <h6 class="fw-bold">Misi:</h6>
                            <div id="modalMission"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="voteButton" >Vote Sekarang</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <h5 class="fw-bold mb-3">Apakah yakin dengan pilihan Anda?</h5>
                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                    <button class="btn btn-primary" id="confirmVote">Ya</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="successToast" class="toast bg-success text-white">
        <div class="toast-body d-flex justify-content-between align-items-center">
            <span>Vote Telah Berhasil!</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let selectedCandidateId = null;
        const candidateModal = new bootstrap.Modal(document.getElementById('candidateModal'));
        const confirmationModal = new bootstrap.Modal(document.getElementById('konfirmasi'));
        const successToast = new bootstrap.Toast(document.getElementById('successToast'));

        document.querySelectorAll('.vote-button').forEach(button => {
            button.addEventListener('click', function (e) {
                selectedCandidateId = this.dataset.id;
                document.getElementById('modalImage').src = this.dataset.image;
                document.getElementById('modalName').textContent = this.dataset.name;
                document.getElementById('modalVision').textContent = this.dataset.vision;
                document.getElementById('modalMission').innerHTML = this.dataset.mission;
                candidateModal.show();
            });
        });

        document.getElementById('voteButton').addEventListener('click', function () {
            candidateModal.hide();
            confirmationModal.show();
        });

        document.getElementById('confirmVote').addEventListener('click', async function () {
            try {
                const formData = new FormData();
                formData.append('candidate_id', selectedCandidateId);

                const response = await fetch('<?= base_url('vote/save') ?>', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                confirmationModal.hide();

                if (result.success) {
                    successToast.show();
                    document.querySelectorAll('.vote-button').forEach(btn => btn.disabled = true);
                } else {
                    alert(result.message);
                }
            } catch (error) {
                console.log([error]);
            }
        });
    });
</script>
<?= $this->endSection() ?>