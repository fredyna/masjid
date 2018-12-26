<?php
    session_start();  
    if(!isset($_SESSION['user_login'])){
      header('Location: ../login.php' );
      die();
    } else{
      require_once('../../controller/AuthController.php');
      require_once('../../controller/GaleriController.php');
      require_once('../../controller/KegiatanController.php');

      $auth = new AuthController();
      $user_login = $auth->getUserLogin();

      $galeri = new GaleriController();
      $galeri = $galeri->getAll();

      $kegiatan = new KegiatanController();
      $kegiatan = $kegiatan->getAll();
    }
    require_once('../template/header.php');
    require_once('../template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
  <div class="page-header">
    <h1><i class="px-nav-icon ion-ios-photos"></i><span class="px-nav-label"></span>KELOLA GALERI</h1>
  </div>

  <div class="row">
    <div class="col-sm-12" id="div-tambah-data">
        <div class="panel">
            <div id="judul_form" class="panel-title">Tambah Data Galeri</div>
            <small id="sub_judul_form" class="panel-subtitle text-muted">Form Tambah Data Galeri</small>
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
                
                <form action="galeri_proses.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                <!-- hidden input id -->
                <input type="hidden" id="id_user" name="id">

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Kegiatan</label>
                            <div class="col-sm-6">
                                <select name="kegiatan" class="form-control" required>
                                    <option value="">--Pilih Kegiatan--</option>
                                    <?php 
                                        if($kegiatan->rowCount() > 0){
                                            while($row = $kegiatan->fetch()){ ?>
                                                <option value="<?php echo $row['id_kegiatan'];?>"><?php echo $row['nama_kegiatan'];?></option>
                                    <?php  }
                                        } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Foto</label>
                            <div class="col-sm-6">
                                <input type="file" name="foto" placeholder="Upload foto..." class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Judul</label>
                            <div class="col-sm-6">
                                <input type="text" name="judul" placeholder="Masukan judul..." class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-6">
                                <textarea name="keterangan" placeholder="Keterangan..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="row">
                            <div class="col-sm-9">
                                <button type="submit" id="btn-add" class="btn btn-primary" name="submit-add"><i class="fa fa-plus"></i> Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End form tambah data-->
  </div>

  <div class="row">
    <div class="col-sm-12" id="div-tambah-data">
        <div class="panel">
            <div id="judul_form" class="panel-title">Daftar Galeri</div>
            <small id="sub_judul_form" class="panel-subtitle text-muted">Galeri Berdasarkan Kegiatan</small>
            <div class="panel-body">
                <div class="row">

                    <?php 
                        if($galeri->rowCount() > 0){
                            while($row = $galeri->fetch()){ ?>
                                <div class="col-md-3">
                                    <a href="galeri_detail.php?id=<?php echo $row['id_kegiatan']; ?>">
                                        <div class="thumbnail gallery-folder">
                                            <img class="center-block" src="../../assets/img/gallery.png" alt="Gallery" style="width:80%">
                                            <div class="caption text-center">
                                                <?php echo $row['nama_kegiatan'];?> <br/>
                                                <?php echo date('d-m-Y', strtotime($row['event_date']));?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                    <?php }
                        } else { ?>
                        <p class="text-center"><i>Tidak Ada Galeri</i></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
  </div>


</div>
<!-- content -->

<script>
    $(function(){
        $("#menu-galeri").addClass('active');
    });
</script>

<?php
    require_once('../template/footer.php');
?>