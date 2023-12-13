

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