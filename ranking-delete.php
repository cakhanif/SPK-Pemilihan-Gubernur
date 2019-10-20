<?php
include_once "includes/config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/ranking.inc.php';
$pro = new ranking($db);
$ia = isset($_GET['ia']) ? $_GET['ia'] : die('ERROR: missing ID.');
$pro->ia = $ia;
$ik = isset($_GET['ik']) ? $_GET['ik'] : die('ERROR: missing ID.');
$pro->ik = $ik;
	
if($pro->delete()){
	echo "<script>location.href='ranking.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='ranking.php';</script>";
		
}
?>
