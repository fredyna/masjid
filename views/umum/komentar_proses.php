<?php 

    require_once('../../controller/KomentarController.php');
    $komentar = new KomentarController();

    if(isset($_POST['submit']) ){
        $id = $_POST['id_artikel'];

        if($_POST['nama'] == '' || $_POST['email'] == '' ||
            $_POST['komentar'] == ''){
            $_SESSION['form'] = 1;
            header('Location: index.php?page=artikel&id='.$id);
            die();
        }

        $data = [
            'id_artikel'    => $id,
            'nama'          => $_POST['nama'],
            'email'         => $_POST['email'],
            'komentar'      => $_POST['komentar']
        ];
        
        $komentar->add($data);
    }

?>