<?php
    require_once('../template/header.php');
    require_once('../template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-ios-paper"></i><span class="px-nav-label"></span>KELOLA ARTIKEL</h1>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-title">Artikel</div>
          <small class="panel-subtitle text-muted">Kelola Artikel</small>
          <div class="panel-body">
            <a class="btn btn-success" href="tambah_artikel.html"><i class="fa fa-plus"></i> Tambah Artikel</a>
            <br><br>
            <div class="table-success">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Writer</th>
                            <th>Created At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Judul Artikel</td>
                            <td>Teknologi</td>
                            <td>Fredy</td>
                            <td>26-08-2018</td>
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
<!-- content -->

<script>
    $(function(){
        $("#menu-artikel").addClass('active');
    });
</script>

<?php
    require_once('../template/footer.php');
?>