<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    /* Atur posisi untuk ul */
    .dropdown-list {
        position: absolute;
        bottom: -70px;
        /* Geser ke bawah tombol */
        right: 0;
        background-color: white;
        /* Tambahkan latar belakang */
        border: 1px solid #ddd;
        /* Tambahkan border */
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        display: none;
        /* Sembunyikan awalnya */
        z-index: 10;
        min-width: 150px;
        /* Lebar minimum dropdown */
    }

    .dropdown-list {
        margin-left: .5rem;
        list-style: none;
        padding: 10px;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-list:hover {
        background-color: #f0f0f0;
        /* Efek hover */
    }

    .dropdown-container {
        position: relative;
        /* Wajib untuk kontrol posisi */
    }
</style>

<body>
    <!-- Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="<?= base_url() ?>assets/img/logo.png" alt="Logo" class="rounded-circle" style="height: 50px;">
                <span class="d-none d-sm-block fw-bold">SMKN 2 KUNINGAN</span>
            </a>
            <form class="d-flex ms-auto align-items-center">
                <div class="dropdown-container">
                    <button id="dropdownButton" class="btn btn-outline-light rounded-pill" type="button">
                        <img id="profileBtn" src="<?= base_url() ?>assets/img/profile.svg" alt="search-icon"
                            style="width: 20px;">
                    </button>
                    <ul id="dropdownList" class="dropdown-list">
                        <li>Logout</li>
                    </ul>
                </div>
            </form>
        </div>
    </nav>
    <script>
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownList = document.getElementById('dropdownList');

        dropdownButton.addEventListener('click', () => {
            // Toggle visibility
            const isVisible = dropdownList.style.display === 'block';
            dropdownList.style.display = isVisible ? 'none' : 'block';
        });

        // Klik di luar dropdown untuk menutupnya
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownList.contains(event.target)) {
                dropdownList.style.display = 'none';
            }
        });
    </script>

    <?= $this->renderSection('content') ?>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/popper.js"></script>
    <script src="<?= base_url() ?>assets/modules/tooltip.js"></script>
    <script src="<?= base_url() ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>assets/modules/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/stisla.js"></script>
    <?= $this->renderSection("script") ?>
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="<?= base_url() ?>assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>assets/js/custom.js"></script>
</body>

</html>