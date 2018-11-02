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
?>

<!-- Content -->
<div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
        <li><a href="javascript:void(0)">Setting</a></li>
        <li class="active">Profil User</li>
    </ol>

    <div class="page-header">
      <h1><i class="px-nav-icon ion-person"></i><span class="px-nav-label"></span>KELOLA USER</h1>
    </div>

    <div class="row">
        <!-- form tambah data -->
        <div class="col-sm-12">
            <div class="panel">
                <div id="judul_form" class="panel-title">Informasi User</div>
                <small id="sub_judul_form" class="panel-subtitle text-muted">Informasi Data User</small>
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

                    <div class="form-horizontal" id="div_form_data">

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" id="username" name="username" value="<?php echo $user_login['username'];?>" placeholder="Masukan username..." class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" id="email" name="email" value="<?php echo $user_login['email'];?>" placeholder="Masukan email..." class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" id="name" name="name" value="<?php echo $user_login['nama'];?>" placeholder="Masukan nama..." class="form-control" required readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Role</label>
                                <div class="col-sm-6">
                                    <select name="role" id="role" class="form-control" required disabled>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="1" <?php echo $user_login['role'] == 1 ? 'selected':'';?>>Admin</option>
                                        <option value="2" <?php echo $user_login['role'] == 2 ? 'selected':'';?>>Writer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="row">
                                <div class="col-sm-9">
                                    <button type="button" id="btn-edit" class="btn btn-primary" name="submit-update"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form id="form_data" action="user_proses.php" class="form-horizontal" method="post" style="display: none;">
                        <!-- hidden input id -->
                        <input type="hidden" id="id_user" name="id" value="<?php echo $user_login['id_user'];?>">
                        <input type="hidden" name="profil" value="profil">

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" id="username" name="username" value="<?php echo $user_login['username'];?>" placeholder="Masukan username..." class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" id="email" name="email" value="<?php echo $user_login['email'];?>" placeholder="Masukan email..." class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" id="name" name="name" value="<?php echo $user_login['nama'];?>" placeholder="Masukan nama..." class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Role</label>
                                <div class="col-sm-6">
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="1" <?php echo $user_login['role'] == 1 ? 'selected':'';?>>Admin</option>
                                        <option value="2" <?php echo $user_login['role'] == 2 ? 'selected':'';?>>Writer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="row">
                                <div class="col-sm-9">
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
            <div class="col-sm-12" id="div-change-password">
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
                        <input type="hidden" id="id_user_password" name="id" value="<?php echo $user_login['id_user'];?>">
                        <input type="hidden" name="profil" value="profil">
                      
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

    <br/><br/>
</div>

<script>
    $(function(){
        $("#menu-setting").addClass("active");
        $("#sub-profil-user").addClass("active");
    });

    $(function(){
        $("#btn-edit").click(function(){
            $("#judul_form").text("Edit Data User");
            $("#sub_judul_form").text("Form Edit Data User");
            $("#div_form_data").hide();
            $("#form_data").show();
        });
    });

</script>

<?php 
    require_once('../template/footer.php');
?>