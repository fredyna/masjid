<?php
    require_once('../controller/AuthController.php');
    $auth = new AuthController();
    session_start();

    if(isset($_POST['submit'])){
        if($_POST['username'] == '' || $_POST['password'] == ''){
            $_SESSION['form'] = 1;
            header('Location: login.php');
            die();
        }

        $data = [
            'username'  => $_POST['username'],
            'password'  => $_POST['password']
        ];
        
        $auth->doLogin($data);
    }
?>