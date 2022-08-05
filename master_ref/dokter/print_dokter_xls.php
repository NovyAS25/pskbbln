<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-User.xls");
require_once '../../config/koneksi.php';
require_once '../dokter/class.dokter.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Dokter</h3>
</div>
<table id="tabeldata" border="1" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Dokter</th>
			<th>Alamat</th>
			<th>Telp</th>
			<th>Bidang Keahlian</th>
			<th width="50px">Aktif</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$dokter = new dokter($pdo);		
		$query = "SELECT * FROM dokter";		
		$dokter->prin($query);
	?>
	</tbody>
</table>