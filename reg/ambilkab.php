
<?php
	include_once '../config/koneksi.php';
	include_once 'class.pasien.php';
	$kab 	= $_GET['id_kab'];
	$pasien = new pasien($pdo);
	$query 	= " SELECT * FROM wilayah_kecamatan WHERE id_kab = $kab ORDER BY nama_kec ";
	$pasien->kecamatan($query);
?>