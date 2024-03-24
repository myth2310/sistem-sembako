<?php
// Include file koneksi
include 'koneksi/config.php';

// Query untuk mengambil nama dari tabel sales
$query = "SELECT nama FROM sales";
$result = mysqli_query($koneksi, $query);

// Buat array untuk menyimpan nama sales
$sales = array();

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Tambahkan setiap nama sales ke dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row;
    }
}

// Tutup koneksi database
mysqli_close($koneksi);

// Kembalikan hasil dalam format JSON
echo json_encode($sales);
