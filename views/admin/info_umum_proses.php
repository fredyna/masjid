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

        $target_dir = "../../uploads/profil/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check == false) {
            $uploadOk = 0;
        } 
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["foto"]["size"] > 500000) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        if($uploadOk == 0){
            $_SESSION['form'] = 1;
            header('Location: profil_masjid.php');
            die();
        }

        $id = $_POST['id'];
        $data = [
            'foto'              => $_FILES['foto'],
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