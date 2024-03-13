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


<?php
include('koneksi/config.php');

// Ambil data pendapatan perbulan dari tabel transaksi
$query_pendapatan = "SELECT MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun, SUM(total_harga) AS pendapatan 
                    FROM transaksi 
                    GROUP BY YEAR(tanggal), MONTH(tanggal)";

$hasil_pendapatan = $koneksi->query($query_pendapatan);

$labels = array();
$data = array();
while ($row = $hasil_pendapatan->fetch_assoc()) {
  $bulan_tahun = date('F Y', strtotime($row['tahun'] . '-' . $row['bulan'] . '-01'));
  $pendapatan = $row['pendapatan'];
  $labels[] = $bulan_tahun;
  $data[] = $pendapatan;
}
?>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Orders</h4>
                  </div>
                  <div class="card-body">
                    59
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Orders</h4>
                  </div>
                  <div class="card-body">
                    59
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Orders</h4>
                  </div>
                  <div class="card-body">
                    59
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col px-3">
            <canvas id="grafikPendapatan"></canvas>
            </div> 
          </div>

        </section>
      </div>
      <!-- End Main Content -->

      <footer class="main-footer">
        <?php include('layout/footer.php'); ?>
      </footer>

      <script>
              var ctx = document.getElementById('grafikPendapatan').getContext('2d');
              var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: <?php echo json_encode($labels); ?>,
                  datasets: [{
                    label: 'Pendapatan',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  scales: {
                    y: {
                      beginAtZero: true
                    }
                  }
                }
              });
            </script>

    </div>
  </div>
  <?php include('layout/js.php'); ?>