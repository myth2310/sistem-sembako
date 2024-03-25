<!-- Pastikan Anda telah memuat jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

<div class="pelanggan-container">
    <div class="form-group">
        <label for="nama_item">Nama Item:</label>
        <input class="form-control nama" type="text" name="nama" placeholder="Nama Item" required />
        <div class="result_pelanggan"></div>
    </div>
</div> <!-- Menutup tag div yang terbuka -->
