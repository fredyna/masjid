<?php 
    $path = dirname(__DIR__);
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/ArtikelController.php');
    require_once('controller/GaleriController.php');
    require_once('controller/KegiatanController.php');

    $id = $_GET['id'];
    $galeri = new GaleriController();

    $artikel  = new ArtikelController();
    $histori  = $artikel->getHistoriArtikel();

    $kegiatan = new KegiatanController();
    $kegiatan = $kegiatan->getById($id);

    $galeri = $galeri->getByKegiatan($id);
?>
    <!-- Hero block -->

    <a class="position-relative" name="home"></a>
    <div id="landing-hero" class="clearfix">
        <div class="container-fluid">
        <!-- Header -->
        <h1 id="judul-web" class="font-weight-semibold">
            MASJID DAARUL FIKRI<br/>
            POLITEKNIK HARAPAN BERSAMA
        </h1>
        </div>
    </div>

    <div id="content-wrapper" class="container">
        <div class="row">
            <!-- main -->
            <div class="col-lg-7 col-content">

                <div class="col-sm-12 col-main">

                    <?php 
                        if($kegiatan->rowCount()){
                            while($row = $kegiatan->fetch()){ ?>
                                <h3 style="margin-top: 10px; margin-bottom: 5px;">Galeri Kegiatan <?php echo $row['nama_kegiatan'];?></h3>
                                <h3 style="margin-top: 0;margin-bottom: 5px;"><small>Tanggal Acara <?php echo date('d-m-Y', strtotime($row['event_date']));?></small></h3>
                                <hr />
                    <?php }
                        } else { ?>
                            <h3 style="margin-top: 10px; margin-bottom: 5px;">Galeri</h3>
                            <h3 style="margin-top: 0;margin-bottom: 5px;"><small>Kumpulan dokumentasi kegiatan</small></h3>
                            <hr />
                    <?php } ?>
                
                    <?php 
                        if(isset($galeri) && $galeri->rowCount() > 0){ 
                            while($row = $galeri->fetch()){
                        ?>
                            <div class="col-md-4">
                                <a href="javascript:void(0)" onclick="showFoto(<?php echo $row['id_galeri']; ?>)">
                                    <div class="thumbnail gallery-folder">
                                        <img class="center-block" src="uploads/galeri/<?php echo $row['foto'];?>" alt="Gallery" style="width:100%">
                                        <div class="caption text-center">
                                            <?php echo $row['judul'];?><br/>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php   } 
                        } else { ?>
                        <p class="text-center"><i>Data tidak ditemukan</i></p>
                    <?php } ?>
                </div>
                
            </div>
            <!-- end main -->

            <!-- side right -->
            <div class="col-lg-4 col-content">
                <!-- kegiatan -->
                <?php include('views/template/_kegiatan.php');?>

                <!-- kategori -->
                <?php include('views/template/_kategori.php');?>

                <!-- artikel populer -->
                <div id="artikel-populer" class="col-sm-12 col-side">
                    <h4>ARTIKEL POPULER</h4>
                    <hr style="border: 0.5px solid #999;">
                    <div>
                        <?php 
                            if($histori->rowCount() > 0) {
                                while($row = $histori->fetch()){ 
                                    if($row['id_kegiatan'] == null) {
                                        echo '<a href="index.php?page=artikel&id='.$row['id_artikel'].'" class="link-kategori"><img src="uploads/artikel/'.$row['thumbnail'].'" alt="thumbnail" style="width:35px;"/> &nbsp;'.$row['judul'].'</a><br/>';
                                    }
                                } 
                            } 
                        ?>
                    </div>
                </div>
                <!-- end artikel populer -->

                <!-- galeri -->
                <?php include('views/template/_galeri.php');?>

            </div>
            <!-- end side right -->
        </div>
    </div>

    <!-- modal form for show -->
    <div id="modal-form" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title" id="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <img id="foto-galeri" alt="Foto Galeri" style="width:100%;" />
                </div>
                <div class="modal-footer">
                    <p id="keterangan-galeri" class="text-left"></p>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal form -->

    <!-- Footer -->

    <div class="px-footer bg-primary text-center">
        <span class="text-white">Copyright © 2018 Masjid Daarul Fikri. All rights reserved.</span>
        </div>
    </div>
    <script>
        $(function(){
            $("#menu-galeri").addClass('active');

            $("#btn-search").click(function(){
                var key = $("#key-search").val();
                window.location = 'index.php?page=kegiatan&key='+key;
            });
        });

        function showFoto(id){
            $.ajax({
                type: "POST",
                url: "views/admin/galeri_edit.php", 
                data: {id: id },
                dataType: "json",
                success:function(response)
                {
                    var urlfoto = "uploads/galeri/"+response[0].foto;
                    $("#modal-title").text(response[0].judul);
                    $("#foto-galeri").attr('src', urlfoto);
                    $("#keterangan-galeri").text(response[0].keterangan);
                    $("#modal-form").modal('show');
                }
            });
        }

        function chooseArtikel(id){
            window.location.href = 'index.php?page=detail_kegiatan&id='+id;
        }
    </script>

<?php require_once('footer.php'); ?>