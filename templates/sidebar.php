<!-- Layout -->
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <h4>Menu</h4>
            <a href="user.php" class="<?=($link!='' && $link=='user') ? 'active' : ''?>">User</a>
            <a href="index.php" class="<?=($link!='' && $link=='barang') ? 'active' : ''?>">Barang</a>
            <!-- <a href="tambah.php">Tambah Barang</a> -->
            <a href="laporan.php" class="<?=($link!='' && $link=='laporan') ? 'active' : ''?>">Laporan</a>
            <a href="kirim_email.php" class="<?=($link!='' && $link=='kirim_email') ? 'active' : ''?>">Kirim Email</a>
            <!-- <a href="user.php">User</a> -->
        </nav>