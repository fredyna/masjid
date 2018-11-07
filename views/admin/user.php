<?php
    session_start();  
    if(!isset($_SESSION['user_login'])){
      header('Location: ../login.php' );
      die();
    } else{
      require_once('../../controller/AuthController.php');
      $auth = new AuthController();
      $user_login = $auth->getUserLogin();
    }

    require_once('../template/header.php');
    require_once('../template/navbar.php');
    require_once('../../controller/UsersController.php');
    $user = new UsersController();
    $data = $user->getAll();
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-person"></i><span class="px-nav-label"></span>KELOLA USER</h1>
    </div>

    <div class="row">
        <!-- form tambah data -->
        <div class="col-sm-12" id="div-tambah-data">
            <div class="panel">
                <div id="judul_form" class="panel-title">Tambah Data User</div>
                <small id="sub_judul_form" class="panel-subtitle text-muted">Form Tambah Data User</small>
                <div class="panel-body">
                <?php 
                    if(isset($_SESSION['save'])){
                        if($_SESSION['save'] == 1){
                ?>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            Data berhasil disimpan!
                        </div>
                    </div>
                    <br><br>
                <?php } else{ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            Data gagal disimpan!
                        </div>
                    </div>
                    <br><br>    
                <?php   }
                        unset($_SESSION['save']);
                    }
                ?>

                <?php if(isset($_SESSION['form']) && $_SESSION['form'] == 1){ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-warning">
                            Pastikan data pada form telah terisi dengan benar!
                        </div>
                    </div>
                    <br><br>
                <?php 
                        unset($_SESSION['form']);
                    }
                ?>
                    
                    <form action="user_proses.php" class="form-horizontal" method="post">
                    <!-- hidden input id -->
                    <input type="hidden" id="id_user" name="id">

                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Username</label>
                              <div class="col-sm-6">
                                  <input type="text" id="username" name="username" placeholder="Masukan username..." class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Email</label>
                              <div class="col-sm-6">
                                  <input type="email" id="email" name="email" placeholder="Masukan email..." class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Nama</label>
                              <div class="col-sm-6">
                                  <input type="text" id="name" name="name" placeholder="Masukan nama..." class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group" id="div-password">
                          <div class="row">
                              <label class="col-sm-3 control-label">Password</label>
                              <div class="col-sm-6">
                                  <input type="password" id="password" name="password" placeholder="Masukan password" class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group" id="div-rpassword">
                          <div class="row">
                              <label class="col-sm-3 control-label">Repeat Password</label>
                              <div class="col-sm-6">
                                  <input type="password" id="r_password" name="r_password" placeholder="Masukan ulang password" class="form-control" required>
                              </div>
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="row">
                              <label class="col-sm-3 control-label">Role</label>
                              <div class="col-sm-6">
                                  <select name="role" id="role" class="form-control" required>
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
                                  <button type="submit" id="btn-add" class="btn btn-primary" name="submit-add"><i class="fa fa-plus"></i> Tambah</button>
                                  <button type="submit" id="btn-update" class="btn btn-primary" name="submit-update"><i class="fa fa-edit"></i> Update</button>
                              </div>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
        <!-- End form tambah data-->

        <!-- Change password -->
        <?php 
            if(isset($_SESSION['update']) || isset($_SESSION['form_password'])){ ?>
            <div class="col-sm-12" id="div-change-password">
        <?php } else { ?>
            <div class="col-sm-12" id="div-change-password" style="display:none;">
        <?php } ?>
            <div class="panel">
                <div id="judul_form" class="panel-title">Ubah Password User</div>
                <small class="panel-subtitle text-muted">Form Ubah Password User</small>
                <div class="panel-body">
                <?php 
                    if(isset($_SESSION['update'])){
                        if($_SESSION['update'] == 1){
                ?>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            Ubah password berhasil!
                        </div>
                    </div>
                    <br><br>
                <?php } else{ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            Ubah password gagal!
                        </div>
                    </div>
                    <br><br>    
                <?php   }
                        unset($_SESSION['update']);
                    }
                ?>

                <?php if(isset($_SESSION['form_password']) && $_SESSION['form_password'] == 1){ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-warning">
                            Pastikan semua kolom diisi dan panjang password harus lebih dari 5 karakter!
                        </div>
                    </div>
                    <br><br>
                <?php 
                        unset($_SESSION['form_password']);
                    }
                ?>
                    
                    <form action="user_proses.php" class="form-horizontal" method="post">
                    <!-- hidden input id -->
                    <?php 
                        if(isset($_SESSION['id_user'])){ ?>
                            <input type="hidden" id="id_user_password" name="id" value="<?php echo $_SESSION['id_user'];?>">
                    <?php
                        unset($_SESSION['id_user']);
                        } else { ?>
                            <input type="hidden" id="id_user_password" name="id">
                    <?php }?>
                      
                      <div class="form-group" id="div-password">
                          <div class="row">
                              <label class="col-sm-3 control-label">Password</label>
                              <div class="col-sm-6">
                                  <input type="password" id="password-update" name="password" placeholder="Masukan password" class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group" id="div-rpassword">
                          <div class="row">
                              <label class="col-sm-3 control-label">Repeat Password</label>
                              <div class="col-sm-6">
                                  <input type="password" id="r_password-update" name="r_password" placeholder="Masukan ulang password" class="form-control" required>
                              </div>
                          </div>
                      </div>
                      <div class="form-group text-right">
                          <div class="row">
                              <div class="col-sm-9">
                                  <button type="submit" id="btn-update-password" class="btn btn-primary" name="submit-update-password"><i class="fa fa-edit"></i> Ubah</button>
                              </div>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
        <!-- End change password -->
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
            <div class="panel-title">Data User</div>
            <small class="panel-subtitle text-muted">Kelola Data User</small>
            <div class="panel-body">
            <?php 
                if(isset($_SESSION['delete'])){
                    if($_SESSION['delete'] == 1){
            ?>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        Hapus data berhasil!
                    </div>
                </div>
                <br><br>
            <?php } else{ ?>
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        Hapus data gagal!
                    </div>
                </div>
                <br><br>    
            <?php   }
                    unset($_SESSION['delete']);
                }
            ?>
            <div class="table-success">
                <table id="table-user" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            if($data->rowCount() > 0) {
                                while($row = $data->fetch()){ ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['role'] == 1 ? 'Admin':'Writer'; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                                    <td class="text-center">
                                        <!-- <button onclick="getUserById('<?php echo $row['id_user'];?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button> -->
                                        <div class="dropdown" style="display:inline;">
                                            <button class="btn btn-info btn-xs" data-toggle="dropdown">
                                                <i class="fa fa-edit"></i>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="javascript:void(0)" onclick="getUserById('<?php echo $row['id_user'];?>')">Edit Data</a></li>
                                                <li><a href="javascript:void(0)" onclick="changePassword('<?php echo $row['id_user'];?>')">Ganti Password</a></li>
                                            </ul>
                                        </div>
                                        
                                        <button onclick="deleteUser('<?php echo $row['id_user'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                        <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="text-center"><i>Tidak Ada Data</i></td>
                                </tr>
                        <?php   } ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br /><br />
</div>

<script>
    $(function(){
        $("#menu-user").addClass("active");
    });

    $(function(){
        $("#btn-update").hide();
    });

    function getUserById(userId){
        $("#div-password").hide();
        $("#password").attr("required",false);
        $("#div-rpassword").hide();
        $("#r_password").attr("required",false);
        $("#judul_form").text("Edit Data User");
        $("#sub_judul_form").text("Form Edit Data User");
        $.ajax({
          type: "POST",
          url: "user_edit.php", 
          data: {id: userId },
          dataType: "json",
          success:function(response)
          {
            $("#id_user").val(response[0].id_user);
            $("#username").val(response[0].username);
            $("#email").val(response[0].email);
            $("#name").val(response[0].nama);
            $("#role option[value="+response[0].role+"]").prop('selected',true);
            $("#btn-add").hide();
            $("#btn-update").show();
          }
        });
    }

    function changePassword(userId){
        $("#div-change-password").fadeIn();
        $("#id_user_password").val(userId);
    }

    function deleteUser(userId){
        var y = confirm("Are you sure to delete?");
        if(y == true){
            window.location.href = "user_hapus.php?id="+userId;
        }
    }
</script>

<?php 
    require_once('../template/footer.php');
?>