<?php
	include_once '../../config/koneksi.php';
	include_once 'class.dokter.php';
	$dokter = new dokter($pdo);
	$id = $_GET['id_dokter'];
	$dokter->delete($id);
?>