<?php include('layout/head.php'); ?>

<link href='https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>
<link href='https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css' rel='stylesheet' type='text/css'>

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

                                <!-- Tabel Riwayat Transaksi -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Riwayat Pembayaran</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table id='empTable' class='display dataTable'>
                                                <thead>
                                                    <tr>
                                                        <th>No Transaksi</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Menghubungkan ke file config.php
                                                    include('koneksi/config.php');

                                                    // Query untuk mengambil data member
                                                    $query = "SELECT * FROM transaksi";
                                                    $result = $koneksi->query($query);

                                                    // Memeriksa apakah query berhasil dieksekusi
                                                    if ($result) {
                                                        if ($result->num_rows > 0) {
                                                            $no = 1;
                                                            // Output data dari setiap baris
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<td>" . $row['no_transaksi'] . "</td>";
                                                                echo "<td>" . date('d F Y', strtotime($row['tanggal'])). "</td>";
                                                                echo "<td>" . $row['nama_pelanggan'] . "</td>";
                                                                echo "<td>
                                                                        <!-- Tombol aksi -->
                                                                        <a class='btn btn-warning btn-sm px-4 mt-2' href='print_invoice_riwayat.php?id_transaksi=" . $row['id_transaksi'] . "'>Print</a>
                                                                        <a class='btn btn-danger btn-sm px-4 mt-2' href='hapus_transaksi.php?id_transaksi=" . $row['id_transaksi'] . "'>Hapus</a>
                                                                        <a class='btn btn-primary btn-sm px-4 mt-2' href='detail_transaksi.php?id_transaksi=" . $row['id_transaksi'] . "''>Detail</a>
                                                                       
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
                                <!-- End Tabel Riwayat Transaksi -->

                            </div>
                        </div>

                    </section>
                </div>
                <!-- End Bagian Utama -->

                <!-- ... (your existing code) ... -->

            </div>

            <?php include('layout/js.php'); ?>

            <!-- ... (your existing code) ... -->
            <script>
                // Fungsi untuk mencetak invoice
                function printInvoice(transactionId) {
                    // Di sini Anda dapat menambahkan logika untuk mencetak invoice
                    // Contoh: Buka halaman cetak invoice dalam jendela baru atau lakukan cetak langsung
                    window.open('print_invoice_riwayat.php', '_blank');
                }

                // Fungsi untuk menghapus transaksi
                function deleteTransaction(transactionId) {
                    // Di sini Anda dapat menambahkan logika untuk menghapus transaksi
                    // Contoh: Kirim permintaan AJAX ke server untuk menghapus transaksi dengan ID tertentu
                    console.log('Menghapus transaksi dengan ID: ' + transactionId);
                }
            </script>


            <script>
                // JavaScript function to trigger the print action
                function printPage() {
                    window.print();
                }
            </script>


            <script>
                $(document).ready(function() {
                    var empDataTable = $('#empTable').DataTable({
                        dom: 'Blfrtip',
                        buttons: [{
                                extend: 'copy',
                            },
                            {
                                extend: 'pdf',
                                exportOptions: {
                                    columns: [0, 1, 2] // Column index which needs to export
                                }
                            },
                            {
                                extend: 'csv',
                            },
                            {
                                extend: 'excel',
                            }
                        ]

                    });

                });
            </script>

            <!-- jQuery Library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!-- Datatable JS -->
            <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>


</body>

</html>