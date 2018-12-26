<?php 
    $path = dirname(__DIR__);
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/CategoryController.php');
    require_once('controller/InfoUmumController.php');
    require_once('controller/KegiatanController.php');
    require_once('controller/ArtikelController.php');
    $category = new CategoryController();
    $category = $category->getAll();
    $kegiatan = new KegiatanController();
    $kegiatan = $kegiatan->getAllNotLogin(1);
    $artikel = new ArtikelController();
    $histori = $artikel->getHistoriArtikel();
    $info     = new InfoUmumController();
    $info     = $info->getAll();
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
                        if(isset($info)){
                            while($row = $info->fetch()){ ?>
                            <h4 class="text-center">SEKILAS PROFIL MASJID</h4>
                            <img src="uploads/profil/<?php echo $row['foto'];?>" alt="Foto Masjid" style="width:100%;">
                            <table style="width:100%;margin-top: 20px;">
                                <tr>
                                    <th style="width:30%;">Nama Masjid</th>
                                    <td style="width:5%;">:</td>
                                    <td style="width:65%;"><?php echo $row['nama_masjid'];?></td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Ketua Takmir</th>
                                    <td style="width:5%;">:</td>
                                    <td style="width:65%;"><?php echo $row['ketua_takmir'];?></td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Tanggal Berdiri</th>
                                    <td style="width:5%;">:</td>
                                    <td style="width:65%;"><?php echo date('d-m-Y', strtotime($row['tanggal_berdiri']));?></td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Luas Tanah</th>
                                    <td style="width:5%;">:</td>
                                    <td style="width:65%;"><?php echo $row['luas_tanah'];?> meter</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Luas Bangunan</th>
                                    <td style="width:5%;">:</td>
                                    <td style="width:65%;"><?php echo $row['luas_bangunan'];?> meter</td>
                                </tr>
                                <tr>
                                    <th style="width:30%;">Keterangan</th>
                                    <td style="width:5%;">:</td>
                                    <td style="width:65%;"><?php echo $row['keterangan'];?></td>
                                </tr>
                            </table>
                            <br/><br/>
                    <?php }
                        } ?>
                </div>
            </div>
            <!-- end main -->

            <!-- side right -->
            <div class="col-lg-4 col-content">
                <!-- Kegiatan -->
                <?php include('views/template/_kegiatan.php');?>

                <!-- kategori -->
                <?php include('views/template/_kategori.php');?>

                <!-- artikel populer -->
                <?php include('views/template/_artikel_populer.php');?>

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
            $("#menu-about").addClass('active');
        });
    </script>

<?php require_once('footer.php'); ?>