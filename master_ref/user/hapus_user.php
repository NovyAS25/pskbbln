<?php
/* 
	-- --------------------------------------------------------
	-- --------------------------------------------------------
	-- Nama File : hapus_user.php  
	-- Author    : Muhammad Ibrohim
	-- Email     : muhammadibrohim01@gmail.com
	-- Website   : baimibrohim.blogspot.com
	-- Copyright [c] 2016 Baim
*/
	include_once '../../config/koneksi.php';
	include_once 'class.user.php';
	$user = new user($pdo);
	$id = $_GET['nip'];
	$user->delete($id);
	header('location:data_user.php');
	
?>