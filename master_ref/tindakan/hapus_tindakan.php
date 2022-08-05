<?php
	include_once '../../config/koneksi.php';
	include_once 'class.tindakan.php';
	$tindakan1 = new tindakan($pdo);
	$id = $_GET['id_tindakan'];
	$tindakan1->delete($id);
?>