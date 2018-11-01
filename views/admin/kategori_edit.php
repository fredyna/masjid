<?php
    require_once('../../controller/CategoryController.php');
    $id = $_POST['id'];
    $kategori = new CategoryController();
    $kategori->getById($id);
?>