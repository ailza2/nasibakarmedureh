<?php
include 'header.php';

// pesanan baru 
$result1 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE terima = 0 and tolak = 0");
$jml1 = mysqli_num_rows($result1);

// pesanan dibatalkan/ditolak
$result2 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE tolak = 1");
$jml2 = mysqli_num_rows($result2);

// pesanan diterima
$result3 = mysqli_query($conn, "SELECT distinct invoice FROM produksi WHERE terima = 1");
$jml3 = mysqli_num_rows($result3);

// Mengambil data nama_produk terjual
// Mengambil tanggal dari database
$resultDate = mysqli_query($conn, "SELECT tanggal FROM produksi LIMIT 1"); // Ambil tanggal dari salah satu baris produksi
$rowDate = mysqli_fetch_assoc($resultDate);
$tanggal = $rowDate['tanggal'];

// Query dengan tambahan tanggal dari database
$result4 = mysqli_query($conn, "SELECT nama_produk, COUNT(qty) as total FROM produksi WHERE terima > 0 AND tanggal = '$tanggal' GROUP BY nama_produk");
$data = array();
while ($row = mysqli_fetch_assoc($result4)) {
  $data[$row['nama_produk']] = $row['total'];
}

// Konversi data ke format yang dibutuhkan oleh chart
$labels = array_keys($data);
$values = array_values($data);
$chartData = array(
  'labels' => $labels,
  'datasets' => array(
    array(
      'label' => 'Grafik Penjualan 2023',
      'data' => $values,
      'backgroundColor' => array('#FF6384', '#36A2EB', '#FFCE56')
    )
  )
);

// Mengubah data menjadi format JSON
$chartDataJSON = json_encode($chartData);

?>

<style>
.chart-bar canvas {
  border: 5px solid #ddd;
  width: 120% !important;
  height: 400px !important;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
        <h4>PESANAN BARU</h4>
        <h4 style="font-size: 56pt;"><b><?= $jml1; ?></b></h4>
      </div>
    </div>

    <div class="col-md-4">
      <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
        <h4>PESANAN DIBATALKAN</h4>
        <h4 style="font-size: 56pt;"><b><?= $jml2; ?></b></h4>
      </div>
    </div>

    <div class="col-md-4">
      <div style="background-color: #dfdfdf; padding-bottom: 60px; padding-left: 20px;padding-right: 20px; padding-top: 10px;">
        <h4>PESANAN DITERIMA</h4>
        <h4 style="font-size: 56pt;"><b><?= $jml3; ?></b></h4>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"></h1>

    <!-- Content Row -->
    <div class="row justify-content-center"> <!-- Add 'justify-content-center' class to center the content -->
      <div class="col-xl-10 col-lg-10">
        <!-- Bar Chart -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
          </div>
          <h1>Grafik Penjualan 2023</h1>
          <div class="card-body">
            <div class="chart-bar">
              <canvas id="myBarChart"></canvas>
            </div>
            <hr>
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript -->
<script src="bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages -->
<script src="bootstrap/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="bootstrap/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script>
  $(document).ready(function() {
    // Mengambil elemen canvas chart
    var ctx = document.getElementById('myBarChart').getContext('2d');

    // Mengubah data JSON menjadi objek
    var data = <?= $chartDataJSON; ?>;

    // Membuat chart dengan data yang diambil
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  });
</script>

<?php
include 'footer.php';
?>
