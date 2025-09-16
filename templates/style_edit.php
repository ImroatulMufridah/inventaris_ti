<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #4e7b56ff; 
        }

        h2 {
            color: #084127ff; /* hijau gelap */
        }

        .btn-primary {
            background-color: #084127ff;
            border-color: #084127ff;
        }

        .btn-primary:hover {
            background-color: #06351f;
            border-color: #06351f;
        }

        .btn-secondary {
            background-color: #c8e6c9;
            border-color: #084127ff;
            color: #084127ff;
        }

        .btn-secondary:hover {
            background-color: #a5d6a7;
            border-color: #06351f;
            color: white;
        }

        .form-control:focus {
            border-color: #084127ff;
            box-shadow: 0 0 0 0.2rem rgba(8, 65, 39, .25);
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(8, 65, 39, 0.2);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Barang</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Foto Barang</label><br>
                <?php if ($data['foto']) { ?>
                    <img src="uploads/<?= $data['foto'] ?>" width="100" class="mb-2 rounded"><br>
                <?php } ?>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>