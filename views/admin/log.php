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
    require_once('../../controller/LogsController.php');
    $log = new LogsController();
    $data    = $log->getAll();
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-ios-paper"></i><span class="px-nav-label"></span>LOG SISTEM</h1>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-title">Log Sistem</div>
          <small class="panel-subtitle text-muted">Data Log Sistem</small>
          <div class="panel-body">
            <!-- Notif sukses menyimpan -->
            <?php 
                if(isset($_SESSION['delete'])){
                    if($_SESSION['delete'] == 1){
            ?>
                <div class="col-sm-12">
                    <div class="alert alert-success">
                        Hapus log berhasil!
                    </div>
                </div>
                <br><br><br><br>
            <?php } else{ ?>
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        Hapus log gagal!
                    </div>
                </div>
                <br><br><br><br>    
            <?php   }
                    unset($_SESSION['delete']);
                }
            ?>
            
            <div class="table-success">
                <table id="table-artikel" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Tanggal</th>
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
                                <td><?php echo $row['username'];?></td>
                                <td><?php echo $row['activity'];?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['created_at']));?></td>
                                <td class="text-center">
                                    <button onclick="deleteData('<?php echo $row['id_log'];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php }
                            } else { ?>
                            <tr>
                                <td colspan="5" class="text-center"><i>Tidak ada data</i></td>
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
        $("#menu-log").addClass('active');
    });

    $(function() {
        $('#table-artikel').dataTable();
        $('#table-artikel_wrapper .table-caption').text('Tabel Data Artikel');
        $('#table-artikel_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
    });

    function deleteData(id){
        var y = confirm('Are you sure?');
        if(y == true){
            window.location.href = "log_hapus.php?id_log="+id;
        }
    }
</script>

<?php
    require_once('../template/footer.php');
?>