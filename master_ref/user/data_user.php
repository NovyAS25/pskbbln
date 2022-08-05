<?php
/* 
	-- --------------------------------------------------------
	-- --------------------------------------------------------
	-- Nama File : data_user.php  
	-- Author    : Muhammad Ibrohim
	-- Email     : muhammadibrohim01@gmail.com
	-- Website   : baimibrohim.blogspot.com
	-- Copyright [c] 2016 Baim
*/
session_start();
require_once '../../config/koneksi.php';
require_once '../user/class.user.php';
?>
<?php if ($_SESSION['s_level'] == 'Administrator'){ //|| $_SESSION['s_level'] == 'admin' ) { ?>
<div id="alert"></div>
<div class="row-fluid">
<h3 class="header smaller lighter blue">Daftar User</h3>
	<div class="table-header">
		<a href="javascript:void(0)" onclick="tambahForm()" class="btn btn-primary" ><i class="icon-plus icon-white"></i>Tambah</a> <?php } ?>
		<a href="javascript:void(0)" target="" onclick="window.open('../simpus/master_ref/user/print_user.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-print icon-white"></i>Print</a>
		<a href="javascript:void(0)" target="" onclick="window.open('../simpus/master_ref/user/print_user_pdf.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export PDF</a>
		<a href="javascript:void(0)" onclick="window.open('../simpus/master_ref/user/print_user_xls.php','name','width=900,height=600')" class="btn btn-primary" ><i class="icon-download icon-download"></i>Export Xls</a>
	</div>

<table id="tabeldata" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>Nip</th>
			<th>Nama Lengkap</th>
			<th>Email</th>
			<th>No.Telp.</th>
			<th>Level</th>
			<th>Aktif</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$user = new user($pdo);
		if ($_SESSION['s_level'] == 'Administrator'){
			$query = "SELECT * FROM	users ";	
		}else{			
			$query = "SELECT * FROM users WHERE nip ='$_SESSION[s_user]'";	
		}		
		$user->view($query);
	?>
	</tbody>
</table>

