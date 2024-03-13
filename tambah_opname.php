<?php
// Pastikan file koneksi/config.php sudah di-include di sini
include('koneksi/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_item = $_POST['nama'];
    $stok_opname = $_POST['stok_opname'];

    // Query untuk mendapatkan id_item dari tabel item berdasarkan nama_item
    $query_get_id = "SELECT id_item, jumlah_satuan FROM item WHERE nama_item = '$nama_item'";
    $result_get_id = $koneksi->query($query_get_id);

    if ($result_get_id->num_rows > 0) {
        $row = $result_get_id->fetch_assoc();
        $id_item = $row['id_item'];
        $jumlah_satuan = $row['jumlah_satuan'];

        // Validasi deskripsi
        if ($stok_opname == $jumlah_satuan) {
            $deskripsi = "Benar";
        } elseif ($stok_opname < $jumlah_satuan) {
            $kurang = $jumlah_satuan - $stok_opname;
            $deskripsi = "Kurang $kurang";
        } else {
            $lebih = $stok_opname - $jumlah_satuan;
            $deskripsi = "Lebih $lebih";
        }

        // Tambahkan variabel untuk tanggal saat ini dengan format "hari bulan tahun"
        $tanggal = date('Y-m-d');

        // Simpan data ke dalam tabel opname, termasuk tanggal
        $query_simpan = "INSERT INTO opname (id_item, stok_opname, deskripsi, keterangan, tanggal) VALUES ('$id_item', '$stok_opname', '$deskripsi', 'Tulis Keterangan', '$tanggal')";
        if ($koneksi->query($query_simpan) === TRUE) {
            echo "Data berhasil disimpan.";
            // Redirect ke halaman opname.php
            header("Location: opname.php");
            exit(); // Pastikan untuk menghentikan eksekusi skrip setelah melakukan redirect
        } else {
            echo "Error: " . $query_simpan . "<br>" . $koneksi->error;
        }
    } else {
        echo "Nama item tidak ditemukan dalam database.";
    }

    // Tutup koneksi database
    $koneksi->close();
}
?>


<?php include('layout/head.php'); ?>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <?php include('layout/navbar.php'); ?>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <?php include('layout/sidebar.php'); ?>
            </div>

            <div id="app">
                <!-- Bagian Utama -->
                <div class="main-content">
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- Form Cek Stock Opname -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Cek Stock Opname</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="form-group">
                                                <label for="nama">Nama Item:</label>
                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="stok_opname">Stok Opname:</label>
                                                <input type="number" class="form-control" id="stok_opname" name="stok_opname" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cek Stok Opname</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- End Bagian Utama -->

            </div>

            <?php include('layout/js.php'); ?>
        </div>
    </div>
</body>

</html>
