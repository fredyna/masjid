<?php
    require_once('../../controller/ArtikelController.php');
    $artikel  = new ArtikelController();
    $id_artikel = $_GET['id_artikel'];
    $artikel  = $artikel->getById($id_artikel);
?>