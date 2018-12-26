<?php
    require_once('../../controller/GaleriController.php');
    $id = $_GET['id'];
    $id_kegiatan = $_GET['kegiatan'];
    $galeri = new GaleriController();
    $galeri->delete($id, $id_kegiatan);
?>