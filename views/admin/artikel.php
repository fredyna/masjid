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
    require_once('../../controller/ArtikelController.php');
    $artikel = new ArtikelController();
    $data    = $artikel->getAll();
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
          <?php 
                if(isset($_SESSION['save'])){
                    if($_SESSION['save'] == 1){
            ?>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        Artikel berhasil disimpan!
                    </div>
                </div>
                <br><br>
            <?php } else{ ?>
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        Artikel gagal disimpan!
                    </div>
                </div>
                <br><br>    
            <?php   }
                    unset($_SESSION['save']);
                }
            ?>

            <a class="btn btn-success" href="tambah_artikel.php"><i class="fa fa-plus"></i> Tambah Artikel</a>
            <br><br>
            <div class="table-success">
                <table id="table-artikel" class="table table-bordered table-striped table-hover">
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
                        <?php 
                            $no = 1;
                            if($data->rowCount() > 0) { 
                                while($row = $data->fetch()) {
                        ?>
                            <tr>
                                <td><?php echo $no++;?></td>
                                <td><?php echo $row['judul'];?></td>
                                <td><?php echo $row['nama_kategori'];?></td>
                                <td>Fredy</td>
                                <td>26-08-2018</td>
                                <td class="text-center">
                                    <button onclick="editData('<?php echo $row['id_artikel'];?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                    <button onclick="deleteData('<?php echo $row['id_artikel'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php }
                            } else { ?>
                            <tr>
                                <td colspan="6" class="text-center"><i>Tidak ada data</i></td>
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
<!-- content -->

<script>
    $(function(){
        $("#menu-artikel").addClass('active');
    });

    $(function() {
        $('#table-artikel').dataTable();
        $('#table-artikel_wrapper .table-caption').text('Tabel Data Artikel');
        $('#table-artikel_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
    });

    function editData(id){
        window.location.href = "artikel_edit.php?id_artikel="+id;
    }
    function deleteData(id){
        var y = confirm('Are you sure?');
        if(y == true){
            window.location.href = "artikel_hapus.php?id_artikel="+id;
        }
    }
</script>

<?php
    require_once('../template/footer.php');
?>