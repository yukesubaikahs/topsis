<?php

require '_header.php';

$result = mysqli_query($connect,"SELECT b.nama, c.nama_kriteria, a.nilai_bobot, c.bobot, c.kategori 
									FROM nilai_topsis a 
										JOIN karyawan b USING(nip) 
										JOIN kriteria c USING(kode_kriteria) ORDER BY b.nama ASC");
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
			$nilai_kuadrat[$row->nama_kriteria] += pow($row->nilai_bobot,2);
			$data_kriteria[] = $row->nama_kriteria;
		}
	}
} else {
	echo "Data Tidak Bisa Diakses";
}

$kriteria = array_unique($data_kriteria);
$jml_kriteria = count($kriteria);

?>
			<div class="col-md-12">
				<h2>Penilaian Karyawan Terbaik dengan Metode TOPSIS</h2>
				<hr>
				<p>
					<b>Lihat Karyawan Terpilih</b> <a href='#' class='btn btn-success glyphicon glyphicon-search' data-target='#ModalView' data-toggle='modal' title='Lihat Karyawan Terpilih'></a> 
					<a href='print_laporan.php' target="_self" class='btn btn-success glyphicon glyphicon-print' title='Print Laporan'>
					</a>
				</p>
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

					<table class="table table-bordered table-hover table-striped text-center">
				      	<b>Rating Kinerja Ternormalisasi (r<sub>ij</sub>)</b>
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
				          			echo "<tr>
				            			<td>".(++$i)."</td>
				            			<th>A{$i}</th>
				            			<td>{$nama}</td>";
				          			foreach($kriteria as $k){  
				            			echo "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)."</td>";
				          			}
				          			echo "</tr>\n";
				        		}
				        	?>
				      	</tbody>
				    </table>

				    <hr />

				    <table class="table table-bordered table-hover table-striped text-center">
				      	<b>Rating Bobot Ternormalisasi(y<sub>ij</sub>)</b>
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
				        		$y=array();
				        		foreach($data as $nama=>$krit){
				          			echo "<tr>
				           	 			<td>".(++$i)."</td>
				            			<th>A{$i}</th>
				            			<td>{$nama}</td>";
				          			foreach($kriteria as $k){  
				            			$y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),4)*$bobot[$k];
				            			echo "<td align='center'>".$y[$k][$i-1]."</td>";
				          			}
				          			echo "</tr>\n";
				        		}
				        	?>
				      	</tbody>
				    </table>

				    <hr />

				    <table class="table table-bordered table-hover table-striped text-center">
				      	<b>Solusi Ideal positif (A<sup>+</sup>)</b>
				      	<thead>
				        	<tr>
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
				            			echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
				          		?>
				        	</tr>
				      	</thead>
				      	<tbody>
				        	<tr>
				          		<?php
				          			$yplus=array();
				          			foreach($kriteria as $k){
				            			$yplus[$k]=($kategori[$k]=='Benefit/Keuntungan'?max($y[$k]):min($y[$k]));
				            			echo "<th class='text-center'>{$yplus[$k]}</th>";
				          			}
				          		?>
				        	</tr>
				      	</tbody>
				    </table>

				    <hr />

				    <table class="table table-bordered table-hover table-striped text-center">
				      	<b>Solusi Ideal negatif (A<sup>-</sup>)</b>
				      	<thead>
				        	<tr>
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
				            			echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
				          		?>
				        	</tr>
				      	</thead>
				      	<tbody>
				        	<tr>
				          		<?php
				          			$ymin=array();
				          			foreach($kriteria as $k){
				            			$ymin[$k]=$kategori[$k]=='Cost/Biaya'?max($y[$k]):min($y[$k]);
				            			echo "<th class='text-center'>{$ymin[$k]}</th>";
				          			}
				          		?>
				        	</tr>
				      	</tbody>
				    </table>

				    <hr />

				    <table class="table table-bordered table-hover table-striped text-center">
				      	<b>Jarak positif (D<sub>i</sub><sup>+</sup>)</b>
				      	<thead>
				        	<tr>
				          		<th>No</th>
				          		<th>Alternatif</th>
				          		<th>Nama</th>          
				          		<th>D<sup>+</sup></th>
				        	</tr>
				      	</thead>
				      	<tbody>
				        	<?php
				        		$i=0;
				        		$dplus=array();
				        		foreach($data as $nama=>$krit){
				         	 		echo "<tr>
				            			<td>".(++$i)."</td>
				            			<th class='text-center'>A{$i}</th>
				            			<td>{$nama}</td>";
				          			foreach($kriteria as $k){  
				            			if(!isset($dplus[$i-1])) $dplus[$i-1]=0;
				            				$dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
				          			}
				          			echo "<td>".round(sqrt($dplus[$i-1]),4)."</td>
				           				</tr>\n";
				        		}
				        	?>
				      	</tbody>
				    </table>

				    <hr />

				    <table class="table table-bordered table-hover table-striped text-center">
				      	<b>Jarak negatif (D<sub>i</sub><sup>-</sup>)</b>
				      	<thead>
				        	<tr>
				          		<th>No</th>
				          		<th>Alternatif</th>
				          		<th>Nama</th>          
				          		<th>D<sup>-</sup></th>
				        	</tr>
				      	</thead>
				      	<tbody>
				        	<?php
				        		$i=0;
				        		$dmin=array();
				        		foreach($data as $nama=>$krit){
				          			echo "<tr>
				            			<td>".(++$i)."</td>
				            			<th class='text-center'>A{$i}</th>
				            			<td>{$nama}</td>";
				          			foreach($kriteria as $k){  
				            			if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
				            				$dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
				          			}
				          			echo "<td>".round(sqrt($dmin[$i-1]),4)."</td>
				           				</tr>\n";
				        		}
				        	?>
				      	</tbody>
				    </table>

				    <hr />

				    <table class="table table-bordered table-hover table-striped text-center">
				      	<b>Nilai Preferensi(V<sub>i</sub>)</b>
				      	<thead>
				        	<tr>
				          		<th>No</th>
				          		<th>Alternatif</th>
				          		<th>Nama</th>
				          		<th>V<sub>i</sub></th>
				        	</tr>
				      	</thead>
				      	<tbody>
				        	<?php
				        		$i=0;
				        		$V=array();
								$terpilih=0;
				        		foreach($data as $nama=>$krit){
				          			echo "<tr>
				            			<td>".(++$i)."</td>
				            			<th class='text-center'>A{$i}</th>
				            			<td>{$nama}</td>";
				          			foreach($kriteria as $k){  
				            			$V[$i-1]=round($dmin[$i-1]/($dmin[$i-1]+$dplus[$i-1]),4);
				          			}
				          			echo "<td>{$V[$i-1]}</td></tr>\n";
									if($terpilih<$V[$i-1]) {
										$terpilih = $V[$i-1];
										$A_terpilih = "(A$i)";
										$nama_terpilih = $nama;
									}
				        		}
				        	?>
				      	</tbody>
				    </table>

				    <hr />

					<p id="hasil_terpilih">Karyawan terbaik yang terpilih adalah <b><?php echo "$nama_terpilih $A_terpilih"; ?></b> 
						dengan nilai preferensi <b><?php echo $terpilih; ?></b>.</p>
				</p>
			</div>

		<!-- Modal Popup untuk Add--> 
		<div id="ModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
    			<div class="modal-content">

        			<div class="modal-header">
            			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            			<h4 class="modal-title" id="myModalLabel">Karyawan Terbaik yang Terpilih</h4>
        			</div>

        			<div class="modal-body">
            
                		<table class="table table-default text-center">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Nilai Preferensi</th>
						        </tr>
					      	</thead>
					      	<tbody>
					        	<tr>
						        	<td><?php echo $nama_terpilih." ".$A_terpilih; ?></td>
						        	<td><?php echo $terpilih; ?></td>
						        </tr>
					      	</tbody>
						</table>
            		</div>
        		</div>
    		</div>
		</div>

<?php

$connect->close(); 
$result->close();
require '_footer.php';

?>