<?php 
    $path = dirname(__DIR__);
    require_once($path.'/umum/header.php');
    require_once($path.'/umum/navbar.php');
    require_once('controller/CategoryController.php');
    require_once('controller/InfoUmumController.php');
    require_once('controller/ArtikelController.php');
    $category = new CategoryController();
    $category = $category->getAll();
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
                <div id="kegiatan" class="col-sm-12 col-side">
                    <h4>KEGIATAN</h4>
                    <hr style="border: 0.5px solid #999;">
                </div>
                <!-- end kegiatan -->
                <!-- kategori -->
                <div id="kategori" class="col-sm-12 col-side">
                    <h4>KATEGORI ARTIKEL</h4>
                    <hr style="border: 0.5px solid #999;">
                    <div id="list-kategori">
                        <?php if($category->rowCount() > 0) {
                            while($row = $category->fetch()){ 
                                echo '<a href="index.php?kategori='.$row['id_kategori'].'" class="link-kategori">'.$row['kategori'].'</a><br/>';
                                } 
                            } 
                        ?>
                    </div>
                </div>
                <!-- end kategori -->
                <!-- artikel populer -->
                <div id="artikel-populer" class="col-sm-12 col-side">
                    <h4>ARTIKEL POPULER</h4>
                    <hr style="border: 0.5px solid #999;">
                    <div id="list-kategori">
                        <?php if($histori->rowCount() > 0) {
                            while($row = $histori->fetch()){ 
                                echo '<a href="index.php?page=artikel&id='.$row['id_artikel'].'" class="link-kategori"><img src="uploads/artikel/'.$row['thumbnail'].'" alt="thumbnail" style="width:35px;"/> &nbsp;'.$row['judul'].'</a><br/>';
                                } 
                            } 
                        ?>
                    </div>
                </div>
                <!-- end artikel populer -->
                <!-- galeri -->
                <div id="galeri" class="col-sm-12 col-side">
                    <h4>GALERI MASJID</h4>
                    <hr style="border: 0.5px solid #999;">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 text-center">
                            <img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                            <span class="text-galeri">2018</span>
                        </div>
                        <div class="col-md-4 col-sm-6 text-center">
                            <img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                            <span class="text-galeri">2017</span>
                        </div>
                        <div class="col-md-4 col-sm-6 text-center">
                            <img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                            <span class="text-galeri">2016</span>
                        </div>
                        <div class="col-md-4 col-sm-6 text-center">
                            <img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                            <span class="text-galeri">2015</span>
                        </div>
                        <div class="col-md-4 col-sm-6 text-center">
                            <img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                            <span class="text-galeri">2014</span>
                        </div>
                        <div class="col-md-4 col-sm-6 text-center">
                            <img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                            <span class="text-galeri">2013</span>
                        </div>
                    </div>
                </div>
                <!-- end galeri -->

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