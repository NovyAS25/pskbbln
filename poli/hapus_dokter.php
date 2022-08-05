<?php
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	$id = $_GET['id_tindakan_poli'];
	$dok->deleteDokter($id);
	header('location:dokter.php');
?>