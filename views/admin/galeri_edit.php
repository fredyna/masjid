<?php
    require_once('../../controller/GaleriController.php');
    $id = $_POST['id'];
    $galeri = new GaleriController();
    $galeri->getById($id);
?>