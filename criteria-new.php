<?php
include_once 'header.php';
include_once 'includes/Value.php';
$pgn = new Value($db);
if($_POST){
	
	include_once 'includes/Criteria.php';
	$eks = new Criteria($db);

	$eks->kt = $_POST['kt'];
	$eks->tp = $_POST['tp'];
	$eks->jm = $_POST['jm'];
	
	if($eks->insert()){
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil Tambah Data!</strong> Tambah lagi atau <a href="criteria.php">lihat semua data</a>.
</div>
<?php
	}
	
	else{
?>
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal Tambah Data!</strong> Terjadi kesalahan, coba sekali lagi.
</div>
<?php
	}
}
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-8">
		  	<div class="page-header">
			  <h5>Tambah criteria</h5>
			</div>
			
			    <form method="post">
				  <div class="form-group">
				    <label for="kt">Nama criteria</label>
				    <input type="text" class="form-control" id="kt" name="kt" required>
				  </div>
				  <div class="form-group">
				    <label for="tp">Tipe criteria</label>
				    <select class="form-control" id="tp" name="tp">
				    	<option value='benefit'>Benefit</option>
				    	<option value='cost'>Cost</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="jm">Bobot criteria</label>
				    <select class="form-control" id="jm" name="jm">
				    	<?php
						$stmt2 = $pgn->readAll();
						while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
							extract($row2);
							echo "<option value='{$jum_nilai}'>{$jum_nilai}</option>";
						}
					    ?>
				    </select>
				  </div>
				  <button type="submit" class="btn btn-primary">Simpan</button>
				  <button type="button" onclick="location.href='criteria.php'" class="btn btn-success">Kembali</button>
				</form>
			  
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<?php include_once 'sidebar.php'; ?>
		  </div>
		</div>
		<?php
include_once 'footer.php';
?>