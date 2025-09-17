<?php
include "db_connect.php";

$search = isset($_GET['q']) ? $_GET['q'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'masuk'; // default barang masuk

$query = "SELECT id, nama_barang, jumlah 
          FROM barang 
          WHERE nama_barang LIKE '%" . mysqli_real_escape_string($conn, $search) . "%' 
          ORDER BY nama_barang ASC LIMIT 20";

$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    if ($type === 'keluar') {
        // tampilkan stok juga untuk barang keluar
        $text = $row['nama_barang'] . " (Stok: " . $row['jumlah'] . ")";
    } else {
        // barang masuk cukup nama
        $text = $row['nama_barang'];
    }

    $data[] = [
        "id" => $row['id'],
        "text" => $text
    ];
}

echo json_encode(["results" => $data]);
