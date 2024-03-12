<?php
include('koneksi/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_item = $_POST['id_item'];
    $kategori_id = $_POST['kategori_id'];
    $nama_item = $_POST['nama_item'];
    $merk = $_POST['merk'];
    $jenis_satuan = $_POST['jenis_satuan'];
    $jumlah_satuan = $_POST['jumlah_satuan'];
    $isi_satuan = $_POST['isi_satuan'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];

    // Periksa apakah kategori_id yang dikirimkan ada dalam tabel kategori
    $check_kategori = "SELECT * FROM kategori WHERE id='$kategori_id'";
    $result_check_kategori = $koneksi->query($check_kategori);
    if ($result_check_kategori->num_rows > 0) {
        // Jika kategori_id valid, jalankan pernyataan SQL untuk memperbarui data
        $query = "UPDATE item SET kategori_id='$kategori_id', nama_item='$nama_item', merk='$merk', jenis_satuan='$jenis_satuan', jumlah_satuan='$jumlah_satuan', isi_satuan='$isi_satuan', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id_item='$id_item'";
        if ($koneksi->query($query) === TRUE) {
            header("Location: item.php");
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $koneksi->error;
        }
    } else {
        // Jika kategori_id tidak valid, tampilkan pesan kesalahan
        echo "Error: Kategori tidak valid.";
    }
}

$id_item = $_GET['id_item'];
$sql = "SELECT * FROM item WHERE id_item='$id_item'";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
$koneksi->close();
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

                                <!-- Form Edit Item -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Edit Item</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <input type="hidden" name="id_item" value="<?php echo $row['id_item']; ?>">
                                            <div class="form-group">
                                                <label for="kategori_id">Kategori:</label>
                                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                                    <?php
                                                    include('koneksi/config.php');
                                                    $sql_kategori = "SELECT * FROM kategori";
                                                    $result_kategori = $koneksi->query($sql_kategori);
                                                    if ($result_kategori->num_rows > 0) {
                                                        while ($row_kategori = $result_kategori->fetch_assoc()) {
                                                            if ($row['kategori_id'] == $row_kategori['id']) {
                                                                echo "<option value='" . $row_kategori['id'] . "' selected>" . $row_kategori['kategori'] . "</option>";
                                                            } else {
                                                                echo "<option value='" . $row_kategori['id'] . "'>" . $row_kategori['kategori'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    $koneksi->close();
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_item">Nama Item:</label>
                                                <input type="text" class="form-control" id="nama_item" name="nama_item" value="<?php echo $row['nama_item']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="merk">Merk:</label>
                                                <input type="text" class="form-control" id="merk" name="merk" value="<?php echo $row['merk']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_satuan">Jenis Satuan:</label>
                                                <input type="text" class="form-control" id="jenis_satuan" name="jenis_satuan" value="<?php echo $row['jenis_satuan']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_satuan">Jumlah Satuan:</label>
                                                <input type="text" class="form-control" id="jumlah_satuan" name="jumlah_satuan" value="<?php echo $row['jumlah_satuan']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="isi_satuan">Isi Satuan:</label>
                                                <input type="text" class="form-control" id="isi_satuan" name="isi_satuan" value="<?php echo $row['isi_satuan']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_beli">Harga Beli:</label>
                                                <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $row['harga_beli']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga_jual">Harga Jual:</label>
                                                <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $row['harga_jual']; ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="item.php" class="btn btn-secondary">Batal</a>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Form Edit Item -->

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