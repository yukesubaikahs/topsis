<?php
  include "../koneksi.php";

	$id = $_GET['id'];
	$result = mysqli_query($connect, "SELECT * FROM kriteria WHERE id='$id'");

	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Kriteria</h4>
        </div>

        <div class="modal-body">
          <form action="proses_update_kriteria.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />

                <div class="form-group">
                  <input type="hidden" name="id_form" id="id_form">
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kode Kriteria">Kode Kriteria</label>
                  <input type="text" name="kode_kriteria"  class="form-control" value="<?php echo $row->kode_kriteria; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama Kriteria">Nama Kriteria</label>
                  <input type="text" name="nama_kriteria"  class="form-control" value="<?php echo $row->nama_kriteria; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Kategori">Kategori</label>
                  <select name="kategori" class="form-control" required>
                    <option value="" disabled>- Pilih Kategori -</option>
                    <option value="Benefit/Keuntungan" <?php if($row->kategori == 'Benefit/Keuntungan') echo "selected"; ?> >Benefit/Keuntungan</option>
                    <option value="Cost/Biaya" <?php if($row->kategori == 'Cost/Biaya') echo "selected"; ?> >Cost/Biaya</option>
                  </select>
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