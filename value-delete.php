<?php
include_once "includes/Config.php";
$database = new Config();
$db = $database->getConnection();

include_once 'includes/Value.php';
$pro = new Value($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;
	
if($pro->delete()){
	echo "<script>location.href='value.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='value.php';</script>";
		
}
?>
