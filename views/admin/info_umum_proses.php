<?php 
    require_once('../../controller/InfoUmumController.php');
    $info = new InfoUmumController();
    session_start();

    if(isset($_POST['submit-update'])){
        if($_POST['nama_masjid'] == '' || $_POST['ketua_takmir'] == '' || 
        $_POST['tanggal_berdiri'] == '' || $_POST['luas_tanah'] == '' ||
        $_POST['luas_bangunan'] == '' || $_POST['keterangan'] == ''){
            $_SESSION['form'] = 1;
            header('Location: profil_masjid.php');
            die();
        }

        $id = $_POST['id'];
        $data = [
            'nama_masjid'       => $_POST['nama_masjid'],
            'ketua_takmir'      => $_POST['ketua_takmir'],
            'tanggal_berdiri'   => $_POST['tanggal_berdiri'],
            'luas_tanah'        => $_POST['luas_tanah'],
            'luas_bangunan'     => $_POST['luas_bangunan'],
            'keterangan'        => $_POST['keterangan']
        ];
        
        $info->update($id, $data);
    }
?>