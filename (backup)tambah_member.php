<?php
include('koneksi/config.php');

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $diskon = $_POST['diskon'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];

    $query = "INSERT INTO member (nama, diskon, alamat, nomor) VALUES ('$nama', '$diskon', '$alamat', '$nomor')";
    if ($koneksi->query($query) === TRUE) {
        header("Location: member.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
?>

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

                                <!-- Form Tambah Member -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Tambah Member</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="tambah_member.php">
                                            <div class="form-group">
                                                <label for="nama">Nama:</label>
                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="diskon">Diskon:</label>
                                                <input type="text" class="form-control" id="diskon" name="diskon" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat:</label>,
                                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nomor">Nomor:</label>
                                                <input type="text" class="form-control" id="nomor" name="nomor" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="member.php" class="btn btn-secondary">Batal</a>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Form Tambah Member -->

                            </div>
                        </div>
                    </section>
                </div>
                <!-- End Bagian Utama -->

            </div>

            <?php include('layout/js.php'); ?>

</body>

</html>