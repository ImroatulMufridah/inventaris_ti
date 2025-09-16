<?php
include "db_connect.php";

// Ambil data barang
$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Inventaris Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* --- Global --- */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
        }

        .wrapper {
            display: flex;
            flex: 1;
            transition: all 0.3s ease;
        }

        /* --- Sidebar --- */
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background: linear-gradient(180deg, #084127ff, #06341f);
            color: #fff;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 0;
            min-width: 0;
        }

        .sidebar h4 {
            text-align: left;
            padding: 20px;
            margin: 0;
            font-size: 1.2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.25);
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            font-size: 0.95rem;
            border-radius: 6px;
            margin: 4px 10px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        /* --- Content --- */
        .content {
            flex: 1;
            padding: 25px;
            transition: margin-left 0.3s ease;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card-body {
            padding: 25px;
        }

        /* --- Tabel --- */
        table th,
        table td {
            vertical-align: middle;
        }

        /* Warna header tabel */
        .table-custom thead {
            background: #084127ff;
            color: #fff;
        }

        /* --- Footer --- */
        footer {
            background: #084127ff;
            color: #fff;
            padding: 12px;
            text-align: center;
            font-size: 0.9rem;
        }

        /* --- Responsif Sidebar --- */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                z-index: 999;
                height: 100%;
                left: -220px;
            }

            .sidebar.collapsed {
                left: 0;
            }
        }

        /* Override Bootstrap */
        .bg-success {
            background-color: #084127ff !important;
        }

        .text-success {
            color: #084127ff !important;
        }

        .btn-success {
            background-color: #084127ff !important;
            border-color: #084127ff !important;
        }

        .btn-success:hover {
            background-color: #06341f !important;
            border-color: #06341f !important;
        }

        .table-success {
            background-color: #084127ff !important;
            color: #fff !important;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container-fluid">
            <button class="btn btn-outline-light me-2" id="toggleSidebar">☰</button>
            <a class="navbar-brand fw-bold" href="index.php">📦 Inventaris</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="form_email.php">Kirim Email</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Layout -->
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <h4>Menu</h4>
            <a href="index.php">Daftar Barang</a>
            <a href="tambah.php">Tambah Barang</a>
            <a href="laporan.php">Laporan</a>
            <a href="form_email.php">Kirim Email</a>
        </nav>

        <!-- Content -->
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4 text-success">Daftar Barang</h3>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="tambah.php" class="btn btn-success">+ Tambah Barang</a>
                        <a href="form_email.php" class="btn btn-outline-success">📧 Kirim Email</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle table-custom">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                                        <td class="text-center"><?= (int) $row['jumlah'] ?></td>
                                        <td class="text-center">
                                            <?php if (!empty($row['foto'])) { ?>
                                                <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" width="80" height="60"
                                                    class="img-thumbnail" style="object-fit:cover;" alt="Foto Barang">
                                            <?php } else { ?>
                                                <span class="text-muted">-</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">✏
                                                Edit</a>
                                            <a href="hapus.php?id=<?= $row['id'] ?>"
                                                onclick="return confirm('Yakin hapus data ini?')"
                                                class="btn btn-sm btn-danger">🗑 Hapus</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <small>&copy; <?= date("Y") ?> Inventaris Barang</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.getElementById("sidebar");

        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("collapsed");
        });
    </script>
</body>

</html>