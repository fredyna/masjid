<?php
    require_once('../../controller/LogsController.php');
    $id = $_GET['id_log'];
    $log = new LogsController();
    $log->delete($id);
?>