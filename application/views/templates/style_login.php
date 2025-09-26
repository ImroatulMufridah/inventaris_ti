<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #4e7b56ff;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 380px;
            padding: 30px;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            font-weight: 600;
            color: #2c3e50;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4caf50;
        }

        .btn-success {
            background-color: #084127ff;
            border-color: #4caf50;
        }

        .btn-success:hover {
            background-color: #43a047;
            border-color: #43a047;
        }

        .alert {
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .login-card {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="login-card">
        <div class="text-center mb-4">
            <i class="bi bi-box-seam" style="font-size: 2.5rem; color: #4caf50;"></i>
            <h3 class="login-title mt-2">Login Inventaris</h3>
            <p class="text-muted" style="font-size: 0.9rem;">Masukkan username dan password Anda</p>
        </div>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-circle-fill me-2"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php } ?>

        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" name="login" class="btn btn-success w-100 mb-2">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
            </button>
        </form>

        <p class="text-center text-muted mt-3" style="font-size: 0.8rem;">© 2025 Sistem Inventaris</p>
    </div>

</body>