<?php
    require_once('../../controller/UsersController.php');
    $id = $_POST['id'];
    $user = new UsersController();
    $user->getById($id);
?>