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
                            <div class="d-flex">
                              <input class="form-control mr-2" type="text" name="nama" id="nama" value="" />
                              <button type="button" class="btn btn-warning" id="cekDiskonBtn">Cek Diskon</button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="diskon" class="text-dark">Diskon (%)<span class='red'> *</span></label>
                            <input class="form-control" type="number" name="diskon" id="diskon" readonly />
                          </div>
                        </div>
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="uang_diterima" class="text-dark">Bayar (Rp.)<span class='red'> *</span></label>
                            <input class="form-control" type="text" name="uang_diterima" id="uang_diterima" required />
                          </div>
                        </div>

                        <div class="col-md-4 offset-md-8">
                            <div class="form-group">
                                <label for="kembalian" class="text-dark">Kembalian (Rp.)<span class='red'> *</span></label>
                                <input class="form-control" type="text" name="kembalian" id="kembalian" readonly />
                            </div>
                        </div>
                        <!-- Keterangan -->
                        <div class="col-md-4 offset-md-8">
                          <div class="form-group">
                            <label for="keterangan" class="text-dark">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
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
            itemContainer.find(".harga_beli").val(data.harga_jual);

            // Recalculate total harga_beli
            recalculateTotal();
          }
        });

        // Clear the search results
        itemContainer.find(".result").empty();
      });

      $(document).on("input", ".jumlah_satuan", function() {
        // Call recalculateTotal when the quantity is changed
        recalculateTotal();
      });

      // Function to recalculate total harga_beli
      function recalculateTotal() {
          var totalHargaBeli = 0;

          $(".item-container").each(function() {
              var jumlahSatuan = parseFloat($(this).find(".jumlah_satuan").val()) || 0;
              var hargaBeli = parseFloat($(this).find(".harga_beli").val()) || 0;

              var totalPerSatuan = jumlahSatuan * hargaBeli;
              totalHargaBeli += totalPerSatuan;

              // Update the total per/satuan field
              $(this).find(".total_per_satuan").val(totalPerSatuan.toFixed());
          });

          var diskon = parseFloat($("#diskon").val()) || 0;
          var diskonAmount = (diskon / 100) * totalHargaBeli;
          var totalAfterDiskon = totalHargaBeli - diskonAmount;

          // Format total harga before setting its value
          $("#totalHargaInput").val(formatRupiah(totalAfterDiskon));

          var uangDiterima = parseFloat($("#uang_diterima").val()) || 0;

          // Check if uangDiterima is not NaN and not 0
            if (!isNaN(uangDiterima) && uangDiterima !== 0) {
                // Calculate kembalian
                var kembalian = uangDiterima - totalAfterDiskon;

                // Check if kembalian is negative
                if (kembalian < 0) {
                    // Display an error message
                    $("#kembalian").val("Pembayaran kurang!");
                } else {
                    // Format kembalian before setting its value
                    $("#kembalian").val(formatRupiah(kembalian));
                }
            } else {
                // Set kembalian to empty if uangDiterima is not entered
                $("#kembalian").val("");
            }
      }

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
                <label for="jumlah_satuan" class="text-dark">Jumlah<span class='red'> *</span></label>
                <input class="form-control jumlah_satuan" type="number" name="jumlah_satuan_${itemIndex}" value="0" oninput="validateQuantity(this)" min="1" data-max-stock="0" required/>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="harga_beli" class="text-dark">Harga (Rp.)<span class='red'> *</span></label>
                <input class="form-control harga_beli" type="number" name="harga_beli_${itemIndex}" readonly />
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

</body>

</html>