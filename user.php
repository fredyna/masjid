<?php
    require_once('template/header.php');
    require_once('template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-person"></i><span class="px-nav-label"></span>KELOLA USER</h1>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-title">Tambah Data User</div>
                <small class="panel-subtitle text-muted">Form Tambah Data User</small>
                <div class="panel-body">
                  <form action="" class="form-horizontal">
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Username</label>
                              <div class="col-sm-6">
                                  <input type="text" name="username" placeholder="Masukan username..." class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Nama</label>
                              <div class="col-sm-6">
                                  <input type="text" name="name" placeholder="Masukan nama..." class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Email</label>
                              <div class="col-sm-6">
                                  <input type="email" name="email" placeholder="Masukan email..." class="form-control">
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Role</label>
                              <div class="col-sm-6">
                                  <select name="role" id="role" class="form-control">
                                      <option value="">-- Pilih Role --</option>
                                      <option value="1">Admin</option>
                                      <option value="2">Writer</option>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="form-group text-right">
                          <div class="row">
                              <div class="col-sm-9">
                                  <button type="button" id="btnAdd" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                                  <button type="button" id="btnEdit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                              </div>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-title">Data User</div>
          <small class="panel-subtitle text-muted">Kelola Data User</small>
          <div class="panel-body">
            <div class="table-success">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Fredd</td>
                            <td>Fredy Nur Apriyanto</td>
                            <td>mail.fredyna@gmail.com</td>
                            <td>Admin</td>
                            <td>26-08-2018</td>
                        </tr>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    $(function(){
        $("#menu-user").addClass("active");
    });
</script>

<?php 
    require_once('template/footer.php');
?>