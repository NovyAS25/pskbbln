
<?php
	include_once '../config/koneksi.php';
	include_once 'class.pasien.php';
	$kec 	= $_GET['id_kec'];
	$pasien = new pasien($pdo);
	$query 	= " SELECT * FROM wilayah_desa WHERE id_kec = $kec ORDER BY nama_kel ";
	$pasien->kelurahan($query);
?>