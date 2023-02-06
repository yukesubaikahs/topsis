	<div class="col-md-3 panel" style="margin-top: 1em; background-color: #3ee13b; box-shadow: 3px 5px 5px #888888;">
        <div class="panel-title">
          <h4 style="margin-top: 1em;"><b>Pemilihan Karyawan Terbaik</b></h4>     
          <hr />  
        </div>
        <div class="panel-body">
          <div class="text-center" style="margin: -1em 0 1em 0;">
            <em class="glyphicon glyphicon-user"></em>
            <h4 class="modal-title">Form Login</h4>
                </div>
          <form action="check-login.php" method="post">
            <div class="form-group">
                      <input type="text" name="username" placeholder="Username" class="form-control" required="true" />
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" placeholder="Password" class="form-control" required="true" />
                    </div>
                    <div class="text-right">
                      <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                      <button class="btn btn-danger" type="reset"><span class="glyphicon glyphicon-remove"></span> Batal</button>
                    </div>
                </form>
        </div>
      </div>
</div>


<footer class="panel-footer text-center" style="margin-top: 2em;">
	<p>Copyright &copy; <?php echo date('Y'); ?> PT APP INTI MEDIA</p>
</footer>

</body>
</html>