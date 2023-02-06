<?php

require '_header.php';

?>
			<div class="col-md-12">
				<h2>Kriteria Terbobot <a href='#' class='btn btn-success glyphicon glyphicon-pencil' data-target='#ModalAddKriteriaBobot' data-toggle='modal' title='Input Kriteria Terbobot'></a></h2>
				<hr />

				<h2>Data Kriteria</h2>
				<hr />
				<p>
					<a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAddKriteria' data-toggle='modal' title='Tambah Data Kriteria'></a>
				</p>
				<p>
					<table id="dataKriteria" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kode Kriteria</th>
								<th>Nama Kriteria</th>
								<th>Kategori</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result = mysqli_query($connect,"SELECT * FROM kriteria ORDER BY id");
							if ($result) {
								if ($result->num_rows > 0) {
									$no=0;
									while ($row = $result->fetch_object()) {
										$no++;
										?>
										<tr>
											<td><?php echo $no."."; ?></td>
											<td><?php echo $row->kode_kriteria; ?></td>
											<td><?php echo $row->nama_kriteria; ?></td>
											<td><?php echo $row->kategori; ?></td>
											<td class="text-center">
												<a href='#' class='open_modal_edit_kriteria btn btn-success glyphicon glyphicon-pencil' data-target='#ModalEditKriteria' data-toggle='modal' id="<?php echo $row->id; ?>" title='Edit Data Kriteria'></a>  
												<a href='#' class='btn btn-danger glyphicon glyphicon-trash' data-target='#ModalDeleteKriteria' data-toggle='modal' onclick="confirm_delete('proses_hapus_kriteria.php?&id=<?php echo $row->id; ?>');" title='Hapus Data Kriteria'></a>
											</td>
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
							}
							?>
						</tbody>
					</table>
				</p>

				<hr />

				<h2>Data Bobot</h2>
				<hr>
				<p>
					<a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAddBobot' data-toggle='modal' title='Tambah Data Bobot'></a>
				</p>
				<p>
					<table id="dataBobot" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Kode Bobot</th>
								<th>Nilai</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result_bobot = mysqli_query($connect,"SELECT * FROM bobot ORDER BY id");
							if ($result_bobot) {
								if ($result_bobot->num_rows > 0) {
									$no=0;
									while ($row_bobot = $result_bobot->fetch_object()) {
										$no++;
										?>
										<tr>
											<td><?php echo $no."."; ?></td>
											<td><?php echo $row_bobot->kode_bobot; ?></td>
											<td><?php echo $row_bobot->jumlah; ?></td>
											<td><?php echo $row_bobot->keterangan; ?></td>
											<td class="text-center">
												<a href='#' class='open_modal_edit_bobot btn btn-success glyphicon glyphicon-pencil' data-target='#ModalEditBobot' data-toggle='modal' id="<?php echo $row_bobot->id; ?>" title='Edit Data Bobot'></a>  
												<a href='#' class='btn btn-danger glyphicon glyphicon-trash' data-target='#ModalDeleteBobot' data-toggle='modal' onclick="confirm_delete('proses_hapus_bobot.php?&id=<?php echo $row_bobot->id; ?>');" title='Hapus Data Bobot'></a>
											</td>
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
							}
							?>
						</tbody>
					</table>
				</p>
			</div>

		<!-- Modal Popup untuk Add Kriteria Terbobot --> 
		<div id="ModalAddKriteriaBobot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
    			<div class="modal-content">

        			<div class="modal-header">
            			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            			<h4 class="modal-title" id="myModalLabel">Input Kriteria Terbobot</h4>
        			</div>

        			<div class="modal-body">
          				<form action="proses_simpan_kriteria_terbobot.php" name="modal_popup" enctype="multipart/form-data" method="GET">

          					<div class="form-group" style="padding-bottom: 20px;">
          						<?php
                  				$result_kriteria = mysqli_query($connect,"SELECT kode_kriteria,nama_kriteria,kategori FROM kriteria ORDER BY kode_kriteria");
                  				$result_bobot = mysqli_query($connect,"SELECT kode_bobot,jumlah FROM bobot ORDER BY jumlah");
                  				echo "<input type='hidden' name='data' value='kriteria_terbobot' />";
                  				echo "<table class='table table-bordered table-hover table-striped'>";
								echo "<tr>";
									echo "<th>No.</th>";
									echo "<th>Kriteria</th>";
									echo "<th>Kategori</th>";
									echo "<th>Bobot</th>";
								echo "</tr>";
								if($result_kriteria) {
									if($result_kriteria->num_rows > 0) {
										$no = 0;
										while($row_kriteria = $result_kriteria->fetch_object()) {
											echo "<tr>";
												echo "<td><input type='hidden' name='kode_kriteria[]' value='".$row_kriteria->kode_kriteria."' />".++$no."</td>";
												echo "<td>";
													echo $row_kriteria->nama_kriteria;
												echo "</td>";
												echo "<td>";
													echo $row_kriteria->kategori;
												echo "</td>";
												echo "<td style='text-align: center;'>";
													$result_bobot = mysqli_query($connect,"SELECT kode_bobot,jumlah FROM bobot ORDER BY jumlah");
														if($result_bobot) {
															if($result_bobot->num_rows > 0) {
																echo "<select name='jumlah_bobot[]'>";
																	while($row_bobot = $result_bobot->fetch_object()) {
																		echo "<option value='".$row_bobot->jumlah."'>";
																			echo $row_bobot->jumlah;
																		echo "</option>";
																	}
																echo "</select>";		
															}
														}
												echo "</td>";
											echo "</tr>";
										}
									}
								}

								echo "</table>";
								?>
		                	</div>

              				<div class="modal-footer">
                				<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>                
                				<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
              				</div>
              			</form>

            		</div>
        		</div>
    		</div>
		</div>

		<!-- Modal Popup untuk Add Kriteria--> 
		<div id="ModalAddKriteria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
    			<div class="modal-content">

        			<div class="modal-header">
            			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            			<h4 class="modal-title" id="myModalLabel">Tambah Data Kriteria</h4>
        			</div>

        			<div class="modal-body">
          				<form action="proses_simpan_kriteria.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Kode Kriteria">Kode Kriteria</label>
                  				<input type="text" name="kode_kriteria"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Nama Kriteria">Nama Kriteria</label>
                  				<input type="text" name="nama_kriteria"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Kategori">Kategori</label>
                  				<select name="kategori" class="form-control" required>
                    				<option value="" disabled selected>- Pilih Kategori -</option>
                    				<option value="Benefit/Keuntungan">Benefit/Keuntungan</option>
                    				<option value="Cost/Biaya">Cost/Biaya</option>
                  				</select>
                			</div>

              				<div class="modal-footer">
                				<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>                
                				<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
              				</div>
              			</form>

            		</div>
        		</div>
    		</div>
		</div>

		<!-- Modal Popup untuk Edit Kriteria--> 
		<div id="ModalEditKriteria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		<!-- Modal Popup untuk delete kriteria--> 
		<div class="modal fade" id="ModalDeleteKriteria">
  			<div class="modal-dialog">
    			<div class="modal-content" style="margin-top:100px;">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        				<h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Data Ini?</h4>
      				</div>         
	      			<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
	        			<a href="#" class="btn btn-primary" id="delete_link"><span class="glyphicon glyphicon-ok-sign"></span> Ya</a>
	        			<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Tidak</button>
	      			</div>
    			</div>
  			</div>
		</div>

		<script type="text/javascript">
			$(function() {
				$("#dataKriteria").dataTable();
			});
		</script>

		<!-- Javascript untuk popup modal Edit Kriteria--> 
		<script type="text/javascript">
   			$(document).ready(function () {
   				$(".open_modal_edit_kriteria").click(function(e) {
      				var m = $(this).attr("id");
       				$.ajax({
             			url: "modal_edit_kriteria.php",
             			type: "GET",
             			data : {id: m,},
             			success: function (ajaxData){
               				$("#ModalEditKriteria").html(ajaxData);
               				$("#ModalEditKriteria").modal('show',{backdrop: 'true'});
             			}
           			});
        		});
      		});
		</script>

		<!-- Javascript untuk popup modal Delete Kriteria--> 
		<script type="text/javascript">
    		function confirm_delete(delete_url){
      			$('#ModalDeleteKriteria').modal('show', {backdrop: 'static'});
      			document.getElementById('delete_link').setAttribute('href' , delete_url);
    		}
		</script>



		<!-- Modal Popup untuk Add Bobot--> 
		<div id="ModalAddBobot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
    			<div class="modal-content">

        			<div class="modal-header">
            			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            			<h4 class="modal-title" id="myModalLabel">Tambah Data Bobot</h4>
        			</div>

        			<div class="modal-body">
          				<form action="proses_simpan_bobot.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Kode Bobot">Kode Bobot</label>
                  				<input type="text" name="kode_bobot"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Jumlah">Jumlah</label>
                  				<input type="text" name="jumlah"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Keterangan">Keterangan</label>
                  				<input type="text" name="keterangan"  class="form-control" required />
                			</div>

              				<div class="modal-footer">
                				<button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>                
                				<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-ban-circle"></span> Tutup</button>
              				</div>
              			</form>

            		</div>
        		</div>
    		</div>
		</div>

		<!-- Modal Popup untuk Edit Bobot--> 
		<div id="ModalEditBobot" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		<!-- Modal Popup untuk delete Bobot--> 
		<div class="modal fade" id="ModalDeleteBobot">
  			<div class="modal-dialog">
    			<div class="modal-content" style="margin-top:100px;">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        				<h4 class="modal-title" style="text-align:center;">Anda Yakin Ingin Menghapus Data Ini?</h4>
      				</div>         
	      			<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
	        			<a href="#" class="btn btn-primary" id="delete_link"><span class="glyphicon glyphicon-ok-sign"></span> Ya</a>
	        			<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Tidak</button>
	      			</div>
    			</div>
  			</div>
		</div>

		<script type="text/javascript">
			$(function() {
				$("#dataBobot").dataTable();
			});
		</script>

		<!-- Javascript untuk popup modal Edit Bobot--> 
		<script type="text/javascript">
   			$(document).ready(function () {
   				$(".open_modal_edit_bobot").click(function(e) {
      				var m = $(this).attr("id");
       				$.ajax({
             			url: "modal_edit_bobot.php",
             			type: "GET",
             			data : {id: m,},
             			success: function (ajaxData){
               				$("#ModalEditBobot").html(ajaxData);
               				$("#ModalEditBobot").modal('show',{backdrop: 'true'});
             			}
           			});
        		});
      		});
		</script>

		<!-- Javascript untuk popup modal Delete Bobot --> 
		<script type="text/javascript">
    		function confirm_delete(delete_url){
      			$('#ModalDeleteBobot').modal('show', {backdrop: 'static'});
      			document.getElementById('delete_link').setAttribute('href' , delete_url);
    		}
		</script>

<?php

$connect->close(); 
$result->close(); 
$result_bobot->close();
require '_footer.php';

?>