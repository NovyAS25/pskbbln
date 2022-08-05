<?php
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	$id = $_GET['rujuk_id'];
	$dok->deleteRujuk($id);
	header('location:rujuk.php');
?>