<?php
session_start();
include_once '../config/koneksi.php';
include_once '../config/fungsi_indotgl.php';
include_once 'class.poli.php';
?>
<div id="alert"></div>
<div class="row-fluid">
<div class="table-header">Daftar Pasien Poli</div>
<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Reg.No</th>
			<th>Dokter<br/> & Diagnosa</th>
			<th>Tindakan</th>
			<th>Resep</th>			
			<th>Rujuk LAB</th>
			<th>Rujukan</th>
			<th>Diagnosa Awal</th>
			<th>Nama</th>
			<th>Tempat Tgl Lahir</th>
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$tgl1 = date('Y-m-d');
			$poli = new poli($pdo);		
			$query = "SELECT * FROM v_reg WHERE tgl_reg = '$tgl1' AND poli <> 'LAB' ";		
			$poli->view($query);
		?>
	</tbody>
</table>


