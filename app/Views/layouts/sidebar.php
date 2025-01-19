<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">E-Voting</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Manajemen</li>
            <li><a class="nav-link" href="<?= base_url('admin') ?>"><i class="fas fa-users-cog"></i> <span>Admin</span></a></li>

            <li class="menu-header">Kandidat & Pemilih</li>
            <li><a class="nav-link" href="<?= base_url('candidate') ?>"><i class="fas fa-user"></i> <span>Kandidat</span></a></li>
            <li><a class="nav-link" href="<?= base_url('voter') ?>"><i class="fas fa-users"></i> <span>Pemilih</span></a></li>


            <!-- Menu Kelas dan Jurusan -->
            <li class="menu-header">Kelas </li>
            <li><a class="nav-link" href="<?= base_url('grade') ?>"><i class="fas fa-chalkboard-teacher"></i> <span>Kelas</span></a></li>


            <li class="menu-header">Logout</li>


            <li><a class="nav-link" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </aside>
</div>