<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-outline-light me-2" id="toggleSidebar">☰</button>
        <a class="navbar-brand fw-bold" href="index.php">📦 Inventaris</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="kirim_email.php">Kirim Email</a></li>
            </ul>
           
            <div class="d-flex align-items-center ms-3">
                <span class="text-white me-3">
                    👤 <?= $_SESSION['username'] ?? 'Guest' ?>
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">🚪 Logout</a>
            </div>
        </div>
    </div>
</nav>
