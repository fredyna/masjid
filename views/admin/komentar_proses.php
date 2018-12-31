<?php 

    require_once('../../controller/KomentarController.php');
    $komentar = new KomentarController();

    if(isset($_POST['submit']) ){

        if($_POST['komentar'] == ''){
            $_SESSION['form'] = 1;
            header('Location: komentar_detail.php?id_artikel='.$id);
            die();
        }


        $id_user  = $_POST['id_user'];

        $data = [
            'id_artikel'    => $_POST['id_artikel'],
            'komentar'      => $_POST['komentar']
        ];
        
        $komentar->add($data, $id_user);
    }

?>