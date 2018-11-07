<?php

    $path = dirname(__DIR__);
    require_once($path.'/model/ArtikelModel.php');

    class ArtikelController{

        public function getAll(){
            $artikel = new ArtikelModel();
            $data = $artikel->getData();
            return $data;
        }

        public function getAllNotLogin(){
            $artikel = new ArtikelModel();
            $data = $artikel->getDataNotLogin();
            return $data;
        }

        public function getById($id){
            $artikel = new ArtikelModel();
            $result = $artikel->getDataById($id);
            return $result;
        }

        public function getByIdJson($id){
            $artikel = new ArtikelModel();
            $result = $artikel->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $artikel = new ArtikelModel();
            $save = $artikel->addData($data);
            if($save){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: artikel.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: artikel.php' );
                die();
            }
        }

        public function update($id, $data){
            $artikel = new ArtikelModel();
            $update = $artikel->updateData($id, $data);
            if($update){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: artikel.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: artikel.php' );
                die();
            }
        }

        public function delete($id){
            $artikel = new ArtikelModel();
            $delete = $artikel->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: artikel.php' );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: artikel.php' );
                die();
            }
        }

    }

?>