<?php
	include_once '../config/koneksi.php';
	include_once 'class.apotik.php';
	$apotik = new apotik($pdo);
	$id = $_GET['id_obat'];
	$apotik->delete($id);
	header('location:data_apotik.php');
?>