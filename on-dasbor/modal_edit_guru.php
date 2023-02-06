<?php
  include "../koneksi.php";

	$id = $_GET['id'];
	$result = mysqli_query($connect, "SELECT * FROM karyawan WHERE id='$id'");

	if ($result) {
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_object()) {
?>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Edit Data Guru</h4>
        </div>

        <div class="modal-body">
          <form action="proses_update_guru.php" name="modal_popup" enctype="multipart/form-data" method="POST">
          		  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />

                <div class="form-group">
                  <input type="hidden" name="id_form" id="id_form">
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="NIP">NIP</label>
                  <input type="text" name="nip"  class="form-control" value="<?php echo $row->nip; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Nama">Nama</label>
                  <input type="text" name="nama"  class="form-control" value="<?php echo $row->nama; ?>" required/>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Alamat">Alamat</label>
                  <textarea type="text" name="alamat"  class="form-control" required><?php echo $row->alamat; ?></textarea>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="Jenis Kelamin">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control" required>
                    <option value="" disabled>- Pilih Jenis Kelamin -</option>
                    <option value="Pria" <?php if($row->jenis_kelamin == 'Pria') echo "selected"; ?> >Pria</option>
                    <option value="Wanita" <?php if($row->jenis_kelamin == 'Wanita') echo "selected"; ?> >Wanita</option>
                  </select>
                </div>

                <div class="form-group" style="padding-bottom: 20px;">
                  <label for="No. Telp">No. Telp</label>
                  <input type="text" name="no_telp"  class="form-control" value="<?php echo $row->no_telp; ?>" required />
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