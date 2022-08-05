<?php 
/* 
	-- --------------------------------------------------------
	-- --------------------------------------------------------
	-- Nama File : print_user.php  
	-- Author    : Muhammad Ibrohim
	-- Email     : muhammadibrohim01@gmail.com
	-- Website   : baimibrohim.blogspot.com
	-- Copyright [c] 2016 Baim
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Document</title>
<link rel="icon" type="image/jpg" href="../../assets/images/rs.jpg" />
<link href="../../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
</style>
<style type="text/css">
<!--
.style1 {
	font-family: inherit;
	font-weight: bold;
	font-size: 24px;
}
.style2 {font-size: 16px}
-->
</style>
</head>
<?php
session_start();
include_once '../../config/koneksi.php';
include_once 'class.user.php';
?>
<body>
<p>&nbsp;</p>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<table width="100%">
  <tr>
    <td height="72"><div align="left"><img src="../../../simpus/assets/images/logo_lap.jpg" width="67" height="54" /></div></td>
    <td valign="bottom"><div align="left" class="style1">
      <p>PUSKESMAS BUGEL TANGERANG - BANTEN <br /> 
        <span class="style2">Jl. Aria Santika No.15113, Cikokol, Kec. Tangerang, Kota Tangerang <br /> (021) 5588887</span> </p>      
    </div></td>
    <td>&nbsp;</td>
  </tr>  
</table>
<hr />
<h3 class="header smaller lighter blue">Daftar User Login</h3>
</div>
<table width="100%" border="1" align="Top" cellpadding="5" cellspacing="5" padding-top="0px">
	<thead>
		<tr>
			<th>Nip</th>
			<th>Nama Lengkap</th>
			<th>Email</th>
			<th>No.Telp.</th>
			<th>Level</th>
			<th>Aktif</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$user = new user($pdo);
		if ($_SESSION['s_level'] == 'Administrator'){
			$query = "SELECT * FROM v_print_user ";	
		}else{			
			$query = "SELECT * FROM v_print_user WHERE nip ='$_SESSION[s_user]'";	
		}		
		$user->prin($query);
	?>
	</tbody>
</table>
<p></p>
<p><button class="style12" id="tombol" onclick="window.print()" ><i class="icon-print"></i>Print</button></p>
</div>
</body>
</html>