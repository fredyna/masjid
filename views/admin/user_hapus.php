<?php
    require_once('../../controller/UsersController.php');
    $id = $_GET['id'];
    $user = new UsersController();
    $user->delete($id);
?>