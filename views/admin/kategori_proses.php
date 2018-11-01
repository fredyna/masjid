<?php
    require_once('../../controller/CategoryController.php');
    $kategori = new CategoryController();
    session_start();

    if(isset($_POST['submit-add'])){
        if($_POST['kategori'] == ''){
            $_SESSION['form'] = 1;
            header('Location: kategori.php');
            die();
        }

        $data = [
            'kategori'  => $_POST['kategori']
        ];
        
        $kategori->add($data);
    }

    if(isset($_POST['submit-update'])){
        if($_POST['kategori'] == ''){
            $_SESSION['form'] = 1;
            header('Location: kategori.php');
            die();
        }
        $id = $_POST['id'];
        $data = [
            'kategori'  => $_POST['kategori']
        ];
        
        $kategori->update($id, $data);
    }
    die();
?>