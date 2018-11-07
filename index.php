<?php
    // header('Location: views/umum/');
    if(isset($_GET['page'])){
        $page = $_GET['page'];
        switch($page){
            case 'home':
                include('views/umum/index.php'); 
            break;
            case 'artikel': 
                include('views/umum/artikel.php');
            break;
            default: 
                include('page404.php'); 
            break;
        }
        die();
    }
    include('views/umum/index.php');
?>