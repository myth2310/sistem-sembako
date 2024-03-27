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

                                <!-- Tabel Detail Penjualan -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Detail Penjualan Item</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="item_terjual.php" class="btn btn-primary mb-3">Kembali</a>
                                        <div class="table-responsive">
                                            <table id="empTable" class="table mt-4">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Item</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Total Item Dibeli</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('koneksi/config.php');
                                                    // Ambil ID item dari URL
                                                    $id_item = $_GET['id_item'];

                                                    // Kueri SQL untuk menampilkan detail penjualan item tertentu
                                                    $sql = "SELECT item.nama_item, transaksi.nama_pelanggan, SUM(detail_transaksi.jumlah_satuan) AS total_item
                                                            FROM detail_transaksi
                                                            INNER JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi
                                                            INNER JOIN item ON detail_transaksi.id_item = item.id_item
                                                            WHERE detail_transaksi.id_item = $id_item
                                                            GROUP BY transaksi.nama_pelanggan";
                                                    $result = $koneksi->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        $no = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $no++ . "</td>";
                                                            echo "<td>" . $row['nama_item'] . "</td>";
                                                            echo "<td>" . $row['nama_pelanggan'] . "</td>";
                                                            echo "<td>" . $row['total_item'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                                                    }
                                                    $koneksi->close();
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tabel Detail Penjualan -->

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
