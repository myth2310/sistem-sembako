<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('layout/head.php'); ?>
</head>

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
                                        <h4>Inventory</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="#" class="btn btn-primary mb-3" onclick="printInventory()">Print Inventory</a>
                                        <div class="table-responsive">
                                            <table class="table mt-3" id="inventoryTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Item</th>
                                                        <th>Jenis</th>
                                                        <th>Jumlah Masuk</th>
                                                        <th>Jumlah Keluar</th>
                                                        <th>Sisa Barang</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('koneksi/config.php');

                                                    // Query untuk mendapatkan data dari tabel item
                                                    $query = "SELECT i.nama_item, i.jenis_satuan, i.total_dibeli, i.jumlah_satuan, 
                                                                    SUM(dt.jumlah_satuan) AS jumlah_keluar
                                                            FROM item i
                                                            LEFT JOIN detail_transaksi dt ON i.id_item = dt.id_item
                                                            GROUP BY i.id_item";

                                                    $result = $koneksi->query($query);

                                                    if ($result->num_rows > 0) {
                                                        $no = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            // Hitung sisa barang
                                                            $sisa_barang = $row['jumlah_satuan'] - $row['jumlah_keluar'];
                                                            echo "<tr>";
                                                            echo "<td>" . $no++ . "</td>";
                                                            echo "<td>" . $row['nama_item'] . "</td>";
                                                            echo "<td>" . $row['jenis_satuan'] . "</td>";
                                                            echo "<td>" . $row['total_dibeli'] . "</td>";
                                                            echo "<td>" . $row['jumlah_keluar'] . "</td>";
                                                            echo "<td>" . $row['jumlah_satuan'] . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
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
            <script>
                function printInventory() {
                    // Ambil konten tabel
                    var printContents = document.getElementById('inventoryTable').outerHTML;
                    // Buat jendela baru untuk mencetak
                    var originalContents = document.body.innerHTML;
                    var newWindow = window.open();
                    newWindow.document.write('<html><head><title>Print Inventory</title></head><body>');
                    newWindow.document.write('<h1 style="text-align:center;">Inventory</h1>');
                    newWindow.document.write(printContents);
                    newWindow.document.write('</body></html>');
                    // Cetak
                    newWindow.print();
                    newWindow.close();
                }
            </script>
        </div>
    </div>
</body>

</html>