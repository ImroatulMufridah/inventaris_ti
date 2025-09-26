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
                <a href="<?php echo site_url('user'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>