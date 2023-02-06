<?php

require '_header.php';

$result = mysqli_query($connect,"SELECT b.nama, c.nama_kriteria, a.angka_penilaian, a.nilai_bobot, c.bobot, c.kategori 
									FROM nilai_topsis a 
										JOIN guru b USING(nip) 
										JOIN kriteria c USING(kode_kriteria)");
$data = array();
$data_kriteria = array();
$bobot = array();
$kategori = array();
$nilai_kuadrat = array();

if($result) {
	if($result->num_rows > 0) {
		while($row=$result->fetch_object()) {
			if(!isset($data[$row->nama])) {
				$data[$row->nama] = array();
			}
			if(!isset($data[$row->nama][$row->nama_kriteria])) {
				$data[$row->nama][$row->nama_kriteria] = array();
			}
			if(!isset($nilai_kuadrat[$row->nama_kriteria])) {
				$nilai_kuadrat[$row->nama_kriteria] = 0;
			}

			$bobot[$row->nama_kriteria] = $row->bobot;
			$kategori[$row->nama_kriteria] = $row->kategori;
			$data[$row->nama][$row->nama_kriteria] = $row->nilai_bobot;
			$angka_penilaian[$row->nama][$row->nama_kriteria] = $row->angka_penilaian;
			$nilai_kuadrat[$row->nama_kriteria] += pow($row->nilai_bobot,2);
			$data_kriteria[] = $row->nama_kriteria;
		}
	}
} else {
	echo "Data Tidak Bisa Diakses";
}

$kriteria = array_unique($data_kriteria);
$jml_kriteria = count($kriteria);

echo "<script>window.print();</script>";

?>

<body onload="timer=window.setTimeout('move()',5000);">

			<div class="col-md-12">
				<h2>Penilaian Guru Terbaik dengan Metode TOPSIS</h2>
				<hr />
				<p>
					<b>Evaluation Matrix (x<sub>ij</sub>)</b>
					<table class="table table-bordered table-hover table-striped text-center">
						<thead>
							<tr>
								<th rowspan='3'>No</th>
								<th rowspan='3'>Alternatif</th>
								<th rowspan='3'>Nama</th>
								<th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
					        </tr>
					        <tr>
					        	<?php
					        		foreach($kriteria as $k)
					        			echo "<th>{$k}</th>\n";
					        	?>
					        </tr>
					        <tr>
					        	<?php
					        		for($n=1;$n<=$jml_kriteria;$n++)
					        			echo "<th>C{$n}</th>";
					        	?>
					        </tr>
				      	</thead>
				      	<tbody>
				        	<?php
					        	$i=0;
					        	foreach($data as $nama=>$krit){
									++$i;
					            	$i;
					            	$nama;
					          		foreach($kriteria as $k){  
					            		$krit[$k];
					          		}
					        	}
								$i=0;
								foreach($angka_penilaian as $nama=>$krit){
					        		echo "<tr>
					        			<td>".(++$i)."</td>
					            		<th>A{$i}</th>
					            		<td>{$nama}</td>";
					          		foreach($kriteria as $k){  
					            		echo "<td align='center'>{$krit[$k]}</td>";
					          		}
					          		echo "</tr>\n";
					        	}
				       		?>
				      	</tbody>
					</table>

					<hr />

					<?php $jml_kriteria ?>
					          	<?php
					          		foreach($kriteria as $k)
					            		$k;
					          	?>
					          	<?php
					          		for($n=1;$n<=$jml_kriteria;$n++)
					            		$n;
					          	?>
					        <?php
				        		$i=0;
				        		foreach($data as $nama=>$krit){
				          			++$i;
				            		$i;
				            		$nama;
				          			foreach($kriteria as $k){  
				            			round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4);
				          			}
				        		}
				        	?>
							
							<?php $jml_kriteria; ?>
					          	<?php
					          		foreach($kriteria as $k)
					            		$k;
					          	?>
					          	<?php
					          		for($n=1;$n<=$jml_kriteria;$n++)
					            		$n;
					          	?>
				        	<?php
				        		$i=0;
				        		$y=array();
				        		foreach($data as $nama=>$krit){
				          			++$i;
				            		$i;
				            		$nama;
				          			foreach($kriteria as $k){  
				            			$y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
				            			$y[$k][$i-1];
				          			}
				        		}
				        	?>
							<?php $jml_kriteria ?>
				          		<?php
				          			foreach($kriteria as $k)
				            			$k;
				          		?>
				          		<?php
				          			for($n=1;$n<=$jml_kriteria;$n++)
				            			$n;
				          		?>

				          		<?php
				          			$yplus=array();
				          			foreach($kriteria as $k){
				            			$yplus[$k]=($kategori[$k]=='Benefit/Keuntungan'?max($y[$k]):min($y[$k]));
										$yplus[$k];
				          			}
				          		?>
								
								<?php $jml_kriteria ?>

				          		<?php
				          			foreach($kriteria as $k)
										$k;
				          		?>

				          		<?php
				          			for($n=1;$n<=$jml_kriteria;$n++)
				            			$n;
				          		?>

				          		<?php
				          			$ymin=array();
				          			foreach($kriteria as $k){
				            			$ymin[$k]=$kategori[$k]=='Cost/Biaya'?max($y[$k]):min($y[$k]);
				            			$ymin[$k];
				          			}
				          		?>
							
							<?php
				        		$i=0;
				        		$dplus=array();
				        		foreach($data as $nama=>$krit){
				         	 		++$i;
				            		$i;
				            		$nama;
				          			foreach($kriteria as $k){  
				            			if(!isset($dplus[$i-1])) $dplus[$i-1]=0;
				            				$dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
				          			}
				          			round(sqrt($dplus[$i-1]),4);
				        		}
				        	?>

				        	<?php
				        		$i=0;
				        		$dmin=array();
				        		foreach($data as $nama=>$krit){
									++$i;
				            		$i;
				            		$nama;
				          			foreach($kriteria as $k){  
				            			if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
				            				$dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
				          			}
									round(sqrt($dmin[$i-1]),4);
				        		}
				        	?>

				        	<?php
				        		$i=0;
				        		$V=array();
								$terpilih=0;
				        		foreach($data as $nama=>$krit){
									++$i;
				            		$i;
				            		$nama;
				          			foreach($kriteria as $k){  
				            			$V[$i-1]=round($dmin[$i-1]/($dmin[$i-1]+$dplus[$i-1]),4);
				          			}
				          			$V[$i-1];
									if($terpilih<$V[$i-1]) {
										$terpilih = $V[$i-1];
										$A_terpilih = "(A$i)";
										$nama_terpilih = $nama;
									}
				        		}
				        	?>

					<p id="hasil_terpilih">Guru terbaik yang terpilih adalah <b><?php echo "$nama_terpilih $A_terpilih"; ?></b> 
						dengan nilai preferensi <b><?php echo $terpilih; ?></b>.</p>
				</p>
			</div>

<?php

$connect->close(); 
$result->close();
require '_footer.php';

?>