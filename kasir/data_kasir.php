<?php
session_start();
include_once '../config/koneksi.php';
include_once '../config/fungsi_indotgl.php';
include_once 'class.kasir.php';
?>
<div id="alert"></div>
<div class="row-fluid">
	<div class="table-header">
	DAFTAR PASIEN
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Paymen</th>
			<th>Reg.No</th>
			<th>Nama</th>
			<th>Tempat Tgl Lahir</th>
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$tgl1 = date('Y-m-d');
			$obat = new kasir($pdo);		
			$query = "SELECT * FROM v_reg WHERE tgl_reg = '$tgl1' ";		
			$obat->viewkasir($query);
		?>
	</tbody>
</table>


