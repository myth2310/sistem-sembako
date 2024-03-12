<?php
// Masukkan koneksi ke database di sini jika belum dimasukkan
include('koneksi/config.php');

// Inisialisasi variabel
$nama_item = "";
$stok_opname = "";
$deskripsi = "";
$keterangan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data dari form
    $nama_item = $_POST['nama'];
    $stok_opname = $_POST['stok_opname'];

    // Query untuk mendapatkan data jumlah_satuan berdasarkan nama item
    $query = "SELECT jumlah_satuan FROM item WHERE nama_item = '$nama_item'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $jumlah_satuan = $row['jumlah_satuan'];

        // Menentukan deskripsi
        if ($stok_opname == $jumlah_satuan) {
            $deskripsi = "Benar";
        } elseif ($stok_opname < $jumlah_satuan) {
            $kurang = $jumlah_satuan - $stok_opname;
            $deskripsi = "Kurang $kurang";
        } else {
            $lebih = $stok_opname - $jumlah_satuan;
            $deskripsi = "Lebih $lebih";
        }

        // Set keterangan sesuai kebutuhan Anda
        $keterangan = $_POST['keterangan'];
    } else {
        // Item tidak ditemukan
        $deskripsi = "Item tidak ditemukan";
    }
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

                                <!-- Tabel Items -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Stock Opname</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="tambah_opname.php" class="btn btn-primary mb-3">Tambah</a>
                                        <div class="table-responsive">
                                            <!-- Tabel Stock Opname -->
                                            <table class="table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Item</th>
                                                        <th>Stok Opname</th>
                                                        <th>Deskripsi</th>
                                                        <th>Keterangan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><?php echo $nama_item; ?></td>
                                                            <td><?php echo $stok_opname; ?></td>
                                                            <td><?php echo $deskripsi; ?></td>
                                                            <td><?php echo $keterangan; ?></td>
                                                            <td>
                                                                <form method="post" action="print.php">
                                                                    <input type="hidden" name="nama_item" value="<?php echo $nama_item; ?>">
                                                                    <input type="hidden" name="stok_opname" value="<?php echo $stok_opname; ?>">
                                                                    <input type="hidden" name="deskripsi" value="<?php echo $deskripsi; ?>">
                                                                    <input type="hidden" name="keterangan" value="<?php echo $keterangan; ?>">
                                                                    <button type="submit" class="btn btn-success">Print</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tabel Items -->

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