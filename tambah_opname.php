<?php

include('koneksi/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama_item = $_POST['nama'];
    $stok_opname = $_POST['stok_opname'];

    $query_get_id = "SELECT id_item, jumlah_satuan FROM item WHERE nama_item = '$nama_item'";
    $result_get_id = $koneksi->query($query_get_id);

    if ($result_get_id->num_rows > 0) {
        $row = $result_get_id->fetch_assoc();
        $id_item = $row['id_item'];
        $jumlah_satuan = $row['jumlah_satuan'];

       
        if ($stok_opname == $jumlah_satuan) {
            $deskripsi = "Benar";
        } elseif ($stok_opname < $jumlah_satuan) {
            $kurang = $jumlah_satuan - $stok_opname;
            $deskripsi = "Kurang $kurang";
        } else {
            $lebih = $stok_opname - $jumlah_satuan;
            $deskripsi = "Lebih $lebih";
        }


        $query_simpan = "INSERT INTO opname (id_item, stok_opname, deskripsi, keterangan) VALUES ('$id_item', '$stok_opname', '$deskripsi', 'Tulis Keterangan')";
        if ($koneksi->query($query_simpan) === TRUE) {
            echo "Data berhasil disimpan.";
          
            header("Location: opname.php");
            exit(); 
        } else {
            echo "Error: " . $query_simpan . "<br>" . $koneksi->error;
        }
    } else {
        echo "Nama item tidak ditemukan dalam database.";
    }


    $koneksi->close();
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
                                <!-- Form Cek Stock Opname -->
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h4>Cek Stock Opname</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="item-container">
                                                <div class="form-group">
                                                    <label for="nama_item">Nama Item:</label>
                                                    <input class="form-control id_item" type="text" name="id_item" style="display: none;" />
                                                    <input class="form-control nama_item" type="text" name="nama_item" placeholder="Nama Item" required />
                                                    <div class="result"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="jumlah_satuan">Stok Opname:</label>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input class="form-control" id="nilai" value="0" min="0" type="number" name="stok_opname" required />
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="button" onclick="tambahNilai()" class="btn btn-danger">Tambah</button>
                                                            <button type="button" onclick="kurangNilai()" class="btn btn-success">Kurang</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cek Stok Opname</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- End Bagian Utama -->

            </div>

            <?php include('layout/js.php'); ?>


            <script>
  function tambahNilai() {
    var nilaiInput = document.getElementById("nilai");
    var nilai = parseInt(nilaiInput.value, 10);
    nilai += 1;
    nilaiInput.value = nilai;
  }

  function kurangNilai() {
    var nilaiInput = document.getElementById("nilai");
    var nilai = parseInt(nilaiInput.value, 10);
    if (nilai > 0) {
      nilai -= 1;
      nilaiInput.value = nilai;
    }
  }
</script>



            <script>
                $(document).ready(function() {
                    // Function to handle item search
                    function handleItemSearch(inputElement) {
                        var searchTerm = inputElement.val();
                        var resultContainer = inputElement.parent().find(".result");

                        if (searchTerm !== "") {
                            $.ajax({
                                type: "POST",
                                url: "search_item.php",
                                data: {
                                    searchTerm: searchTerm
                                },
                                success: function(data) {
                                    resultContainer.html(data);
                                }
                            });
                        } else {
                            resultContainer.empty();
                        }
                    }

                    $(document).on("input", ".nama_item", function() {
                        handleItemSearch($(this));
                    });

                    $(document).on("click", ".result li", function() {
                        var selectedItem = $(this).text();
                        var itemContainer = $(this).closest(".item-container");
                        itemContainer.find(".nama_item").val(selectedItem);

                        $.ajax({
                            type: "POST",
                            url: "get_quantity.php",
                            data: {
                                selectedItem: selectedItem
                            },
                            success: function(response) {
                                var data = JSON.parse(response);
                                itemContainer.find(".id_item").val(data.id_item);
                            }
                        });

                        itemContainer.find(".result").empty();
                    });
                });
            </script>

        </div>
    </div>
</body>

</html>