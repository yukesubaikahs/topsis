<?php

require '_header.php';

?>
			<div class="col-md-12">
				<h2>Penilaian  Karyawan Terbaik dengan Metode TOPSIS</h2>
				<hr>
				<p>
					<b>Tabel Keterangan Penilaian</b>
					<table class="table table-bordered table-hover table-striped text-center">
						<tr>
							<!-- <th class="text-center">Range Penilaian</th> -->
							<th class="text-center">Bobot</th>
							<th class="text-center">Keterangan</th>
						</tr>
						<?php
							$result_bobot = mysqli_query($connect,"SELECT * FROM bobot ORDER BY jumlah");
							if ($result_bobot) {
								if ($result_bobot->num_rows > 0) {
									$awal=1;
									$akhir=20;
									while ($row = $result_bobot->fetch_object()) {
										echo "<tr>";
											// echo "<td> $awal s.d $akhir </td>";
											echo "<td> $row->jumlah </td>";
											echo "<td> $row->keterangan </td>";
										echo "</tr>";
										$awal = $akhir+1;
									$akhir+=20;
									}
								} else {
									echo "<tr>";
										echo "<td colspan='3' style='text-align: center;'>Data Tidak Tersedia</td>";
									echo "</tr>";
								}
							} 
						?>
					</table>

					<hr />

					<b>Tabel Penilaian  Karyawan</b><br />
					<form action="proses_topsis.php" enctype="multipart/form-data" method="POST">
						<table class="table table-bordered table-hover table-striped text-center">
							<tr>
								<th class="text-center">No.</th>
								<th class="text-center">Peserta</th>
								<?php
									$result_kriteria = mysqli_query($connect,"SELECT nama_kriteria FROM kriteria ORDER BY kode_kriteria");
									if($result_kriteria) {
										if ($result_kriteria->num_rows > 0) {
											while ($row = $result_kriteria->fetch_object()) {
												echo "<th class='text-center'>".$row->nama_kriteria."</th>";
											}
										}
									}
								?>
							</tr>
							<?php
								$result_karyawan = mysqli_query($connect,"SELECT nip,nama FROM karyawan ORDER BY id");
								if ($result_karyawan) {
									if ($result_karyawan->num_rows > 0) {
										$no=0;
										while ($row = $result_karyawan->fetch_object()) {
											$no++;
											?>
											<tr>
												<td><?php echo $no."."; ?></td>
												<td><?php echo $row->nama; ?></td>
												<?php
													$result_kriteria = mysqli_query($connect,"SELECT kode_kriteria FROM kriteria ORDER BY kode_kriteria");
													if($result_kriteria) {
														if ($result_kriteria->num_rows > 0) {
															$no_kode=0;
															while ($row_kriteria = $result_kriteria->fetch_object()) {
																echo "<input type='hidden' name='nip[]' value='".$row->nip."' />";
																echo "<input type='hidden' name='kode_nilai_guru[]' value='".$row->nip.$row_kriteria->kode_kriteria."' />";
																echo "<input type='hidden' name='kode_kriteria[]' value='".$row_kriteria->kode_kriteria."' />";
																echo "<td style='text-align:center;'><input type='text' name='angka_penilaian[]' placeholder='1 s/d 5' size='10' maxlength='3' required='true' /></td>";
															}
														}
													}
												?>
											</tr>
								<?php
										}
									} else {
										?>
										<tr>
											<td colspan="5" style="text-align: center;">Data Tidak Tersedia</td>
										</tr>
								<?php
									}
								} ?>
						</table>
						<div class="text-right">
							<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-send"></span> Proses</button>
						</div>
					</form>
				</p>
			</div>

<?php

$connect->close(); 
$result_kriteria->close();
$result_bobot->close();
$result_karyawan->close(); 
require '_footer.php';

?>