<?php
session_start();
include_once '../config/koneksi.php';
include_once 'class.apotik.php';
?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Obat</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simpus/apotik/print_apotik.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simpus/apotik/print_apotik_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../simpus/apotik/print_apotik_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th width="20px">ID</th>
			<th>Obat</th>
			<th>Qty Stok</th>
			<th>Satuan</th>
			<th>Harga Satuan</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$obat = new apotik($pdo);		
		$query = "SELECT * FROM v_obat_qty_stok";		
		$obat->view($query);
	?>
	</tbody>
</table>


