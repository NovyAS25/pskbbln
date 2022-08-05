<?php
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	$id = $_GET['poli_id'];
	$dok->deleteTindakan($id);
	header('location:tindakan.php');
?>