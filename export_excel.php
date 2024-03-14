<?php
include('koneksi/config.php');

if (isset($_POST['export'])) {
    if (isset($_POST['bulanTahun'])) {
        $bulanTahun = $_POST['bulanTahun'];
        list($tahun, $bulan) = explode('-', $bulanTahun);

        // Query untuk mengambil data transaksi berdasarkan bulan dan tahun
        $query = "SELECT * FROM transaksi WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun";
        $result = $koneksi->query($query);

        // Mengatur header untuk membuat file Excel
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Data_Transaksi_Bulan_".$bulan."_Tahun_".$tahun.".xls");

        // Membuat tabel Excel dengan judul kolom
        echo "No Transaksi\tTanggal\tNama Pelanggan\n";

        // Isi data transaksi ke dalam file Excel
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Ubah format tanggal menjadi yyyy-mm-dd
                $tanggal_excel = date('Y-m-d', strtotime($row['tanggal']));
                echo $row['no_transaksi']."\t".$tanggal_excel."\t".$row['nama_pelanggan']."\n";
            }
        } else {
            echo "Tidak ada data yang ditemukan.";
        }
    }
}
?>
