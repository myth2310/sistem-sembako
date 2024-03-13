<?php
include('koneksi/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = date('Y-m-d H:i:s');
    $no_transaksi = $_POST['no_transaksi'];
    $nama = $_POST['nama'];
    $total_harga = intval(str_replace(["Rp. ", "."], "", $_POST['total_harga']));
    $diskon = intval($_POST['diskon']);
    
    // Konversi nilai uang diterima dari format "Rp. " ke integer
    $uang_diterima = intval(str_replace(["Rp. ", "."], "", $_POST['uang_diterima']));
    
    // Konversi nilai kembalian dari format "Rp. " ke float
    $kembalian = floatval(str_replace(["Rp. ", "."], "", $_POST['kembalian']));
    
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO transaksi (no_transaksi, tanggal, nama_pelanggan, total_harga, diskon, uang_terima, kembalian, keterangan) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssiidds", $no_transaksi, $tanggal, $nama, $total_harga, $diskon, $uang_diterima, $kembalian, $keterangan);

    // Execute the main transaction insertion
    $stmt->execute();

    // Fetch the id_transaksi after insertion
    $id_transaksi = $koneksi->insert_id;

    // Loop through items and insert into 'detail_transaksi' table
    for ($i = 1; isset($_POST['nama_item_' . $i]); $i++) {
        $id_item = $_POST['id_item_' . $i];
        $jumlah_satuan = $_POST['jumlah_satuan_' . $i];
        $total_per_satuan = $_POST['total_per_satuan_' . $i];

        // Insert data into the 'detail_transaksi' table using prepared statement
        $detailQuery = "INSERT INTO detail_transaksi (id_transaksi, id_item, jumlah_satuan, total_per_satuan) 
                        VALUES (?, ?, ?, ?)";

        $detailStmt = $koneksi->prepare($detailQuery);
        $detailStmt->bind_param("ssss", $id_transaksi, $id_item, $jumlah_satuan, $total_per_satuan);
        $detailStmt->execute();

        // Subtract the quantity from the 'jumlah_satuan' column in the 'item' table
        $updateItemQuery = "UPDATE item SET jumlah_satuan = jumlah_satuan - ? WHERE id_item = ?";
        $updateItemStmt = $koneksi->prepare($updateItemQuery);
        $updateItemStmt->bind_param("ss", $jumlah_satuan, $id_item);
        $updateItemStmt->execute();
    }

    header("Location: print_invoice_riwayat.php?id_transaksi=" . $id_transaksi);
}
?>
