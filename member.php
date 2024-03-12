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

                                <!-- Tabel Member -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Member</h4>
                                    </div>
                                    <div class="card-body">
                                        <!-- Tombol Tambah Member -->
                                        <a href="tambah_member.php" class="btn btn-primary mb-3">Tambah Member</a>

                                        <div class="table-responsive">
                                            <table class="table mt-3">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Diskon</th>
                                                        <th>Alamat</th>
                                                        <th>Nomor</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Menghubungkan ke file config.php
                                                    include('koneksi/config.php');

                                                    // Query untuk mengambil data member
                                                    $query = "SELECT * FROM member";
                                                    $result = $koneksi->query($query);

                                                    // Memeriksa apakah query berhasil dieksekusi
                                                    if ($result) {
                                                        if ($result->num_rows > 0) {
                                                            $no = 1;
                                                            // Output data dari setiap baris
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<td>" . $no++ . "</td>";
                                                                echo "<td>" . $row['nama'] . "</td>";
                                                                echo "<td>" . $row['diskon'] . "</td>";
                                                                echo "<td>" . $row['alamat'] . "</td>";
                                                                echo "<td>" . $row['nomor'] . "</td>";
                                                                echo "<td>
                                                                        <!-- Tombol aksi -->
                                                                        <a href='edit_member.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                                                        <a href='hapus_member.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus</a>
                                                                      </td>";
                                                                echo "</tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='6'>Tidak ada data member.</td></tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='6'>Error: " . $koneksi->error . "</td></tr>";
                                                    }

                                                    // Menutup koneksi database
                                                    $koneksi->close();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tabel Member -->

                            </div>
                        </div>
                    </section>
                </div>
                <!-- End Bagian Utama -->

            </div>

            <?php include('layout/js.php'); ?>

</body>

</html>