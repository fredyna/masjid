<?php

require_once('../../controller/ArtikelController.php');
$artikel = new ArtikelController();
session_start();

if(isset($_POST['submit-add'])){
    if($_POST['judul'] == '' || $_POST['kategori'] == '' || $_POST['isi'] == ''){
        $_SESSION['form'] = 1;
        header('Location: tambah_artikel.php');
        die();
    }

    $target_dir = "../../uploads/artikel/";
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
    if ($_FILES["gambar"]["size"] > 500000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        $_SESSION['form'] = 1;
        header('Location: tambah_artikel.php');
        die();
    }

    $data = [
        'gambar'   => $_FILES['gambar'],
        'judul'       => $_POST['judul'],
        'id_kategori' => $_POST['kategori'],
        'isi'         => $_POST['isi']
    ];
    
    $artikel->add($data);
}

if(isset($_POST['submit-update'])){
    $id = $_POST['id'];

    if($_POST['judul'] == '' || $_POST['kategori'] == '' || $_POST['isi'] == ''){
        $_SESSION['form'] = 1;
        header('Location: artikel_edit.php?id_artikel='.$id);
        die();
    }

    $data = [
        'judul'       => $_POST['judul'],
        'id_kategori' => $_POST['kategori'],
        'isi'         => $_POST['isi']
    ];

    if(file_exists($_FILES['gambar']['tmp_name']) || is_uploaded_file($_FILES['gambar']['tmp_name'])){
        $target_dir = "../../uploads/artikel/";
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
        if ($_FILES["gambar"]["size"] > 500000) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        if($uploadOk == 0){
            $_SESSION['form'] = 1;
            header('Location: artikel_edit.php?id_artikel='.$id);
            die();
        }

        $data['gambar'] = $_FILES['gambar'];
    }
    
    $artikel->update($id, $data);
}

?>