<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-Tindakan.xls");
require_once '../../config/koneksi.php';
require_once '../tindakan/class.tindakan.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Tindakan</h3>
</div>
<table id="tabeldata" border="1" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Tindakan</th>
			<th>Harga</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$tindakan = new tindakan($pdo);		
		$query = "SELECT * FROM tindakan";		
		$tindakan->prin($query);
	?>
	</tbody>
</table>
