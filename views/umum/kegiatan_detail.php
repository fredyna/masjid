<?php 
    $path = dirname(__DIR__);
    $id = '';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else{
        header('Location: page404.php');
        die();
    }
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/ArtikelController.php');
    require_once('controller/KegiatanController.php');
    
    $artikel = new ArtikelController();
    $kegiatan = new KegiatanController();

    $histori = $artikel->getHistoriArtikel();
    $kegiatan = $kegiatan->getById($id);
    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
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
                <?php 
                    if(isset($kegiatan)){
                        while($row = $kegiatan->fetch()){ 
                        $tgl = date('d', strtotime($row['created_at']));
                        $bulan = $bulan[date('m',strtotime($row['created_at'])) - 1];
                        $tahun = date('Y', strtotime($row['created_at']));
                        $tgl_fix = $tgl . ' ' . $bulan . ' ' . $tahun;     
                        ?>
                        <div class="col-sm-12 col-main">
                            <p class="text-muted"><i class="fa fa-newspaper-o"></i> Kegiatan</p>
                            
                            <img class="thumbnail" src="uploads/kegiatan/<?php echo $row['gambar'];?>" alt="Thumbnail" style="width:100%;"/>
                            
                            <h4 class="judul-artikel"><?php echo $row['nama_kegiatan'];?></h4>
                            <p class="text-muted">OLEH <?php echo strtoupper($row['nama_user']); ?>| <?php echo $tgl_fix; ?></p>
                            <p>
                                <?php echo $row['deskripsi'];?>
                            </p>

                            <hr />
                        </div>

                <?php   }
                    } ?>
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
                    <div id="list-kategori">
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
            $("#menu-kegiatan").addClass('active');
        });
    </script>

<?php require_once('footer.php'); ?>