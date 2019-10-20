<?php
include_once 'header.php';
include_once 'includes/candidate.inc.php';
include_once 'includes/criteria.inc.php';
include_once 'includes/value.inc.php';
$pgn1 = new candidate($db);
$pgn2 = new criteria($db);
$pgn3 = new value($db);

$ia = isset($_GET['ia']) ? $_GET['ia'] : die('ERROR: missing ID.');
$ik = isset($_GET['ik']) ? $_GET['ik'] : die('ERROR: missing ID.');

include_once 'includes/ranking.inc.php';
$eks = new ranking($db);

$eks->ia = $ia;
$eks->ik = $ik;

$eks->readOne();

if($_POST){

	$eks->nn = $_POST['nn'];
	
	if($eks->update()){
		echo "<script>location.href='ranking.php'</script>";
	} else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Ubah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Ubah ranking</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="nn">value</label>
				    <select class="form-control" id="nn" name="nn">
				    	<option><?php echo $eks->nn; ?></option>
				    	<?php
						$stmt4 = $pgn3->readAll();
						while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
							extract($row4);
							echo "<option value='{$jum_nilai}'>{$ket_nilai}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Ubah</button>
				  <button type="button" onclick="location.href='ranking.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>