<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya Admin yang bisa.'); window.location='index.php';</script>";
    exit;
}

include "db_connect.php";

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // enkripsi
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')");
    header("Location: user.php");
    exit;
}
include "templates/header.php";
include "templates/navbar.php";
include "templates/sidebar.php";
?>
<div class="content">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4 text-success">Tambah User</h3>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="user.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
<?php include "templates/footer.php"; ?>