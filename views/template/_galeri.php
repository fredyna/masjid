<div id="galeri" class="col-sm-12 col-side">
    <h4>GALERI MASJID</h4>
    <hr style="border: 0.5px solid #999;">
    <div class="row">
        <?php 
            require_once('controller/GaleriController.php');
            $galeri = new GaleriController();

            $galeri = $galeri->getListTahun();
            if($galeri->rowCount() > 0){
                while($row = $galeri->fetch()){ ?>
                    <div class="col-md-4 col-sm-6 text-center">
                        <a href="index.php?page=galeri&id=<?php echo $row['id_kegiatan']; ?>"><img src="assets/img/folder.png" alt="Folder" style="width:100%;">
                        <span class="text-galeri"><?php echo $row['tahun'];?></span></a>
                    </div>
        <?php } 
            } ?>
    </div>
</div>