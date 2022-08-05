<?php
	include_once '../../config/koneksi.php';
	include_once 'class.perusahaan_penjamin.php';
	$perusahaan_penjamin = new perusahaan_penjamin($pdo);
	$id = $_GET['id_perusahaan_penjamin'];
	$perusahaan_penjamin->delete($id);
?>