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
                                        <h4>Items</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="tambah_item.php" class="btn btn-primary mb-3">Tambah Item</a>
                                        <div class="table-responsive">
                                            <table class="table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kategori</th>
                                                        <th>Nama Item</th>
                                                        <th>Merk</th>
                                                        <th>Jenis</th>
                                                        <th>Jumlah</th>
                                                        <th>Isi Satuan</th>
                                                        <th>Harga Beli</th>
                                                        <th>Harga Jual</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('koneksi/config.php');
                                                    $sql = "SELECT item.*, kategori.kategori 
                                                    FROM item 
                                                    INNER JOIN kategori ON item.kategori_id = kategori.id";
                                                    $result = $koneksi->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        $no = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $no++ . "</td>";
                                                            echo "<td>" . $row['kategori'] . "</td>"; // Menggunakan kolom 'kategori' dari tabel kategori
                                                            echo "<td>" . $row['nama_item'] . "</td>";
                                                            echo "<td>" . $row['merk'] . "</td>";
                                                            echo "<td>" . $row['jenis_satuan'] . "</td>";
                                                            echo "<td>" . $row['jumlah_satuan'] . "</td>";
                                                            echo "<td>" . $row['isi_satuan'] . "</td>";
                                                            echo "<td>" . $row['harga_beli'] . "</td>";
                                                            echo "<td>" . $row['harga_jual'] . "</td>";
                                                            echo "<td>";
                                                            echo "<a href='edit_item.php?id_item=" . $row['id_item'] . "' class='btn btn-warning btn-sm'>Perbarui Data</a>";
                                                            echo "<a href='hapus_item.php?id_item=" . $row['id_item'] . "' class='btn btn-danger btn-sm'>Hapus</a>";
                                                            echo "<a href='print_item.php?id_item=" . $row['id_item'] . "' class='btn btn-success btn-sm'>Print</a>";
                                                            echo "</td>";
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
            <script>
                function printItem(id) {
                    // Buka halaman cetak item dalam jendela baru
                    var newWindow = window.open('print_item.php?id=' + id, '_blank');

                    // Cetak halaman
                    newWindow.print();
                    newWindow.close();
                }
            </script>

</body>

</html>