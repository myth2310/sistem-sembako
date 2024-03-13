<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Item - Print</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
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

        // Fungsi untuk memformat harga menjadi format Rupiah
        function formatHarga($harga) {
            return 'Rp ' . number_format($harga, 0, ',', '.');
        }

        // Tutup koneksi database
        $koneksi->close();
        ?>

        <h1>Detail Item</h1>
        <table>
            <tr>
                <th>ID Item</th>
                <td><?php echo $row['id_item']; ?></td>
            </tr>
            <tr>
                <th>Nama Item</th>
                <td><?php echo $row['nama_item']; ?></td>
            </tr>
            <tr>
                <th>Jenis Satuan</th>
                <td><?php echo $row['jenis_satuan']; ?></td>
            </tr>
            <tr>
                <th>Jumlah Satuan</th>
                <td><?php echo $row['jumlah_satuan']; ?></td>
            </tr>
            <tr>
                <th>Isi Satuan</th>
                <td><?php echo $row['isi_satuan']; ?></td>
            </tr>
            <tr>
                <th>Harga Beli</th>
                <td><?php echo formatHarga($row['harga_beli']); ?></td>
            </tr>
            <tr>
                <th>Harga Jual</th>
                <td><?php echo formatHarga($row['harga_jual']); ?></td>
            </tr>
        </table>
    </div>

</body>

</html>
