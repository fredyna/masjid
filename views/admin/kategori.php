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
    require_once('../../controller/CategoryController.php');
    $kategori = new CategoryController();
    $data = $kategori->getAll();
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-social-buffer"></i><span class="px-nav-label"></span>KELOLA KATEGORI</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel">
                <div id="judul_form" class="panel-title">Tambah Data Kategori</div>
                <small id="sub_judul_form" class="panel-subtitle text-muted">Form Tambah Data Kategori</small>
                <div class="panel-body">
                <?php 
                    if(isset($_SESSION['save'])){
                        if($_SESSION['save'] == 1){
                ?>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            Kategori berhasil disimpan!
                        </div>
                    </div>
                    <br><br>
                <?php } else{ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            Kategori gagal disimpan!
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
                    <form action="kategori_proses.php" class="form-horizontal" method="post">
                        <!-- hidden input id -->
                        <input type="hidden" id="id_kategori" name="id">

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Nama Kategori</label>
                                <div class="col-sm-9">
                                    <input type="text" id="kategori" name="kategori" placeholder="Masukan nama kategori..." class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" id="btn-add" name="submit-add" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                                    <button type="submit" id="btn-update" name="submit-update" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-title">Data Kategori</div>
                <small class="panel-subtitle text-muted">Kelola Data Kategori</small>
                <div class="panel-body">
                    <div class="table-success">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $no = 1;
                                if($data->rowCount() > 0) {
                                    while($row = $data->fetch()){ ?>
                                    <tr>
                                        <td><?php echo $no++;?></td>
                                        <td><?php echo $row['kategori']?></td>
                                        <td class="text-center">
                                            <button id="btn-edit" onclick="getCategoryById('<?php echo $row['id_kategori'];?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                            <button id="btn-delete" onclick="deleteCategory('<?php echo $row['id_kategori'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                            <?php } 
                                } else { ?>
                                    <tr>
                                        <td colspan="3" class="text-center"><i>Tidak Ada Data</i></td>
                                    </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#menu-kategori").addClass("active");
    });

    $(function(){
        $("#btn-update").hide();
    })

    function getCategoryById(kategoriId){
        $("#judul_form").text("Edit Data Kategori");
        $("#sub_judul_form").text("Form Edit Data Kategori");
        $.ajax({
          type: "POST",
          url: "kategori_edit.php", 
          data: {id: kategoriId },
          dataType: "json",
          success:function(response)
          {
            $("#id_kategori").val(response[0].id_kategori);
            $("#kategori").val(response[0].kategori);
            $("#btn-add").hide();
            $("#btn-update").show();
          }
        });
    }

    function deleteCategory(kategoriId){
        var y = confirm("Are you sure to delete?");
        if(y == true){
            window.location.href = "kategori_hapus.php?id="+kategoriId;
        }
    }
</script>

<?php 
    require_once('../template/footer.php');
?>