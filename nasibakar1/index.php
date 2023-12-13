<?php
include 'header.php';
?>
<!-- IMAGE -->
<div class="container-fluid" style="margin: 0;padding: 0;">
	<div class="image" style="margin-top: -21px">
		<img src="image/banner.png" style="width: 100%;  height: 750px;">
	</div>
</div>
<br>
<br>

<!-- PRODUK TERBARU -->
<div class="container">

	<h2 style=" width: 100%; margin-top: 80px;"><b>About Nasi Bakar</b></h2>

	<h4 class="text-justify"
		style="font-family: arial; padding-top: 10px; padding-bottom: 10px; line-height: 29px; border-top: 3px solid #4C3D3D; border-bottom: 3px solid #4C3D3D;">
		Sejak tahun 2018 pesen kopi hadir untuk menciptakan kopi terbaik untuk semua kalangan. Barista kami telah
		menyaring tahun-tahun mereka dalam mencicipi pengetahuan
		Nasi bakar merupakan kuliner nusantara khas Sunda, Jawa Barat yang rasanya dijamin lezat. Tapi, bagaimana jika
		nasi bakar ditambah rempah-rempah asli Madura? Tak hanya lezat, namun juga sedap.
		Nasi bakar yang disajikannya adalah nasi yang dikombinasikan dengan ikan seperti tuna, babat, udang yang diolah
		dengan bumbu khas Madura, lalu diberi sayur dan kemangi lantas dibungkus daun lalu dibakar.
		Dengan begitu semua cita rasa nasi maupun lauk dan sayurnya menjadi satu ditambah aroma bakaran daunnya
		menjadikan rasanya semakin nikmat dan aromanya sangat harum.</h4>

	<h2 style=" width: 100%; margin-top: 80px;"><b>Bagaimana cara pesan nasi bakar?</b></h2>

	<h4 class="text-justify"
		style="font-family: arial; padding-top: 10px; padding-bottom: 10px; line-height: 29px; border-top: 3px solid #4C3D3D; border-bottom: 3px solid #4C3D3D;">
		<li>Pastikan Anda sudah Daftar/Register dahulu</li>
		<li>Pilih Produk yang ingin dibeli</li>
		<li>Lakukan Checkout pesanan anda</li>
	</h4>

	<h2 style=" width: 100%; border-bottom: 4px solid #4C3D3D; margin-top: 80px;"><b>Rekomendasi</b></h2>

	<div class="row">
		<?php
		$result = mysqli_query($conn, "SELECT * FROM produk_rekomendasi");
		while ($row = mysqli_fetch_assoc($result)) {
			?>
			<div class="col-sm-6 col-md-4">
				<div class="thumbnail">
					<img src="image/produk/<?= $row['image']; ?>">
					<div class="caption">
						<h3>
							<?= $row['nama']; ?>
						</h3>
						<h4>Rp.
							<?= number_format($row['harga']); ?>
						</h4>
						<div class="row">
							<div class="col-md-6">
								<a href="detail_produk.php?produk=<?= $row['kode_produk']; ?>"
									class="btn btn-warning btn-block">Detail</a>
							</div>
							<?php if (isset($_SESSION['kd_cs'])) { ?>
								<div class="col-md-6">
									<a href="varian.php" class="btn btn-success btn-block" role="button"><i
											class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
								</div>
							<?php
							} else {
								?>
									<div class="col-md-6">
									<a href="varian.php" class="btn btn-success btn-block" role="button"><i
											class="glyphicon glyphicon-shopping-cart"></i> Tambah</a>
								</div>

							<?php
							}
							?>

						</div>

					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>

</div>
<br>
<br>
<br>
<br>
<?php
include 'footer.php';
?>