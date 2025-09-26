<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-outline-light me-2" id="toggleSidebar">☰</button>
    <a class="navbar-brand fw-bold" href="<?= site_url('barang') ?>">📦 Inventaris</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <!-- <li class="nav-item"><a class="nav-link active" href="<?= site_url('barang') ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('laporan') ?>">Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('kirim_email') ?>">Kirim Email</a></li> -->
            </ul>
           
            <div class="d-flex align-items-center ms-3">
                <span class="text-white me-3">
                    👤 <?php echo $this->session->userdata('username') ?? 'Guest'; ?>
                </span>
                <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm">🚪 Logout</a>
            </div>
        </div>
    </div>
</nav>
