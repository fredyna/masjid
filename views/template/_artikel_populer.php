<!-- artikel populer -->
<div id="artikel-populer" class="col-sm-12 col-side">
    <h4>ARTIKEL POPULER</h4>
    <hr style="border: 0.5px solid #999;">
    <div>
        <?php 
            require_once('controller/ArtikelController.php');
            $artikel  = new ArtikelController();
            $histori  = $artikel->getHistoriArtikel();
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