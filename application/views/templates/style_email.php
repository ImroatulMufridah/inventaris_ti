<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Email - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: #4e7b56ff; 
            font-family: 'Segoe UI', sans-serif; }
        .card { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        .btn-success { 
            background-color: #084127ff 
            !important; border-color: #084127ff !important; }
        .btn-success:hover { 
            background-color: #06341f 
            !important; border-color: #06341f !important; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <h3 class="mb-4 text-success">📧 Kirim Email</h3>
                    <?php if (!empty($alert)) echo $alert; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Email Tujuan</label>
                            <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subjek</label>
                            <input type="text" name="subject" class="form-control" value="Laporan Inventaris Barang" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" rows="5" class="form-control" placeholder="Tulis pesan di sini..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim Email</button>
                        <a href="<?= site_url('barang') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>