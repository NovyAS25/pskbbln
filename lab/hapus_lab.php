<?php
	include_once '../config/koneksi.php';
	include_once 'class.lab.php';
	$lab = new lab($pdo);
	$id = $_GET['id_lab'];
	$lab->delete($id);
	header('location:laboratorium.php');
?>