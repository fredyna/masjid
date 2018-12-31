<?php
    session_start();  
    if(!isset($_SESSION['user_login'])){
      header('Location: ../login.php' );
      die();
    } else{
      require_once('../../controller/AuthController.php');
      $auth = new AuthController();
      $user_login = $auth->getUserLogin();
      $id_user = $_SESSION['user_login'];
    }

    $page = 1;
    if(isset($_GET['comment'])){
        $page = $_GET['comment'];
    }

    require_once('../../controller/KomentarController.php');
    require_once('../../controller/ArtikelController.php');
    
    if(isset($_GET['id_artikel'])){
        $id = $_GET['id_artikel'];
        $komentar   = new KomentarController();
        $artikel    = new ArtikelController();
        $artikel    = $artikel->getById($id);
        $jumlah_komen = $komentar->getTotal($id);
        $selisih = $jumlah_komen - ($page * 5);
        $komentar   = $komentar->getLast($page, $id);
    } else{
        header('Location: ../../page404.php');
        die();
    }

    require_once('../template/header.php');
    require_once('../template/navbar.php');
?>

<!-- Content -->
<div class="px-content">
    <div class="page-header">
      <h1><i class="px-nav-icon ion-chatbubbles"></i><span class="px-nav-label"></span>DATA KOMENTAR</h1>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel">
            <?php 
                if(isset($artikel) && $artikel->rowCount() > 0){
                    while($row = $artikel->fetch()){ ?>
                    <div class="panel-title"><?php echo 'Data Komentar di Artikel '.$row['judul']?></div>
                    <small class="panel-subtitle text-muted"><?php echo 'Data Komentar Terbaru '.$row['judul']; ?></small>
            <?php }
                } else { ?>

                <div class="panel-title">Data Komentar</div>
                <small class="panel-subtitle text-muted">Data Komentar Terbaru</small>

            <?php } ?>
          
          <div class="panel-body">
            <div id="komentar">
                <h5>Balas Komentar</h5>
                <?php 
                    if(isset($_SESSION['save'])){
                        if($_SESSION['save'] == 1){
                ?>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            Komentar berhasil ditambahkan!
                        </div>
                    </div>
                    <br><br>
                <?php } else{ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            Komentar gagal ditambahkan!
                        </div>
                    </div>
                    <br><br>    
                <?php   }
                        unset($_SESSION['save']);
                    }
                ?>

                <?php 
                    if(isset($_SESSION['delete'])){
                        if($_SESSION['delete'] == 1){
                ?>
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            Komentar berhasil dihapus!
                        </div>
                    </div>
                    <br><br>
                <?php } else{ ?>
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            Komentar gagal dihapus!
                        </div>
                    </div>
                    <br><br>    
                <?php   }
                        unset($_SESSION['delete']);
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
                <form action="komentar_proses.php" class="form-horizontal" method="post">
                <!-- hidden input id -->

                    <input type="hidden" name="id_artikel" value="<?php echo $id;?>">
                    <input type="hidden" name="id_user" value="<?php echo $id_user;?>">
                    
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label">Komentar</label>
                            <div class="col-sm-9">
                                <textarea name="komentar" class="form-control" placeholder="Masukan komentar ..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <div class="row">
                            <div class="col-sm-11">
                                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-edit"></i> Balas</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <hr />
            
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
                                <i class="fa fa-comments-o"></i><a href="javascript:void(0)" data-toggle="tooltip" title="<?php echo $komen['email_pengirim'];?>">&nbsp;&nbsp; <?php echo $komen['nama_pengirim'] != '' ? $komen['nama_pengirim']:'Admin'; ?></a> mengomentari pada <a href="#"><?php echo $komen['judul'];?></a>
                                <button href="javascript:void(0)" class="btn btn-danger btn-xs pull-right" onclick="deleteData('<?php echo $komen['id_komentar'];?>','<?php echo $komen['id_artikel'];?>')"><i class="fa fa-trash"></i> Hapus</button>
                            </div>
                            <hr class="m-a-0">
                            <div class="widget-comments-item bg-white darken">
                                <?php echo $komen['komentar'];?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
                </div>
            <?php
                if($selisih > 0){
                    echo '<div class="pull-right"><a href="komentar_detail.php?id_artikel='.$id.'&comment='.($page+1).'" class="btn btn-primary btn-xs">Selanjutnya <i class="fa fa-arrow-right"></i></a></div>';
                } else{
                    echo '<div class="pull-right"><a href="javascript:void(0)" class="btn btn-primary btn-xs disabled">Selanjutnya <i class="fa fa-arrow-right"></i></a></div>';
                }

                if($page > 1){
                    echo '<div class="pull-left"><a href="komentar_detail.php?id_artikel='.$id.'&comment='.($page-1).'" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Sebelumnya</a></div>';
                } else{
                    echo '<div class="pull-left"><a href="javascript:void(0)" class="btn btn-primary btn-xs disabled"><i class="fa fa-arrow-right"></i> Sebelumnya</a></div>';
                }
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

    function deleteData(id, id_artikel){
        var y = confirm('Are you sure?');
        if(y == true){
            window.location.href = "komentar_hapus.php?id_artikel="+id_artikel+"&id_komentar="+id;
        }
    }
</script>

<?php
    require_once('../template/footer.php');
?>