<?php
    require_once('../../controller/CategoryController.php');
    $id = $_GET['id'];
    $kategori = new CategoryController();
    $kategori->delete($id);
?>