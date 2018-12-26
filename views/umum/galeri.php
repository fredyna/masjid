<?php 
    $path = dirname(__DIR__);
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/ArtikelController.php');
    require_once('controller/GaleriController.php');

    $galeri = new GaleriController();
    // $total = $galeri->getTotal();

    // $page_now     = 1;
    // if(isset($_GET['pagination'])){
    //     $page_now = $_GET['pagination'];
    // }

    // $total_page = $total / 1;
    // $sisa_total_page = $total % 1;

    $artikel  = new ArtikelController();
    $histori  = $artikel->getHistoriArtikel();

    $galeri = $galeri->getAll();
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

                <!-- search -->
                <!-- <div class="col-sm-12 col-main">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="key-search" placeholder="Search ..." value="<?php //echo isset($key) ? $key : ''; ?>">
                    </div>
                    <div class="col-sm-2">
                        <button class="form-control btn btn-success" id="btn-search" type="button" class="btn btn-default"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div> -->
                <!-- end search -->

                <div class="col-sm-12 col-main">
                    <h3 style="margin-top: 10px; margin-bottom: 5px;">Galeri</h3>
                    <h3 style="margin-top: 0;margin-bottom: 5px;"><small>Kumpulan dokumentasi kegiatan</small></h3>
                    <hr />
                
                    <?php 
                        if(isset($galeri) && $galeri->rowCount() > 0){ 
                            while($row = $galeri->fetch()){
                        ?>
                            <div class="col-md-4">
                                <a href="index.php?page=galeri_detail&id=<?php echo $row['id_kegiatan'];?>">
                                    <div class="thumbnail gallery-folder">
                                        <img class="center-block" src="assets/img/gallery.png" alt="Gallery" style="width:80%">
                                        <div class="caption text-center">
                                            <?php echo $row['nama_kegiatan'];?><br/>
                                            <?php echo date('d-m-Y',strtotime($row['event_date']));?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php   } 
                        } else { ?>
                        <p class="text-center"><i>Data tidak ditemukan</i></p>
                    <?php } ?>
                </div>
                
                <!-- pagination -->
                <?php /* 
                <?php if(isset($galeri) && $galeri->rowCount() > 0) { ?>
                    
                    <ul class="pagination">
                        <?php
                            $page = 1;
                            
                            while($page < $total_page){
                                if($page_now == $page){
                                    echo '<li class="active"><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                } else{
                                    echo '<li><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                }
                                $page++;
                            }

                            if($total_page >= 1 && $sisa_total_page >= 1) {
                                if($page_now == $page){
                                    echo '<li class="active"><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                } else{
                                    echo '<li><a href="index.php?page=home&pagination='.$page.'">'.$page.'</a></li>';
                                }
                            }
                        ?>
                    </ul>
                <?php } ?> */ ?>
                
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

        function chooseArtikel(id){
            window.location.href = 'index.php?page=detail_kegiatan&id='+id;
        }
    </script>

<?php require_once('footer.php'); ?>