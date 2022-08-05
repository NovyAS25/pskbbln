<?php
	require_once '../config/koneksi.php';
	require_once 'class.poli.php';
	$dok = new poli($pdo);
	$id = $_GET['rujuklab_id'];
	$dok->deleteRujukLAB($id);
	header('location:rujuklab.php');
?>