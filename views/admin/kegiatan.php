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
    require_once('../../controller/KegiatanController.php');
    $kegiatan = new KegiatanController();
    $data    = $kegiatan->getAll();
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-ios-paper"></i><span class="px-nav-label"></span>KELOLA KEGIATAN</h1>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-title">Kegiatan</div>
          <small class="panel-subtitle text-muted">Kelola Kegiatan</small>
          <div class="panel-body">
            <!-- Notif simpan sukses -->
            <?php 
                if(isset($_SESSION['save'])){
                    if($_SESSION['save'] == 1){
            ?>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        kegiatan berhasil disimpan!
                    </div>
                </div>
                <br><br>
            <?php } else{ ?>
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        kegiatan gagal disimpan!
                    </div>
                </div>
                <br><br>    
            <?php   }
                    unset($_SESSION['save']);
                }
            ?>

            <!-- Notif hapus sukses -->
            <?php 
                if(isset($_SESSION['delete'])){
                    if($_SESSION['delete'] == 1){
            ?>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        Kegiatan berhasil dihapus!
                    </div>
                </div>
                <br><br>
            <?php } else{ ?>
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        Kegiatan gagal dihapus!
                    </div>
                </div>
                <br><br>    
            <?php   }
                    unset($_SESSION['delete']);
                }
            ?>

            <a class="btn btn-success" href="tambah_kegiatan.php"><i class="fa fa-plus"></i> Tambah Kegiatan</a>
            <br><br>
            <div class="table-success">
                <table id="table-kegiatan" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
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
                                <td><?php echo $row['nama_kegiatan'];?></td>
                                <td><?php echo $row['nama_user'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td class="text-center">
                                    <button onclick="editData('<?php echo $row['id_kegiatan'];?>')" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button>
                                    <button onclick="deleteData('<?php echo $row['id_kegiatan'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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
        $("#menu-kegiatan").addClass('active');
    });

    $(function() {
        $('#table-kegiatan').dataTable();
        $('#table-kegiatan_wrapper .table-caption').text('Tabel Data kegiatan');
        $('#table-kegiatan_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
    });

    function editData(id){
        window.location.href = "kegiatan_edit.php?id_kegiatan="+id;
    }
    function deleteData(id){
        var y = confirm('Are you sure?');
        if(y == true){
            window.location.href = "kegiatan_hapus.php?id_kegiatan="+id;
        }
    }
</script>

<?php
    require_once('../template/footer.php');
?>