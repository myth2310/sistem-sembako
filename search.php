<?php
// include file koneksi
include('koneksi/config.php');

if (isset($_POST['namaPelanggan'])) {
    $namaPelanggan = $_POST['namaPelanggan'];

    // Query untuk mendapatkan diskon berdasarkan nama pelanggan
    $query = "SELECT diskon FROM member WHERE nama = '$namaPelanggan'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row['diskon'];
        } else {
            echo '0';
        }
    } else {
        echo 'Error: ' . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>
