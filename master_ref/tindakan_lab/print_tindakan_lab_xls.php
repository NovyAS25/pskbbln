<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-tindakan_lab.xls");
require_once '../../config/koneksi.php';
require_once '../tindakan_lab/class.tindakan_lab.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Tindakan Laboratorium</h3>
</div>
<table id="tabeldata" border="1" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Tindakan Laboratorium</th>
			<th>Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$tindakan_lab = new tindakan_lab($pdo);		
		$query = "SELECT * FROM tindakan_lab";		
		$tindakan_lab->prin($query);
	?>
	</tbody>
</table>
