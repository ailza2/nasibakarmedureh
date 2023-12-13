<?php 
include 'header.php';
$invoices = $_GET['inv'];
$d_order = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoices'");
$t_order = mysqli_fetch_assoc($d_order);
$nama_material = array();


$sortage = mysqli_query($conn, "SELECT * FROM produksi where cek = '1'");
$cek_sor = mysqli_num_rows($sortage);

// customer
$cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '".$t_order['kode_customer']."'");
$t_cs = mysqli_fetch_assoc($cs);
?>

<div class="container">
	<h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
	<br>
	<h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;"><marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee></h5>
	<a href="produksi.php" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Invoice</th>
				<th scope="col">Kode Customer</th>
				<th scope="col">Status</th>
				<th scope="col">Tanggal</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		
		</table>



	<button type="hidden" data-toggle="modal" data-target="#myModal" id="btn" style="background-color: #fff; border: #fff;">
	</button>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<a href="m_produk.php" class="btn btn-default close"></a>
					<h4 class="modal-title" id="myModalLabel">#<?= $t_order['invoice']; ?></h4>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<tr>
							<td>Invoice</td>
							<td><?= $t_order['invoice']; ?></td>
						</tr>
						<tr>
							<td>Kode Customer</td>
							<td><?= $t_order['kode_customer']; ?></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td><?= $t_cs['nama']; ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?php echo  $t_order['alamat'].",".$t_order['kota']." ".$t_order['provinsi'].",".$t_order['kode_pos']; ?></td>
						</tr>
						<tr>
							<td>No Telp</td>
							<td><?= $t_cs['telp']; ?></td>
						</tr>
					</table>

					<hr>
					<h4>List Order</h4>
					<table class="table table-striped">
						<tr>
							<th>No</th>
							<th>Kode Produk</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>qty</th>
							<th>Subtotal</th>
						</tr>
					<?php 
						$order = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoices'");
						$no = 1;
						$grand = 0;
						while ($list = mysqli_fetch_assoc($order)) {
					 ?>
						<tr>
							<td><?= $no;  ?></td>
							<td><?= $list['kode_produk']; ?></td>
							<td><?= $list['nama_produk']; ?></td>
							<td><?= number_format($list['harga'], 0, ".", ".");  ?></td>
							<td><?= $list['qty'];  ?></td>
							<td><?= number_format($list['harga']*$list['qty'], 0, ".", ".");  ?></td>
						</tr>
					<?php 
						$sub = $list['harga'] * $list['qty'];
						$grand += $sub;
						$no++;
						}
					 ?>
						<tr>
							<td colspan="6" class="text-right"><b>Grand Total = <?= number_format($grand, 0, ".", ".");  ?></b></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<a href="produksi.php" class="btn btn-default">Close</a>
				</div>
			</div>
		</div>
	</div>

		<?php 
if($cek_sor > 0){
 ?>
	<br>
	<br>
	<div class="row">
		<div class="col-md-4 bg-danger" style="padding:10px;">
			<h4>Kekurangan Material </h4>
			<h5 style="color: red;font-weight: bold;">Silahkan Tambah Stok Material dibawah ini : </h5>
			<table class="table table-striped">
				<tr>
					<th>No</th>
					<th>Material</th>
				</tr>
	<?php 
	$arr = array_values(array_unique($nama_material));
	for ($i=0; $i < count($arr); $i++) { 

	 ?>
				<tr>
					<td><?= $i+1 ?></td>
					<td><?= $arr[$i]; ?></td>
				</tr>
	<?php } ?>
			</table>
		</div>
	</div>
<?php 
}
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
<script type="text/javascript">
	$( document ).ready(function() {
		$( "#btn" ).click();
	});
</script>

	<?php 
	include 'footer.php';
	?>