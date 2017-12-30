<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/kandidat.inc.php';
$pro = new Kandidat($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;
	
if($pro->delete()){
	echo "<script>location.href='kandidat.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='kandidat.php';</script>";
		
}
?>
