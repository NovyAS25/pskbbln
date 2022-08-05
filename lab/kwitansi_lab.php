
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Document</title>
<link rel="icon" type="image/png" href="../assets/images/favicon.png" />
<link href="../assets/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
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
	include_once '../config/koneksi.php';
	include_once '../config/fungsi_indotgl.php';
	include_once 'class.lab.php';
	$lab = new lab($pdo);
	if(isset($_GET['reg_no']))
	    {
	      $id = $_GET['reg_no'];
	      extract($lab->getID($id));
	      if ($lab->getDokter($id)){
	      	extract($lab->getDokter($id));
	      }
	      
	        
	}else{
	      $id = $_POST['reg_no'];
	      extract($lab->getID($id));
	}
?>
<body>
<p>&nbsp;</p>
<div style="width:95%;margin:0 auto;">
<div class="row-fluid">
<table width="100%">
  <tr>
    <td height="72"><div align="left"><img src="../../simpus/assets/images/logo_lap.jpg" width="67" height="54" /></div></td>
    <td valign="bottom"><div align="left" class="style1">
      <p>PUSKESMAS BUGEL TANGERANG - BANTEN <br /> 
        <span class="style2">Jl. Aria Santika No.15113, Cikokol, Kec. Tangerang, Kota Tangerang <br /> (021) 5588887</span> </p>      
    </div></td>
    <td>&nbsp;</td>
  </tr>  
</table>
<hr class="style1">
<h3 class="header smaller lighter blue"><div align="center"> Harga Tindakan  Laboratorium </div></h3>
</div>
<table width="100%">
  <tr>
    <td width="17%">MR / Reg No </td>
    <td width="1%">:</td>
    <td width="31%"><?php echo $mr ." /".$reg_no; ?></td>
    <td width="8%">&nbsp;</td>
    <td width="21%">Poli / Unit Tujuan </td>
    <td width="22%">: <?php echo $poli; ?></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td><?php echo $nama; ?></td>
    <td>&nbsp;</td>
    <td>Diagnosa Awal </td>
    <td>: <?php echo $diagnosa; ?></td>
  </tr>
  <tr>
    <td>Jenis Kelamin </td>
    <td>:</td>
    <td><?php echo $jenis_kelamin ?></td>
    <td>&nbsp;</td>
    <td>Pembayaran</td>
    <td>: <?php echo $nama_perusahaan_penjamin ?></td>
  </tr>
  <tr>
    <td>Tempat Tgl Lahir</td>
    <td>:</td>
    <td><?php echo $tempat_lahir.", ".tgl_indo($tgl_lahir); ?></td>
    <td>&nbsp;</td>
    <td>Dokter Pemeriksa </td>
    <td>: <?php if ($lab->getDokter($id)){ echo $nama_dokter; } ?></td>
  </tr>
  <tr>
    <td valign="top">Alamat</td>
    <td valign="top">:</td>
    <td><?php echo $alamat.", Desa ".$nama_kel.", Kec. ".$nama_kec.", ".$nama_kab."-".$nama_prov; ?></td>
    <td>&nbsp;</td>
    <td valign="top">Diagnosa Dokter </td>
    <td valign="top">: <?php if ($lab->getDokter($id)){ echo $diagnosa_dokter;} ?></td>
  </tr>
</table>
<hr />
<table width="100%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td width="7%"><div align="center"><strong>No.</strong></div></td>
    <td width="59%"><strong>Tindakan</strong></td>
    <td width="34%"><div align="center"><strong>Harga</strong></div></td>
    </tr>
  <tbody>
		<?php	
		$query = "SELECT * FROM v_lab where reg_no = '$id' ";		
		$lab->viewkwitansi($query);
	?>
	</tbody>
  </tr>
</table>
<hr />
<table width="100%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td width="66%"><strong>Total </strong></td>
    <td width="34%"><strong>
      <?php	
			$query = "SELECT * FROM v_lab where reg_no = '$id' ";		
			$lab->total($query);
		?>
    </strong></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="65%">&nbsp;</td>
    <td width="35%">Tangerang, <?php echo date('d-M-Y') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>kasir</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>( ............................. ) </td>
  </tr>
</table>
<p>&nbsp;</p>
<p><button class="style12" id="tombol" onclick="window.print()" ><i class="icon-print"></i>Print</button></p>
</div>
</body>
</html>