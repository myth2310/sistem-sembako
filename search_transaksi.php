<?php
include('koneksi/config.php');

// Ambil nilai pencarian dan sorting dari Ajax
$namaPelanggan = $_POST['namaPelanggan'];
$sorting = $_POST['sorting'];

// Query untuk mengambil data transaksi berdasarkan pencarian dan sorting
$query = "SELECT * FROM transaksi WHERE nama_pelanggan LIKE '%$namaPelanggan%' ORDER BY tanggal ";

if ($sorting == 'terlama') {
    $query .= "ASC";
} else {
    $query .= "DESC";
}

$result = $koneksi->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $no = 1;
        // Output data dari setiap baris
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['no_transaksi'] . "</td>";
            echo "<td>" . date('d F Y', strtotime($row['tanggal'])) . "</td>";
            echo "<td>" . $row['nama_pelanggan'] . "</td>";
            echo "<td>
                    <!-- Tombol aksi -->
                    <a class='btn btn-warning btn-sm px-4 mt-2' href='print_invoice_riwayat.php?id_transaksi=" . $row['id_transaksi'] . "'>Print</a>
                    <a class='btn btn-danger btn-sm px-4 mt-2' href='hapus_transaksi.php?id_transaksi=" . $row['id_transaksi'] . "'>Hapus</a>
                    <a class='btn btn-primary btn-sm px-4 mt-2' href='detail_transaksi.php?id_transaksi=" . $row['id_transaksi'] . "''>Detail</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Tidak ada data yang ditemukan.</td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>Error: " . $koneksi->error . "</td></tr>";
}

// Menutup koneksi database
$koneksi->close();
?>
