<?php
    require_once('template/header.php');
    require_once('template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-social-buffer"></i><span class="px-nav-label"></span>KELOLA KATEGORI</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-title">Tambah Data Kategori</div>
                <small class="panel-subtitle text-muted">Form Tambah Data Kategori</small>
                <div class="panel-body">
                    <form action="" class="form-horizontal">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label">Nama Kategori</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kategori" placeholder="Masukan nama kategori..." class="form-control">
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
                                <tr>
                                    <td>1</td>
                                    <td>Teknologi</td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </td>
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
    $(function() {
        $("#menu-kategori").addClass("active");
    });
</script>

<?php 
    require_once('template/footer.php');
?>