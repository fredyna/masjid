<?php
    require_once('../../controller/KomentarController.php');
    $id = $_GET['id_komentar'];
    $id_artikel = $_GET['id_artikel'];
    $komentar = new KomentarController();
    $komentar->delete($id, $id_artikel);
?>