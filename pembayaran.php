<?php include('layout/head.php'); ?>

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

// Koneksi ke database
include('koneksi/config.php');

// Query untuk mengambil data nama item dan harga jual dari tabel item
$query = "SELECT nama_item, harga_jual, harga_jual2, harga_jual3 FROM item";
$result = mysqli_query($koneksi, $query);
?>

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
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Input Pembayaran</h4>
                </div>
                <div class="card-body">
                  <!-- Form untuk input transaksi -->
                  <form action="proses_transaksi.php" method="post">
                    <div class="card-body">
                      <div id="items-container">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="tgl_transaksi" class="text-dark">Tanggal Transaksi<span class='red'> *</span></label>
                              <?php $tanggal_hari_ini = date("d F Y"); ?>
                              <input class="form-control" type="text" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo $tanggal_hari_ini; ?>" readonly />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="no_transaksi" class="text-dark">Nomor Transaksi<span class='red'> *</span></label>
                              <?php $nomor_transaksi = "TR" . rand(); ?>
                              <input class="form-control" type="text" name="no_transaksi" id="no_transaksi" value="<?php echo $nomor_transaksi; ?>" readonly />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 mb-4">
                            <button type="button" class="btn btn-success" id="btnTambahItem" onclick="addNewItem()">Transkasi Baru</button>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="totalHargaInput" class="text-dark">Harus Dibayar (Rp.)<span class='red'> *</span></label>
                            <input type="text" id="totalHargaInput" class="form-control" name="total_harga" value="Rp. 0" readonly />
                          </div>
                        </div>
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="nama" class="text-dark">Nama Pelanggan<span class='red'> *</span></label>
                            <div class="pelanggan-container">
                              <div class="row">
                                <div class="col-6">
                                  <input class="form-control nama" type="text" name="nama" placeholder="Nama Pelanggan" required />
                                  <div class="result_pelanggan"></div>
                                </div>
                                <div class="col">
                                  <a href="tambah_pelanggan.php" class="btn btn-warning p-2">Tambah Pelanggan</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="diskon" class="text-dark">Diskon (%)<span class='red'> *</span></label>
                            <input class="form-control" type="number" name="diskon" id="diskon" readonly />
                          </div>
                        </div> -->
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="tipe_pembayaran" class="text-dark">Tipe Pembayaran<span class='red'> *</span></label>
                            <select class="form-control" name="tipe_pembayaran" id="tipe_pembayaran" required>
                              <option value="">Metode Pembayaran</option>
                              <option value="Cash">Cash</option>
                              <option value="Debit">Debit</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="uang_diterima" id="label_uang_diterima" class="text-dark">Bayar (Rp.)<span class='red'> *</span></label>
                            <input class="form-control" type="text" name="uang_diterima" id="uang_diterima" required />
                          </div>
                        </div>

                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="kembalian" id="label_kembalian" class="text-dark">Kembalian (Rp.)<span class='red'> *</span></label>
                            <input class="form-control" type="text" name="kembalian" id="kembalian" readonly />
                          </div>
                        </div>

                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="kurangan" id="label_kurangan" class="text-dark">Kurangan (Rp.)<span class='red'> *</span></label>
                            <input class="form-control" type="text" name="kurangan" id="kurangan" readonly />
                          </div>
                        </div>
                        <!-- Keterangan -->
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="keterangan" class="text-dark">Nama Sales</label>
                            <select class="form-control" name="keterangan" id="keterangan" required>
                              <option value="">Nama Sales</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-actions float-right">
                            <button type="reset" name="Reset" class="btn btn-danger">
                              <i class="fa fa-times"></i> Batal
                            </button>
                            <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" title="Save">
                              <i class="fa fa-check"></i> Bayar
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!-- End Main Content -->
      <footer class="main-footer">
        <?php include('layout/footer.php'); ?>
      </footer>
    </div>
  </div>
  <?php include('layout/js.php'); ?>
  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- JavaScript -->

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

      // Event handler for input on nama_item
      $(document).on("input", ".nama_item", function() {
        handleItemSearch($(this));
      });

      // Event handler for selecting an item
      $(document).on("click", ".result li", function() {
        var selectedItem = $(this).text();
        var itemContainer = $(this).closest(".item-container");

        // Update the input field with the selected item
        itemContainer.find(".nama_item").val(selectedItem);

        // Perform additional AJAX request for the selected item details
        $.ajax({
          type: "POST",
          url: "get_quantity.php",
          data: {
            selectedItem: selectedItem
          },
          success: function(response) {
            var data = JSON.parse(response);
            itemContainer.find(".id_item").val(data.id_item);
            itemContainer.find(".jenis_satuan").val(data.jenis_satuan);
            itemContainer.find(".jumlah_satuan").val(0);
            itemContainer.find(".jumlah_satuan").attr("data-max-stock", data.jumlah_satuan);

            // Clear any previous options
            itemContainer.find(".harga_jual").empty();

            // Add options for harga jual based on the selected item
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              if ("<?php echo $row['nama_item']; ?>" === selectedItem) {
                itemContainer.find(".harga_jual").append('<option value="<?php echo $row['harga_jual']; ?>"><?php echo $row['harga_jual']; ?></option>');
                itemContainer.find(".harga_jual").append('<option value="<?php echo $row['harga_jual2']; ?>"><?php echo $row['harga_jual2']; ?></option>');
                itemContainer.find(".harga_jual").append('<option value="<?php echo $row['harga_jual3']; ?>"><?php echo $row['harga_jual3']; ?></option>');
              }
            <?php endwhile; ?>

            // Recalculate total harga_jual
            recalculateTotal();
          }
        });

        // Clear the search results
        itemContainer.find(".result").empty();
      });
      // Event handler for change on pilihan harga
      $(document).on("change", ".harga_jual", function() {
        // Call recalculateTotal when the harga_jual option is changed
        recalculateTotal();
      });
      $(document).ready(function() {
        // Lakukan request AJAX untuk mendapatkan nama sales
        $.ajax({
          url: 'get_sales.php', // Ubah sesuai dengan nama file PHP untuk mendapatkan nama sales
          type: 'GET',
          success: function(response) {
            // Jika request sukses, tambahkan nama sales ke dalam dropdown list
            var sales = JSON.parse(response);
            $.each(sales, function(index, item) {
              $('#keterangan').append('<option value="' + item.nama + '">' + item.nama + '</option>');
            });
          },
          error: function(xhr, status, error) {
            // Jika terjadi error, tampilkan pesan error di console
            console.error(error);
          }
        });
      });

      $(document).on("input", ".jumlah_satuan", function() {
        // Call recalculateTotal when the quantity is changed
        recalculateTotal();
      });

      // Function to recalculate total harga_jual
      function recalculateTotal() {
          var totalHargaJual = 0;

          $(".item-container").each(function() {
              var jumlahSatuan = parseFloat($(this).find(".jumlah_satuan").val()) || 0;
              var hargaJual = parseFloat($(this).find(".harga_jual").val()) || 0;

              var totalPerSatuan = jumlahSatuan * hargaJual;
              totalHargaJual += totalPerSatuan;

              // Update the total per/satuan field
              $(this).find(".total_per_satuan").val(totalPerSatuan.toFixed());
          });

          var diskon = parseFloat($("#diskon").val()) || 0;
          var diskonAmount = (diskon / 100) * totalHargaJual;
          var totalAfterDiskon = totalHargaJual - diskonAmount;

          // Format total harga before setting its value
          $("#totalHargaInput").val(formatRupiah(totalAfterDiskon));

          var uangDiterima = parseFloat($("#uang_diterima").val()) || 0;

          // Check if uangDiterima is not NaN and not 0
          if (!isNaN(uangDiterima) && uangDiterima !== 0) {
              // Calculate kembalian
              var kembalian = uangDiterima - totalAfterDiskon;

              // Check if kembalian is negative
              if (kembalian < 0) {
                  // Display the amount to be paid
                  var kurangBayar = -kembalian; // Ambil nilai positif dari kembalian
                  $("#kembalian").val("-"); // Tampilkan kurang bayar

                  // Simpan nilai kurang bayar ke dalam input field
                  $("#kurangan").val(formatRupiah(kurangBayar));
              } else {
                  // Format kembalian before setting its value
                  $("#kembalian").val(formatRupiah(kembalian));

                  // Set nilai kurang bayar ke 0 dan kosongkan input field
                  $("#kurangan").val("");
              }
          } else {
              // Set kembalian to empty if uangDiterima is not entered
              $("#kembalian").val("");
          }
      }

      $("#kembalian").hide();
      $("#kurangan").hide();
      $("#label_kembalian").hide(); // Sembunyikan label "Kembalian (Rp.)"
      $("#label_kurangan").hide(); 
      $("#uang_diterima").hide(); 
      $("#label_uang_diterima").hide(); 
      // Event handler for change on tipe_pembayaran
      $("#tipe_pembayaran").change(function() {
          var selectedPaymentType = $(this).val();

          // Jika memilih Cash, tampilkan field kembalian dan sembunyikan field kurangan
          if (selectedPaymentType === "Cash") {
              $("#kembalian").show();
              $("#kurangan").hide();
              $("#label_kembalian").show(); 
              $("#label_kurangan").hide(); 
              $("#uang_diterima").show(); 
              $("#label_uang_diterima").show(); 
          } 
          // Jika memilih Debit, sembunyikan field kembalian dan kurangi labelnya
          else if (selectedPaymentType === "Debit") {
              $("#kembalian").hide();
              $("#kurangan").show();
              $("#label_kurangan").show(); 
              $("#label_kembalian").hide(); 
              $("#uang_diterima").show(); 
              $("#label_uang_diterima").show(); 
          }
          // Jika belum memilih, sembunyikan keduanya
          else {
              $("#kembalian").hide();
              $("#kurangan").hide();
              $("#label_kembalian").hide(); // Sembunyikan label "Kembalian (Rp.)"
              $("#label_kurangan").hide(); 
              $("#uang_diterima").hide(); 
              $("#label_uang_diterima").hide(); 
          }
      });

      // Function to format number to Indonesian currency format
      function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join(''),
          ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp. ' + ribuan;
      }

      $("#uang_diterima").on("input", function() {
        // Recalculate total and kembalian when uang_diterima is entered
        recalculateTotal();
      });


      // Event handler for clicking the "cekDiskonBtn"
      $("#cekDiskonBtn").click(function() {
        var namaPelanggan = $("#nama").val();

        $.ajax({
          type: "POST",
          url: "search.php", // Ganti dengan nama file PHP yang sesuai
          data: {
            namaPelanggan: namaPelanggan
          },
          success: function(data) {
            $("#diskon").val(data);

            // Recalculate total harga after obtaining diskon
            recalculateTotal();
          }
        });
      });
    });
  </script>

  <script>
    function validateQuantity(input) {
      var quantity = parseFloat(input.value) || 0;

      // Check if the quantity is not negative
      if (quantity < 0) {
        alert("Isi tidak boleh 0.");
        input.value = 0;
        return;
      }
      var availableStock = parseFloat(input.getAttribute("data-max-stock")) || 0;
      if (quantity > availableStock) {
        alert("Stok tidak mencukupi, periksa jumlah stok.");
        input.value = availableStock;
      }

      recalculateTotal();
    }


    var itemIndex = 0;

    function addNewItem() {
      itemIndex++;
      var itemsContainer = $("#items-container");

      var newItemContainer = $("<div>").addClass("row form-group item-container").html(`
        
        <input class="form-control id_item" type="text" name="id_item_${itemIndex}"  style="display:none"/>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nama_item" class="text-dark">Nama Item<span class='red'> *</span></label>
                <input class="form-control nama_item" type="text" name="nama_item_${itemIndex}" required/>
                <div class="result"></div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="jenis_satuan" class="text-dark">Jenis<span class='red'> *</span></label>
                <input class="form-control jenis_satuan" type="text" name="jenis_satuan_${itemIndex}" readonly />
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="harga_jual" class="text-dark">Harga (Rp.)<span class='red'> *</span></label>
                <select class="form-control harga_jual" name="harga_jual_${itemIndex}">
                    <!-- Opsi harga jual akan ditambahkan melalui JavaScript -->
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="jumlah_satuan" class="text-dark">Jumlah<span class='red'> *</span></label>
                <input class="form-control jumlah_satuan" type="number" name="jumlah_satuan_${itemIndex}" value="0" oninput="validateQuantity(this)" min="1" data-max-stock="0" required/>
            </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="total_per_satuan" class="text-dark">Total (Rp.)<span class='red'> *</span></label>
            <input class="form-control total_per_satuan" type="number" name="total_per_satuan_${itemIndex}" readonly />
          </div>
        </div>

      `);



      itemsContainer.append(newItemContainer);


      // Recalculate total when a new item is added
      recalculateTotal()
    }


    function removeLastItem() {
      var itemsContainer = $("#items-container");
      var lastItem = itemsContainer.children(".item-container").last();
      if (lastItem.length > 0) {
        lastItem.remove();

        // Recalculate total when an item is removed
        recalculateTotal();
      }
    }
  </script>

  <script>
    $(document).ready(function() {
      function handleItemSearch(inputElement) {
        var searchPelanggan = inputElement.val();
        var resultPelanggan = inputElement.parent().find(".result_pelanggan");

        if (searchPelanggan !== "") {
          $.ajax({
            type: "POST",
            url: "search_pelanggan.php",
            data: {
              searchPelanggan: searchPelanggan
            },
            success: function(data) {
              resultPelanggan.html(data);
            }
          });
        } else {
          resultPelanggan.empty();
        }
      }

      $(document).on("input", ".nama", function() {
        handleItemSearch($(this));
      });

      $(document).on("click", ".result_pelanggan li", function() {
        var selectedPelanggan = $(this).text();
        var pelangganContainer = $(this).closest(".pelanggan-container");
        pelangganContainer.find(".nama").val(selectedPelanggan);

        $.ajax({
          type: "POST",
          url: "get_pelanggan.php",
          data: {
            selectedPelanggan: selectedPelanggan
          },
          success: function(response) {
            var data = JSON.parse(response);
            pelangganContainer.find(".nama").val(data.nama);
          }
        });

        pelangganContainer.find(".result_pelanggan").empty(); // Mengganti itemContainer menjadi pelangganContainer
      });
    });
  </script>



</body>

</html>