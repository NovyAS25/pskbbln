<?php
session_start();
include_once '../../config/koneksi.php';
include_once 'class.perusahaan_penjamin.php';
?>
<?php if ($_SESSION['s_level'] == 'Administrator') { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Perusahaan Penjamin</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
	 <?php } ?>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simpus/master_ref/perusahaan_penjamin/print_perusahaan_penjamin.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simpus/master_ref/perusahaan_penjamin/print_perusahaan_penjamin_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../simpus/master_ref/perusahaan_penjamin/print_perusahaan_penjamin_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Perusahaan Penjamin</th>
			<th>Alamat</th>
			<th>Telp</th>
			<th width="50px">Aktif</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$perusahaan_penjamin = new perusahaan_penjamin($pdo);		
		$query = "SELECT * FROM	perusahaan_penjamin";		
		$perusahaan_penjamin->view($query);
	?>
	</tbody>
</table>


