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

      $id = $_GET['id'];

      $kegiatan = new KegiatanController();
      $kegiatan_all = $kegiatan->getAll();
      $kegiatan = $kegiatan->getById($id);

      $galeri = new GaleriController();
      $galeri = $galeri->getByKegiatan($id);
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
            <?php 
                if($kegiatan->rowCount()){
                    while($row = $kegiatan->fetch()){ ?>
                    <div id="judul_form" class="panel-title">Galeri Kegiatan <?php echo $row['nama_kegiatan'];?></div>
                    <small id="sub_judul_form" class="panel-subtitle text-muted">Tanggal Acara <?php echo date('d-m-Y', strtotime($row['event_date']));?></small>
            <?php }
                } else { ?>
                    <div id="judul_form" class="panel-title">Daftar Galeri</div>
                    <small id="sub_judul_form" class="panel-subtitle text-muted">Galeri Berdasarkan Kegiatan</small>
            <?php } ?>
            
            <div class="panel-body">

                <!-- alert delete -->

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

                <!-- end alert delete -->

                <!-- alert save -->

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

                <!-- end alert save -->

                <div class="row">
                    <?php 
                        if($galeri->rowCount() > 0){
                            while($row = $galeri->fetch()){ ?>
                                <div class="col-md-3">
                                    <div class="thumbnail gallery-folder">
                                        <a href="javascript:void(0)" onclick="showFoto(<?php echo $row['id_galeri']; ?>)">
                                            <img class="center-block" src="../../uploads/galeri/<?php echo $row['foto'];?>" alt="Gallery" style="width:100%">
                                        </a>
                                        <div class="caption text-center">
                                            <a href="javascript:void(0)" onclick="showFoto(<?php echo $row['id_galeri']; ?>)" style="color: #333;">
                                                <?php echo $row['judul'];?>
                                            </a>
                                            <br /><br />
                                            <button onclick="editFoto(<?php echo $row['id_galeri']; ?>)" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                            <button onclick="deleteFoto('<?php echo $row['id_galeri']; ?>','<?php echo $row['id_kegiatan']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
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

<!-- modal form for show -->
<div id="modal-form" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img id="foto-galeri" alt="Foto Galeri" style="width:100%;" />
            </div>
            <div class="modal-footer">
                <p id="keterangan-galeri" class="text-left"></p>
            </div>
        </div>
    </div>
</div>
<!-- end modal form -->

<!-- modal form for edit -->
<div id="modal-form-edit" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="modal-title"></h4>
            </div>
            <div class="modal-body">
                
                <form id="form-edit-galeri" action="galeri_proses.php" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <!-- hidden input id -->
                    <input type="hidden" id="id_galeri" name="id">
                    <input type="hidden" id="id_kegiatan" name="id_kegiatan">

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Kegiatan</label>
                            <div class="col-sm-6">
                                <select id="kegiatan" name="kegiatan" class="form-control" required>
                                    <option value="">--Pilih Kegiatan--</option>
                                    <?php 
                                        if($kegiatan_all->rowCount() > 0){
                                            while($row = $kegiatan_all->fetch()){ ?>
                                                <option value="<?php echo $row['id_kegiatan'];?>"><?php echo $row['nama_kegiatan'];?></option>
                                    <?php  }
                                        } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Judul</label>
                            <div class="col-sm-6">
                                <input id="judul" type="text" name="judul" placeholder="Masukan judul..." class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-6">
                                <textarea id="keterangan" name="keterangan" placeholder="Keterangan..." class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="row">
                            <div class="col-sm-9">
                                <button type="submit" id="btn-add" class="btn btn-primary" name="submit-update"><i class="fa fa-edit"></i> Edit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal form -->

<script>
    $(function(){
        $("#menu-galeri").addClass('active');
    });

    function showFoto(id){
        $.ajax({
          type: "POST",
          url: "galeri_edit.php", 
          data: {id: id },
          dataType: "json",
          success:function(response)
          {
            var urlfoto = "../../uploads/galeri/"+response[0].foto;
            $("#modal-title").text(response[0].judul);
            $("#foto-galeri").attr('src', urlfoto);
            $("#keterangan-galeri").text(response[0].keterangan);
            $("#modal-form").modal('show');
          }
        });
    }

    function editFoto(id){
        $.ajax({
          type: "POST",
          url: "galeri_edit.php", 
          data: {id: id },
          dataType: "json",
          success:function(response)
          {
            // $("#modal-title").text(response[0].judul);
            // $("#foto-galeri").attr('src', urlfoto);
            // $("#keterangan-galeri").text(response[0].keterangan);
            $("#modal-form-edit").modal('show');
          }
        });
    }


    function deleteFoto(id, idKegiatan){
        var y = confirm("Are you sure to delete?");
        if(y == true){
            window.location.href = "galeri_hapus.php?id="+id+"&kegiatan="+idKegiatan;
        }
    }
</script>

<?php
    require_once('../template/footer.php');
?>