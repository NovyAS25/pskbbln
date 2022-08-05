<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-Obat.xls");
require_once '../config/koneksi.php';
require_once 'class.apotik.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Obat</h3>
</div>
<table id="tabeldata" border="1" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th width="20px">ID</th>
			<th>Obat</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$apotik = new apotik($pdo);		
			$query = "SELECT * FROM v_obat_qty_stok";		
			$apotik->prin($query);
		?>
	</tbody>
</table>