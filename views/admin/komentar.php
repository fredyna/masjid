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

    $page = 1;
    if(isset($_GET['comment'])){
        $page = $_GET['comment'];
    }

    require_once('../template/header.php');
    require_once('../template/navbar.php');
    require_once('../../controller/KomentarController.php');
    $komentar = new KomentarController();
    $komentar    = $komentar->getLast($page);
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-chatbubbles"></i><span class="px-nav-label"></span>DATA KOMENTAR</h1>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
          <div class="panel-title">Data Komentar</div>
          <small class="panel-subtitle text-muted">Data Komentar Terbaru</small>
          <div class="panel-body">
            
          <?php if(isset($komentar) && $komentar->rowCount() > 0) { ?>
                <div class="widget-timeline">

            <?php 
                while($komen = $komentar->fetch()){ ?>

                    <div class="widget-timeline-item">
                        <div class="widget-timeline-info">
                            <div class="widget-timeline-icon bg-primary"><i class="fa fa-comment"></i></div>
                            <div class="widget-timeline-time">
                                <?php echo date('m-d-Y', strtotime($komen['created_at']));?>
                                <br/>
                                <?php echo date('h:i', strtotime($komen['created_at']));?>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                <i class="fa fa-comments-o"></i><a href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $komen['email_pengirim'];?>">&nbsp;&nbsp; <?php echo $komen['nama_pengirim']; ?></a> mengomentari pada <a href="../../index.php?page=artikel&id=<?php echo $komen['id_artikel'];?>" target="_blank"><?php echo $komen['judul'];?></a>
                                <a href="komentar_detail.php?id_artikel=<?php echo $komen['id_artikel'];?>" class="btn btn-info btn-xs pull-right">Lihat</a>
                            </div>
                            <hr class="m-a-0">
                            <div class="widget-comments-item bg-white darken">
                                <?php echo $komen['komentar'];?>
                            </div>
                        </div>
                    </div>
            <?php }
                echo '</div>';
                } ?>

          </div>
        </div>
      </div>
    </div>
</div>
<!-- content -->

<script>
    $(function(){
        $("#menu-komentar").addClass('active');
        $('[data-toggle="tooltip"]').tooltip(); 
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