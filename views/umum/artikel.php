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
    require_once('controller/CategoryController.php');
    require_once('controller/ArtikelController.php');
    require_once('controller/IPServer.php');
    $ip = new IPServer();
    $ip = $ip->getUserIP();
    $data = [
        'id_artikel'    => $id,
        'ip_address'    => $ip
    ];
    $category = new CategoryController();
    $category = $category->getAll();
    $artikel = new ArtikelController();
    $histori = $artikel->addHistoriArtikel($data);
    $histori = $artikel->getHistoriArtikel();
    $artikel = $artikel->getById($id);
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
                    if(isset($artikel)){
                        while($row = $artikel->fetch()){ ?>
                        <div class="col-sm-12 col-main">
                            <p class="text-muted"><i class="fa fa-newspaper-o"></i> Artikel > <a href="index.php?kategori=<?php echo $row['id_kategori']; ?>"><?php echo $row['nama_kategori']; ?></a></p>
                            <img class="thumbnail" src="uploads/artikel/<?php echo $row['thumbnail'];?>" alt="Thumbnail" style="width:100%;"/>
                            <h4 class="judul-artikel"><?php echo $row['judul'];?></h4>
                            <p class="text-muted">OLEH <?php echo strtoupper($row['nama_user']); ?>| <?php echo date('d-m-Y', strtotime($row['created_at'])); ?> | <?php echo strtoupper($row['nama_kategori']);?></p>
                            <p>
                                <?php echo $row['isi'];?>
                            </p>
                        </div>

                <?php   }
                    } ?>
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
            $("#menu-artikel").addClass('active');
        });
    </script>

<?php require_once('footer.php'); ?>