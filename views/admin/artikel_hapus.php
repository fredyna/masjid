<?php
    require_once('../../controller/ArtikelController.php');
    $id = $_GET['id_artikel'];
    $artikel = new ArtikelController();
    $artikel->delete($id);
?>