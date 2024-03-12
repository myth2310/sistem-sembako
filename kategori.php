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

                                <!-- Tabel Kategori -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Kategori</h4>
                                    </div>
                                    <div class="card-body">
                                        <a href="tambah_kategori.php" class="btn btn-primary mb-3">Tambah Kategori</a>
                                        <div class="table-responsive">
                                            <table class="table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kategori</th>
                                                        <th>Tanggal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include('koneksi/config.php');
                                                    $sql = "SELECT * FROM kategori";
                                                    $result = $koneksi->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        $no = 1;
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $no++ . "</td>";
                                                            echo "<td>" . $row['kategori'] . "</td>";
                                                            echo "<td>" . date('d F Y', strtotime($row['tanggal'])) . "</td>";
                                                            echo "<td>";
                                                            echo "<a href='edit_kategori.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>";
                                                            echo "<a href='hapus_kategori.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus</a>";
                                                            echo "</td>";
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
                                <!-- End Tabel Kategori -->

                            </div>
                        </div>
                    </section>
                </div>
                <!-- End Bagian Utama -->

            </div>

            <?php include('layout/js.php'); ?>
</body>

</html>