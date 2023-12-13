<?php 
include 'header.php';
$sortage = mysqli_query($conn, "SELECT * FROM produksi where cek = '1'");
$cek_sor = mysqli_num_rows($sortage);
$nama_material = array();
?>

<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Riwayat Pesanan</b></h2>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Invoice</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Status</th>
				<th scope="col">Tanggal</th>
			</tr>
		</thead>
		<tbody>

			<?php 
			$result = mysqli_query($conn, "SELECT DISTINCT invoice, kode_customer, status, kode_produk, qty,terima,tolak, cek FROM produksi group by invoice");
			$no = 1;
			$array = 0;
			while($row = mysqli_fetch_assoc($result)){
				$kodep = $row['kode_produk'];
				$inv = $row['invoice'];
				?>

				<tr>
					<td><?= $no; ?></td>
					<td><?= $row['invoice']; ?></td>
					<td><?= $row['kode_customer']; ?></td>
					<?php if($row['terima'] == 1){ ?>
						<td style="color: green;font-weight: bold;">Pesanan Diterima (Siap Kirim)
							<?php
						}else if($row['tolak'] == 1){
							?>
							<td style="color: red;font-weight: bold;">Pesanan Ditolak
								<?php 
							}
							if($row['terima'] == 0 && $row['tolak'] == 0){
								?>
								<td style="color: orange;font-weight: bold;"><?= $row['status']; ?>
								<?php 
								

							}
							
							// $t_bom = mysqli_query($conn, "SELECT * FROM bom_produk WHERE kode_produk = '$kodep'");

							// while($row1 = mysqli_fetch_assoc($t_bom)){
							// 	$kodebk = $row1['kode_bk'];

							// 	$inventory = mysqli_query($conn, "SELECT * FROM inventory WHERE kode_bk = '$kodebk'");
							// 	$r_inv = mysqli_fetch_assoc($inventory);

							// 	$kebutuhan = $row1['kebutuhan'];	
							// 	$qtyorder = $row['qty'];
							// 	$inventory = $r_inv['qty'];

							// 	$bom = ($kebutuhan * $qtyorder);
							// 	$hasil = $inventory - $bom;
							// 	if($hasil < 0 && $row['tolak'] == 0){
							// 		$nama_material[] = $r_inv['nama'];
							// 		mysqli_query($conn, "UPDATE produksi SET cek = '1' where invoice = '$inv'");
									?>
									<td><?php echo date('Y/m-d'); ?></td>




									<?php 
								}
							
							?>
						</td>
						
					</tr>
					<?php
					$no++; 
				?>

			</tbody>
		</table>

		<?php 
if($cek_sor > 0){
 ?>
	<br>
	<br>
	<!-- <div class="row">
		<div class="col-md-4 bg-danger" style="padding:10px;">
			<h4>Kekurangan Material </h4>
			<h5 style="color: red;font-weight: bold;">Silahkan Tambah Stok Material dibawah ini : </h5> -->
			<!-- <table class="table table-striped">
				<tr>
					 <th>No</th>
					<th>Material</th> -->
				<!-- </tr> -->
	<?php 
	// $arr = array_values(array_unique($nama_material));
	// for ($i=0; $i < count($arr); $i++) { 

	 ?>
				<!-- <tr>
					<td><</td>
					<td></td>
				</tr> -->
	<?php } ?>
			</table>
		</div>
	</div>
<?php 

 ?>

	</div>

	



	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>


	<?php 
	include 'footer.php';
	?>
