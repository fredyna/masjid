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
    require_once('../../controller/InfoUmumController.php');
    $info = new InfoUmumController();
    $data = $info->getAll();
?>

<!-- Content -->
<div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
        <li><a href="javascript:void(0)">Setting</a></li>
        <li class="active">Profil Masjid</li>
    </ol>

    <div class="page-header">
      <h1><i class="px-nav-icon ion-gear-b"></i><span class="px-nav-label"></span>Setting</h1>
    </div>
        <div class="row">
            <!-- Form data masjid -->
            <div class="col-sm-12" id="div-form-edit">
                <div class="panel">
                    <div id="judul_form" class="panel-title">Informasi Masjid</div>
                    <small id="sub_judul_form" class="panel-subtitle text-muted">Informasi Umum Masjid</small>
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

                    <?php if(isset($data)){
                        while($row = $data->fetch()){ ?>
                        <div id="div_form_info" class="form-horizontal">

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <?php if($row['foto'] == null) { ?>
                                            <img src="../../assets/img/masjid/masjid.jpg" alt="Masjid" style="width:320px; height: 240px; display:block; margin:auto;">
                                        <?php } else { ?>
                                            <img src="../../uploads/profil/<?php echo $row['foto'];?>" alt="Masjid" style="width:320px; height: 240px; display:block; margin:auto;">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Nama Masjid</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="nama_masjid" name="nama_masjid" value="<?php echo $row['nama_masjid']?>" placeholder="Masukan Nama Masjid..." class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Ketua Takmir</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="ketua_takmir" name="ketua_takmir" value="<?php echo $row['ketua_takmir']?>" placeholder="Masukan nama ketua takmir ..." class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Tanggal Berdiri</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="tanggal_berdiri" value="<?php echo date('d-m-Y', strtotime($row['tanggal_berdiri']));?>" placeholder="dd-mm-yyyy" class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Luas Tanah</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="luas_tanah" name="luas_tanah" value="<?php echo $row['luas_tanah']; ?> meter" placeholder="Masukan luas tanah ..." class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Luas Bangunan</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="luas_bangunan" name="luas_bangunan" value="<?php echo $row['luas_bangunan']; ?> meter" placeholder="Masukan luas bangunan ..." class="form-control" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Keterangan</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" required readonly><?php echo $row['keterangan'];?></textarea>
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

                        <form id="form_info" action="info_umum_proses.php" class="form-horizontal" method="post" style="display: none;" enctype="multipart/form-data">
                            <!-- hidden input id -->
                            <input type="hidden" id="id_masjid" name="id" value="<?php echo $row['id_masjid'];?>">

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <?php if($row['foto'] == null) { ?>
                                            <img src="../../assets/img/masjid/masjid.jpg" alt="Masjid" style="width:320px; height: 240px; display:block; margin:auto;">
                                        <?php } else { ?>
                                            <img src="../../uploads/profil/<?php echo $row['foto'];?>" alt="Masjid" style="width:320px; height: 240px; display:block; margin:auto;">
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Foto Masjid</label>
                                    <div class="col-sm-6">
                                        <input type="file" id="foto" name="foto"  placeholder="Upload foto masjid" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Nama Masjid</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="nama_masjid" name="nama_masjid" value="<?php echo $row['nama_masjid'];?>" placeholder="Masukan Nama Masjid..." class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Ketua Takmir</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="ketua_takmir" name="ketua_takmir" value="<?php echo $row['ketua_takmir'];?>" placeholder="Masukan nama ketua takmir ..." class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Tanggal Berdiri</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="tanggal_berdiri" name="tanggal_berdiri" value="<?php echo date('d-m-Y', strtotime($row['tanggal_berdiri']));?>" placeholder="dd-mm-yyyy" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Luas Tanah</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="luas_tanah" name="luas_tanah" value="<?php echo $row['luas_tanah']; ?>" placeholder="Masukan luas tanah ..." class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Luas Bangunan</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="luas_bangunan" name="luas_bangunan" value="<?php echo $row['luas_bangunan']; ?>" placeholder="Masukan luas bangunan ..." class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Keterangan</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="keterangan" required><?php echo $row['keterangan']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group text-right">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary" name="submit-update"><i class="fa fa-edit"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    <?php } 
                        } ?>

                    </div>
                </div>
            </div>
            <!-- End form data masjid -->

        </div>
    </div>
    <br /><br />
</div>

<script>
    $(function(){
        $("#menu-setting").addClass("active");
        $("#sub-profil-masjid").addClass("active");
    });

    $(function() {
        $('#tanggal_berdiri').datepicker();
    });

    $(function(){
        $("#btn-edit").click(function(){
            $("#judul_form").text("Edit Informasi Umum");
            $("#sub_judul_form").text("Edit Data Informasi Umum Masjid");
            $("#div_form_info").hide();
            $("#form_info").show();
        });
    });

    
</script>

<?php 
    require_once('../template/footer.php');
?>