<?php
include('koneksi/config.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   
    $id_transaksi = $_GET['id_transaksi'];

    // Query untuk menghapus detail transaksi
    $deleteDetailQuery = "DELETE FROM detail_transaksi WHERE id_transaksi = ?";
    
    $stmtDetail = $koneksi->prepare($deleteDetailQuery);
    $stmtDetail->bind_param("s", $id_transaksi);

    if ($stmtDetail->execute()) {
        // Query untuk menghapus transaksi
        $deleteTransaksiQuery = "DELETE FROM transaksi WHERE id_transaksi = ?";
        
        $stmtTransaksi = $koneksi->prepare($deleteTransaksiQuery);
        $stmtTransaksi->bind_param("s", $id_transaksi);

        if ($stmtTransaksi->execute()) {
            // Jika berhasil dihapus, redirect ke halaman transaksi
            header("Location: riwayat.php");
            exit();
        } else {
            // Jika gagal menghapus transaksi, tampilkan pesan error
            echo "Error deleting transaksi: " . $stmtTransaksi->error;
        }
    } else {
        // Jika gagal menghapus detail transaksi, tampilkan pesan error
        echo "Error deleting detail transaksi: " . $stmtDetail->error;
    }
}

$koneksi->close();
?>
