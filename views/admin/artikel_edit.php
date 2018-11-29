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
    require_once('../../controller/ArtikelController.php');
    $category = new CategoryController();
    $category = $category->getAll();
    $artikel  = new ArtikelController();
    $id_artikel = $_GET['id_artikel'];
    $artikel  = $artikel->getById($id_artikel);
?>

<!-- Content -->
<div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
        <li><a href="javascript:void(0)">Kelola Artikel</a></li>
        <li class="active">Edit Artikel</li>
    </ol>

    <div class="page-header">
      <h1><i class="px-nav-icon ion-ios-paper"></i><span class="px-nav-label"></span>KELOLA ARTIKEL</h1>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Artikel</span>
                    <div class="panel-heading-controls">
                      <button class="btn btn-default btn-xs" id="btn-minimize"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-default btn-xs" id="btn-show" style="display:none;"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="panel-body"  id="box-artikel">

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
                    <form action="artikel_proses.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <?php 
                        if(isset($artikel)){
                            while($row = $artikel->fetch()){
                        ?>
                        <input type="hidden" name="id" value="<?php echo $row['id_artikel']; ?>">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label">Judul</label>
                                <div class="col-sm-6">
                                    <input type="text" id="judul" value="<?php echo $row['judul'];?>" name="judul" placeholder="Masukan judul..." class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label">Thumbnail</label>
                                <div class="col-sm-6">

                                    <?php if($row['id_kegiatan'] != null) { ?>
                                        <img id="img-gambar" src="../../uploads/kegiatan/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:200px;">
                                    <?php } else { ?>
                                        <img id="img-gambar" src="../../uploads/artikel/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:200px;">
                                        <input type="file" id="gambar" name="gambar" class="form-control">
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>

                        <?php if($row['id_kategori'] != null) { ?>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-6">
                                        <select name="kategori" id="kategori" class="form-control">
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php 
                                                if(isset($category)){ 
                                                    while($cat = $category->fetch()){
                                            ?>
                                                <option value="<?php echo $cat['id_kategori'];?>" <?php echo $row['id_kategori'] == $cat['id_kategori'] ? 'selected':'';?>><?php echo $cat['kategori'];?></option>
                                            <?php }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 control-label">Isi Berita</label>
                                <div class="col-sm-10">
                                <textarea id="summernote-base" name="isi"><?php echo $row['isi'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php if($row['id_kegiatan'] == null ){ ?>
                                        <button type="submit" id="btnEdit" name="submit-update" class="btn btn-primary"><i class="fa fa-edit"></i> Update</button>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                        <?php }
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  // Initialize Summernote
    $(function() {
      $('#summernote-base').summernote({
          height: 200,
          toolbar: [
          ['parastyle', ['style']],
          ['fontstyle', ['fontname', 'fontsize']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['picture', 'link', 'video', 'table', 'hr']],
          ['history', ['undo', 'redo']],
          ['misc', ['codeview', 'fullscreen']],
          ['help', ['help']]
          ],
      });
    });

    $(function(){
      $("#btn-minimize").click(function(){
        $("#box-artikel").fadeOut();
        $("#btn-minimize").hide();
        $("#btn-show").show();
      });

      $("#btn-show").click(function(){
        $("#box-artikel").fadeIn();
        $("#btn-minimize").show();
        $("#btn-show").hide();
      });
    });

    $(function(){
        $("#menu-artikel").addClass('active');
    });
</script>

<?php 
    require_once('../template/footer.php');
?>