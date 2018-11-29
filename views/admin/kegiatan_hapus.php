<?php
    require_once('../../controller/KegiatanController.php');
    $id = $_GET['id_kegiatan'];
    $kegiatan = new KegiatanController();
    $kegiatan->delete($id);
?>