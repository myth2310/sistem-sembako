<?php include('koneksi/config.php'); ?>

<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];
$role = $_SESSION['role']; 
?>

<?php
// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_item = $_POST['id_item'];
    $kategori_id = $_POST['kategori_id']; // Mengambil nilai kategori_id dari select option
    $nama_item = $_POST['nama_item'];
    $jenis_satuan = $_POST['jenis_satuan'];
    $jumlah_satuan = $_POST['jumlah_satuan'];
    $isi_satuan = $_POST['isi_satuan'];
    $harga_beli = intval(unformatRupiah($_POST['harga_beli'])); // Mengubah nilai menjadi integer
    $harga_jual = intval(unformatRupiah($_POST['harga_jual'])); // Mengubah nilai menjadi integer

    $query = "INSERT INTO item (id_item, kategori_id, nama_item, jenis_satuan, jumlah_satuan, isi_satuan, harga_beli, harga_jual, total_dibeli) 
          VALUES ('$id_item', '$kategori_id', '$nama_item', '$jenis_satuan', '$jumlah_satuan', '$isi_satuan', '$harga_beli', '$harga_jual', '$jumlah_satuan')";
    if ($koneksi->query($query) === TRUE) {
        header("Location: item.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}

// Function untuk menghapus format "Rp" dan koma
function unformatRupiah($str)
{
    return preg_replace("/[^0-9]/", "", $str);
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

                                <!-- Form Tambah Item -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Tambah Item</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="tambah_item.php" id="form_item">
                                            <div class="form-group">
                                                <label for="kategori_id">Kategori:</label>
                                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                                    <option value="">Pilih Kategori</option>
                                                    <?php
                                                    $sql = "SELECT * FROM kategori";
                                                    $result = $koneksi->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value='" . $row['id'] . "'>" . $row['kategori'] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option disabled>Tidak ada kategori</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_item">Nama Item:</label>
                                                <input type="text" class="form-control" id="nama_item" name="nama_item" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_satuan">Satuan Jenis</label>
                                                <input type="text" class="form-control" id="jenis_satuan" name="jenis_satuan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_satuan">Jumlah</label>
                                                <input type="text" class="form-control" id="jumlah_satuan" name="jumlah_satuan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="isi_satuan">Isi Satuan</label>
                                                <input type="text" class="form-control" id="isi_satuan" name="isi_satuan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_beli">Harga Beli:</label>
                                                <input type="text" class="form-control" id="harga_beli" name="harga_beli" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_jual">Harga Jual:</label>
                                                <input type="text" class="form-control" id="harga_jual" name="harga_jual" required>
                                            </div>
                                            <!-- Tambahkan bagian lain sesuai kebutuhan -->
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="item.php" class="btn btn-secondary">Batal</a>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Form Tambah Item -->

                            </div>
                        </div>
                    </section>
                </div>
                <!-- End Bagian Utama -->

            </div>

            <?php include('layout/js.php'); ?>
            <script>
                // Function untuk format angka menjadi Rupiah dengan simbol "Rp"
                function formatRupiah(angka) {
                    var reverse = angka.toString().split('').reverse().join('');
                    var ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    return 'Rp ' + ribuan;
                }

                // Function untuk menghapus format Rupiah dan mengembalikan angka saja
                function unformatRupiah(str) {
                    return parseInt(str.replace(/[^0-9]+/g, ''));
                }

                // Event listener saat form disubmit
                document.getElementById('form_item').addEventListener('submit', function(e) {
                    var hargaBeli = document.getElementById('harga_beli').value;
                    var hargaJual = document.getElementById('harga_jual').value;

                    // Menghapus format "Rp" dan koma sebelum mengirim nilai ke server
                    document.getElementById('harga_beli').value = unformatRupiah(hargaBeli);
                    document.getElementById('harga_jual').value = unformatRupiah(hargaJual);
                });

                // Event listener untuk memformat input harga beli saat mengetik
                document.getElementById('harga_beli').addEventListener('input', function(e) {
                    var value = this.value;
                    this.value = formatRupiah(unformatRupiah(value));
                });

                // Event listener untuk memformat input harga jual saat mengetik
                document.getElementById('harga_jual').addEventListener('input', function(e) {
                    var value = this.value;
                    this.value = formatRupiah(unformatRupiah(value));
                });
            </script>
        </div>
    </div>
</body>

</html>