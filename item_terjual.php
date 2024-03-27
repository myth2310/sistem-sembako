<?php include('layout/head.php'); ?>

<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];
?>

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
                                        <h4>Item Terjual</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="tambah_item.php" class="btn btn-primary mb-3">Tambah Item</a>
                                        <div class="table-responsive">
                                            <table id="empTable" class="table mt-4">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kategori</th>
                                                        <th>Nama Item</th>
                                                        <th>Total Terjual</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('koneksi/config.php');
                                                    $sql = "SELECT item.*, kategori.kategori, SUM(detail_transaksi.jumlah_satuan) AS jumlah_terjual
                                                            FROM item 
                                                            INNER JOIN kategori ON item.kategori_id = kategori.id
                                                            LEFT JOIN detail_transaksi ON item.id_item = detail_transaksi.id_item
                                                            GROUP BY item.id_item";
                                                    $result = $koneksi->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        $no = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $no++ . "</td>";
                                                            echo "<td>" . $row['kategori'] . "</td>"; // Menggunakan kolom 'kategori' dari tabel kategori
                                                            echo "<td>" . $row['nama_item'] . "</td>";
                                                            echo "<td>" . $row['jumlah_terjual'] . "</td>"; // Menampilkan jumlah item terjual
                                                            echo "<td><a href='detail_item_terjual.php?id_item=" . $row['id_item'] . "' class='btn btn-warning btn-sm'>Detail</a></td>";

                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='11'>Tidak ada data</td></tr>";
                                                    }
                                                    $koneksi->close();
                                                    ?>

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
