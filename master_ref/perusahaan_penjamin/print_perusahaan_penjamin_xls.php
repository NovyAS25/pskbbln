<?php
session_start();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/ms-excel"); 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Data-perusahaan_penjamin.xls");
require_once '../../config/koneksi.php';
require_once '../perusahaan_penjamin/class.perusahaan_penjamin.php'; 
?>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar perusaan penjamin</h3>
</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Perusahaan Penjamin</th>
			<th>Alamat</th>
			<th>Telp</th>			
			<th>Kode Penjamin</th>
			<th width="50px">Aktif</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$perusahaan_penjamin = new perusahaan_penjamin($pdo);		
		$query = "SELECT * FROM	perusahaan_penjamin ";		
		$perusahaan_penjamin->view($query);
	?>
	</tbody>
</table>


