<?php
include_once 'includes/Config.php';
$database = new Config();
$db = $database->getConnection();

include_once 'includes/Candidate.php';
$pro = new Candidate($db);
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$pro->id = $id;
	
if($pro->delete()){
	echo "<script>location.href='candidate.php';</script>";
} else{
	echo "<script>alert('Gagal Hapus Data');location.href='candidate.php';</script>";
		
}
?>
