<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Item - Print</title>
</head>

<body>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

    <div>
        <?php
        include('koneksi/config.php');

        // Cek apakah parameter id_item tersedia di URL
        if (!isset($_GET['id_item'])) {
            echo "Parameter id_item tidak tersedia.";
            exit; // Hentikan eksekusi script
        }

        // Ambil id_item dari parameter GET
        $id_item = $_GET['id_item'];

        // Query untuk mendapatkan detail item dari database
        $query = "SELECT * FROM item WHERE id_item = '$id_item'";
        $result = $koneksi->query($query);

        // Periksa apakah query berhasil dieksekusi
        if (!$result) {
            echo "Gagal mengambil data item: " . $koneksi->error;
            exit; // Hentikan eksekusi script
        }

        // Periksa apakah ada data item yang ditemukan
        if ($result->num_rows === 0) {
            echo "Item tidak ditemukan.";
            exit; // Hentikan eksekusi script
        }

        // Ambil data item dari hasil query
        $row = $result->fetch_assoc();

        // Tampilkan detail item
        echo "<h1>Detail Item</h1>";
        echo "<p>ID Item: " . $row['id_item'] . "</p>";
        echo "<p>Nama Item: " . $row['nama_item'] . "</p>";
        echo "<p>Merk: " . $row['merk'] . "</p>";
        echo "<p>Jenis Satuan: " . $row['jenis_satuan'] . "</p>";
        echo "<p>Jumlah Satuan: " . $row['jumlah_satuan'] . "</p>";
        echo "<p>Isi Satuan: " . $row['isi_satuan'] . "</p>";
        echo "<p>Harga Beli: " . $row['harga_beli'] . "</p>";
        echo "<p>Harga Jual: " . $row['harga_jual'] . "</p>";

        // Tutup koneksi database
        $koneksi->close();
        ?>
    </div>

</body>

</html>