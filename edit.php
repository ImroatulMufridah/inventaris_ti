<?php
include "db_connect.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_barang'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($conn, "UPDATE barang SET 
        nama_barang='$nama', jumlah='$jumlah'
        WHERE id=$id");
    header("Location: index.php");
    exit;
}
?>
<?php include "templates/style_edit.php"; ?>

</html>