<?php
  include "../koneksi.php";

	$id = $_GET['id'];
	$result = mysqli_query($connect, "SELECT * FROM bobot WHERE id='$id'");

	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Bobot</h4>
        </div>

        <div class="modal-body">
          <form action="proses_update_bobot.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />

                <div class="form-group">
                  <input type="hidden" name="id_form" id="id_form">
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kode Bobot">Kode Bobot</label>
                  <input type="text" name="kode_bobot"  class="form-control" value="<?php echo $row->kode_bobot; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Jumlah">Jumlah</label>
                  <input type="text" name="jumlah"  class="form-control" value="<?php echo $row->jumlah; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Keterangan">Keterangan</label>
                  <input type="text" name="keterangan"  class="form-control" value="<?php echo $row->keterangan; ?>" required/>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                      <span class="glyphicon glyphicon-floppy-open"></span> Update
                  </button>

                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    <span class="glyphicon glyphicon-ban-circle"></span> Batal
                  </button>
                </div>
              </form>

            </div>
        </div>
    </div>
</div>


<?php

			}
		}
	}

	$connect->close();
?>