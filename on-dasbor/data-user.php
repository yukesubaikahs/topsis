<?php

require '_header.php';

?>
			<div class="col-md-12">
				<h2>Data Users</h2>
				<hr>
				<p>
					<a href='#' class='btn btn-primary glyphicon glyphicon-plus' data-target='#ModalAdd' data-toggle='modal' title='Tambah Data User'></a>
				</p>
				<p>
					<table id="dataUser" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Email</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$result = mysqli_query($connect,"SELECT * FROM user ORDER BY id");
							if ($result) {
								if ($result->num_rows > 0) {
									$no=0;
									while ($row = $result->fetch_object()) {
										$no++;
										?>
										<tr>
											<td><?php echo $no."."; ?></td>
											<td><?php echo $row->nama; ?></td>
											<td><?php echo $row->username; ?></td>
											<td><?php echo $row->email; ?></td> 
											<td class="text-center">
												<a href='#' class='open_modal_edit btn btn-success glyphicon glyphicon-pencil' data-target='#ModalEdit' data-toggle='modal' id="<?php echo $row->id; ?>" title='Edit Data User'></a>  
												<a href='#' class='btn btn-danger glyphicon glyphicon-trash' data-target='#ModalDelete' data-toggle='modal' onclick="confirm_delete('proses_hapus_user.php?&id=<?php echo $row->id; ?>');" title='Hapus Data User'></a>
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

		<!-- Modal Popup untuk Add--> 
		<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
    			<div class="modal-content">

        			<div class="modal-header">
            			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            			<h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
        			</div>

        			<div class="modal-body">
          				<form action="proses_simpan_user.php" name="modal_popup" enctype="multipart/form-data" method="POST">
            
                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Nama">Nama</label>
                  				<input type="text" name="nama"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Username">Username</label>
                  				<input type="text" name="username"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Email">Email</label>
                  				<input type="email" name="email"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Password">Password</label>
                  				<input type="password" name="password"  class="form-control" required />
                			</div>

                			<div class="form-group" style="padding-bottom: 20px;">
                  				<label for="Hak Akses">Hak Akses</label>
                  				<select name="hak_akses" class="form-control" required>
                  					<option value="" selected disabled>- Pilih Hak Akses -</option>
                  					<option value="Admin">Admin</option>
                  					<option value="User">User</option>
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

		<!-- Modal Popup untuk Edit--> 
		<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		</div>

		<!-- Modal Popup untuk delete--> 
		<div class="modal fade" id="ModalDelete">
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
				$("#dataUser").dataTable();
			});
		</script>

		<!-- Javascript untuk popup modal Edit--> 
		<script type="text/javascript">
   			$(document).ready(function () {
   				$(".open_modal_edit").click(function(e) {
      				var m = $(this).attr("id");
       				$.ajax({
             			url: "modal_edit_user.php",
             			type: "GET",
             			data : {id: m,},
             			success: function (ajaxData){
               				$("#ModalEdit").html(ajaxData);
               				$("#ModalEdit").modal('show',{backdrop: 'true'});
             			}
           			});
        		});
      		});
		</script>

		<!-- Javascript untuk popup modal Delete--> 
		<script type="text/javascript">
    		function confirm_delete(delete_url){
      			$('#ModalDelete').modal('show', {backdrop: 'static'});
      			document.getElementById('delete_link').setAttribute('href' , delete_url);
    		}
		</script>

<?php

$connect->close(); 
$result->close(); 
require '_footer.php';

?>