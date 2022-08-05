<?php
session_start();
include_once '../../config/koneksi.php';
include_once 'class.tindakan.php';
?>
<?php if ($_SESSION['s_level'] == 'Administrator') { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar Tindakan</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a>
	 <?php } ?>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simpus/master_ref/tindakan/print_tindakan.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
	 <a href="javascript:void(0)" target="" onclick="window.open('../simpus/master_ref/tindakan/print_tindakan_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
	 <a href="javascript:void(0)" onclick="window.open('../simpus/master_ref/tindakan/print_tindakan_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr align="center">
			<th>Tindakan</th>
			<th>Harga</th>
			<th align="center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$tindakan = new tindakan($pdo);		
		$query = "SELECT * FROM tindakan";		
		$tindakan->view($query);
	?>
	</tbody>
</table>


