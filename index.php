<?php
include_once 'header.php';
include_once 'includes/Value.php';
$pro3 = new Value($db);
$stmt3 = $pro3->readAll();
include_once 'includes/Candidate.php';
$pro1 = new Candidate($db);
$stmt1 = $pro1->readAll();
$stmt4 = $pro1->readAll();
include_once 'includes/Criteria.php';
$pro2 = new Criteria($db);
$stmt2 = $pro2->readAll();
?>
		<div class="row">
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<div class="page-header">
			  <h5>value Preferensi</h5>
			</div>
			<div class="panel panel-default">
			  <div class="panel-body">
			    <ol>
			    	<?php
					while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
					?>
				  	<li><?php echo $row3['ket_nilai'] ?> (<?php echo $row3['jum_nilai'] ?>)</li>
				  	<?php
					}
				  	?>
				</ol>
			  </div>
			</div>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<div class="page-header">
			  <h5>criteria</h5>
			</div>
			<div class="panel panel-default">
			  <div class="panel-body">
			    <ol class="list-unstyled">
			    	<?php
			    	$no=1;
					while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
					?>
				  	<li><?php echo $no++ ?>. <?php echo $row2['nama_kriteria'] ?></li>
				  	<?php
					}
				  	?>
				</ol>
			  </div>
			</div>
		  </div>
		  <div class="col-xs-12 col-sm-12 col-md-4">
		  	<div class="page-header">
			  <h5>candidate</h5>
			</div>
			<div class="panel panel-default">
			  <div class="panel-body">
			    <ol class="list-unstyled">
			    	<?php
			    	$no=1;
					while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)){
					?>
				  	<li><?php echo $no++ ?>. <?php echo $row1['nama_candidate'] ?></li>
				  	<?php
					}
				  	?>
				</ol>
			  </div>
			</div>
		  </div>
		</div>
		<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/highcharts.js"></script>
	<script src="js/exporting.js"></script>
	<script>
	var chart1; // globally available
	$(document).ready(function() {
	      chart1 = new Highcharts.Chart({
	         chart: {
	            renderTo: 'container2',
	            type: 'column'
	         },  
	         title: {
	            text: 'Grafik Perangkingan '
	         },
	         xAxis: {
	            categories: ['candidate']
	         },
	         yAxis: {
	            title: {
	               text: 'Jumlah value'
	            }
	         },
	              series:            
	            [
	            <?php
	            while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
	                  ?>
	                 //data yang diambil dari database dimasukan ke variable nama dan data
	                 //
	                  {
	                      name: '<?php echo $row4['nama_candidate'] ?>',
	                      data: [<?php echo $row4['hasil_candidate'] ?>]
	                  },
	                  <?php } ?>
	            ]
	      });
	   });  
	   </script>
	</body>
</html>