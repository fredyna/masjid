<!-- Kegiatan -->
<div id="kegiatan" class="col-sm-12 col-side">
    <h4>KEGIATAN</h4>
    <hr style="border: 0.5px solid #999;">
    <div>
        <?php 
            require_once('controller/KegiatanController.php');
            $kegiatan = new KegiatanController();
            $kegiatan = $kegiatan->getAllNotLogin(1);
            if($kegiatan->rowCount() > 0) {
                while($row = $kegiatan->fetch()){ 
                    echo '<a href="index.php?page=kegiatan&id='.$row['id_kegiatan'].'" class="link-kategori"><img src="uploads/kegiatan/'.$row['gambar'].'" alt="thumbnail" style="width:35px;"/> &nbsp;'.$row['nama_kegiatan'].'</a><br/>';
                } 
            } 
        ?>
    </div>
</div>
<!-- end kegiatan -->