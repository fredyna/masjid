<?php

require_once('../../controller/KegiatanController.php');
require_once('../../controller/ArtikelController.php');
$kegiatan = new KegiatanController();
$artikel = new ArtikelController();
session_start();

if(isset($_POST['submit-add'])){
    if($_POST['nama_kegiatan'] == '' || $_POST['event_date'] == '' || $_POST['deskripsi'] == ''){
        $_SESSION['form'] = 1;
        header('Location: tambah_kegiatan.php');
        die();
    }

    $target_dir = "../../uploads/kegiatan/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check == false) {
        $uploadOk = 0;
    } 
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["gambar"]["size"] > 2097152) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        $_SESSION['form'] = 1;
        header('Location: tambah_kegiatan.php');
        die();
    }

    $data = [
        'gambar'            => $_FILES['gambar'],
        'nama_kegiatan'     => $_POST['nama_kegiatan'],
        'deskripsi'         => $_POST['deskripsi'],
        'event_date'        => $_POST['event_date']
    ];

    //save ke kegiatan
    $kegiatan->add($data);
}

if(isset($_POST['submit-update'])){
    $id = $_POST['id'];

    if($_POST['nama_kegiatan'] == '' || $_POST['event_date'] == '' || $_POST['deskripsi'] == ''){
        $_SESSION['form'] = 1;
        header('Location: kegiatan_edit.php?id_kegiatan='.$id);
        die();
    }

    $data = [
        'nama_kegiatan'     => $_POST['nama_kegiatan'],
        'deskripsi'         => $_POST['deskripsi'],
        'event_date'        => $_POST['event_date']
    ];

    if(file_exists($_FILES['gambar']['tmp_name']) || is_uploaded_file($_FILES['gambar']['tmp_name'])){
        $target_dir = "../../uploads/kegiatan/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if($check == false) {
            $uploadOk = 0;
        } 
        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["gambar"]["size"] > 2097152) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        if($uploadOk == 0){
            $_SESSION['form'] = 1;
            header('Location: kegiatan_edit.php?id_kegiatan='.$id);
            die();
        }

        $data['gambar'] = $_FILES['gambar'];
    }
    
    $kegiatan->update($id, $data);
}

?>