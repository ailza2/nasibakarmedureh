<?php 
include 'header.php';
$sortage = mysqli_query($conn, "SELECT * FROM produksi WHERE cek = '1'");
$cek_sor = mysqli_num_rows($sortage);
$nama_material = array();
?>

<div class="container">
	<h2 style="width: 100%; border-bottom: 4px solid gray"><b>Pilih Varian</b></h2>
	<br>
	<br>
	<table class="table table-striped">
		<thead>
        <tr>
    <th scope="col">No</th>
    <!-- <th scope="col">Invoice</th>
    <th scope="col">Kode Customer</th> -->
    <th scope="col">Varian</th>
    <th scope="col"></th>
</tr>
</thead>
<tbody>
    <?php 
    $result = mysqli_query($conn, "SELECT * FROM produksi");
    $no = 1;
    $array = 0;
    while($row = mysqli_fetch_assoc($result)){
        $kodep = $row['kode_produk'];
        $inv = $row['invoice'];
    ?>
    <tr>
        <td><?= $no; ?></td>
        <td><?= $row['invoice']; ?></td>
        <!-- <td><?= $row['kode_customer']; ?></td>
        <td><?= $row['varian']; ?></td> -->
        <td><a href="proses/add.php?produk=<?= $row['kode_produk']; ?>&kd_cs=<?= $kode_cs; ?>&hal=1" class="btn btn-success btn-block" role="button">Tambah</a></td>
    </tr>
    <?php
        $no++;
    }
    ?>
</tbody>

				<?php
				$no++;
			
			?>
		</tbody>
	</table>
	<?php 
	if ($cek_sor > 0) {
	?>
		<br>
		<br>
		<div class="row">
			<div class="col-md-4 bg-danger" style="padding: 10px;">
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
<br>
<?php 
include 'footer.php';
?>
