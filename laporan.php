<?php
include "db_connect.php";

$result = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM barang"))['total'];
?>
<?php include "templates/style_laporan.php"; ?>

</html>