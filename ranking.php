<?php
include_once 'header.php';
include_once 'includes/Candidate.php';
$pro1 = new Candidate($db);
$stmt1 = $pro1->readAll();
include_once 'includes/Criteria.php';
$pro2 = new Criteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/Ranking.php';
$pro = new Ranking($db);
$stmt = $pro->readKhusus();
?>
	<br/>
	<div>
	
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#lihat" aria-controls="lihat" role="tab" data-toggle="tab">Lihat Semua Data</a></li>
	    <li role="presentation"><a href="#ranking" aria-controls="ranking" role="tab" data-toggle="tab">Perangkingan</a></li>
	    <li role="presentation"><a href="ranking-baru.php" role="tab">Tambah Data</a></li>
	  </ul>
	
	  <!-- Tab panes -->
	  <div class="tab-content">
	    <div role="tabpanel" class="tab-pane active" id="lihat">
	    	<br/>
	    	<div class="row">
				<div class="col-md-6 text-left">
					<h4>Data ranking</h4>
				</div>
				<div class="col-md-6 text-right">
					<button onclick="location.href='ranking-baru.php'" class="btn btn-primary">Tambah Data</button>
				</div>
			</div>
			<br/>
			<table width="100%" class="table table-striped table-bordered" id="tabeldata">
		        <thead>
		            <tr>
		                <th width="30px">No</th>
		                <th>candidate</th>
		                <th>criteria</th>
		                <th>value</th>
		                <th width="100px">Aksi</th>
		            </tr>
		        </thead>
		
<!-- 		        <tfoot>
		            <tr>
		                <th>No</th>
		                <th>Alternatif</th>
		                <th>criteria</th>
		                <th>value</th>
		                <th>Aksi</th>
		            </tr>
		        </tfoot> -->
		
		        <tbody>
		<?php
		$no=1;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <td><?php echo $no++ ?></td>
		                <td><?php echo $row['nama_candidate'] ?></td>
		                <td><?php echo $row['nama_kriteria'] ?></td>
		                <td><?php echo $row['nilai_rangking'] ?></td>
		                <td class="text-center">
							<a href="ranking-ubah.php?ia=<?php echo $row['id_candidate'] ?>&ik=<?php echo $row['id_kriteria'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<a href="ranking-hapus.php?ia=<?php echo $row['id_candidate'] ?>&ik=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
					    </td>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
		    		
	    </div>

	    <div role="tabpanel" class="tab-pane" id="ranking">
	    	<br/>
	    	<h4>Normalisasi R Perangkingan</h4>
			<table width="100%" class="table table-striped table-bordered">
		        <thead>
		            <tr>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">candidate</th>
		                <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">criteria</th>
		                <th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
		            </tr>
		            <tr>
		            <?php
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
		                <th><?php echo $row2['nama_kriteria'] ?></th>
		            <?php
					}
					?>
		            </tr>
		        </thead>
		
		        <tbody>
		<?php
		while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
		?>
		            <tr>
		                <th><?php echo $row1['nama_candidate'] ?></th>
		                <?php
		                $a= $row1['id_candidate'];
						$stmtr = $pro->readR($a);
						while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)){
							$b = $rowr['id_kriteria'];
							$tipe = $rowr['tipe_kriteria'];
							$bobot = $rowr['bobot_kriteria'];
						?>
		                <td>
		                	<?php 
		                	if($tipe=='benefit'){
		                		$stmtmax = $pro->readMax($b);
								$maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
								echo $nor = $rowr['nilai_rangking']/$maxnr['mnr1'];
							} else{
								$stmtmin = $pro->readMin($b);
								$minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
								echo $nor = $minnr['mnr2']/$rowr['nilai_rangking'];
							}
							$pro->ia = $a;
							$pro->ik = $b;
							$pro->nn2 = $nor;
							$pro->nn3 = $bobot*$nor;
							$pro->normalisasi();
		                	?>
		                </td>
		                <?php
		                }
						?>
						<td>
							<?php 
							$stmthasil = $pro->readHasil($a);
							$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
							echo $hasil['bbn'];
							$pro->ia = $a;
							$pro->has = $hasil['bbn'];
							$pro->hasil();
							?>
						</td>
		            </tr>
		<?php
		}
		?>
		        </tbody>
		
		    </table>
		    	
	    </div>
	  </div>
	
	</div>
<?php
include_once 'footer.php';
?>