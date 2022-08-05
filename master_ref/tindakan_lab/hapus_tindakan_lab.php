<?php
	include_once '../../config/koneksi.php';
	include_once 'class.tindakan_lab.php';
	$tindakan_lab = new tindakan_lab($pdo);
	$id = $_GET['id_tindakan_lab'];
	$tindakan_lab->delete($id);
?>