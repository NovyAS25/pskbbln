<?php
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	$id = $_GET['resep_id'];
	$dok->deleteResep($id);
	header('location:resep.php');
?>