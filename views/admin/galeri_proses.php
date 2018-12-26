<?php 

    require_once('../../controller/GaleriController.php');
    $galeri = new GaleriController();
    session_start();
    
    if(isset($_POST['submit-add'])){
        if($_POST['kegiatan'] == '' || $_POST['judul'] == ''){
            $_SESSION['form'] = 1;
            header('Location: galeri.php');
            die();
        }
    
        $target_dir = "../../uploads/galeri/";
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
        if ($_FILES["foto"]["size"] > 2097152) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
    
        if($uploadOk == 0){
            $_SESSION['form'] = 1;
            header('Location: galeri.php');
            die();
        }
    
        $data = [
            'foto'              => $_FILES['foto'],
            'id_kegiatan'       => $_POST['kegiatan'],
            'judul'             => $_POST['judul'],
            'keterangan'        => $_POST['keterangan']
        ];
    
        //save ke galeri
        $galeri->add($data);
    } else if(isset($_POST['submit-update'])){
        $id = $_POST['id'];

        if($_POST['kegiatan'] == '' || $_POST['judul'] == ''){
            $_SESSION['form'] = 1;
            $id_galeri = $_POST['id_galeri'];
            header('Location: galeri_detail.php?id='.$id_galeri);
            die();
        }
    
        $data = [
            'id_kegiatan'       => $_POST['kegiatan'],
            'judul'             => $_POST['judul'],
            'keterangan'        => $_POST['keterangan']
        ];
    
        //save ke galeri
        $galeri->update($id, $data);
    }

    header('Location: galeri.php');
    die();

?>