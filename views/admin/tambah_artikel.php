<?php 
    require_once('../template/header.php');
    require_once('../template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
        <li><a href="javascript:void(0)">Kelola Artikel</a></li>
        <li class="active">Tambah Artikel</li>
    </ol>

    <div class="page-header">
      <h1><i class="px-nav-icon ion-ios-paper"></i><span class="px-nav-label"></span>KELOLA ARTIKEL</h1>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Artikel</span>
                    <div class="panel-heading-controls">
                      <button class="btn btn-default btn-xs" id="btn-minimize"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-default btn-xs" id="btn-show" style="display:none;"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                <div class="panel-body"  id="box-artikel">
                  <form action="" class="form-horizontal">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-6">
                                <input type="text" name="judul" placeholder="Masukan judul..." class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label">Thumbnail</label>
                            <div class="col-sm-6">
                                <input type="file" name="gambar" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label">Kategori</label>
                            <div class="col-sm-6">
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="1">Kategori 1</option>
                                    <option value="2">Kategori 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label">Isi Berita</label>
                            <div class="col-sm-10">
                              <textarea id="summernote-base">Ketikan di sini...</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="row">
                            <div class="col-sm-12">
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