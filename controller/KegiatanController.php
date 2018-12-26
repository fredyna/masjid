<?php

    $path = dirname(__DIR__);
    require_once($path.'/model/KegiatanModel.php');
    require_once($path.'/model/ArtikelModel.php');

    class KegiatanController{

        public function getAll(){
            $kegiatan = new KegiatanModel();
            $data = $kegiatan->getData();
            return $data;
        }

        public function getAllNotLogin($page, $key=''){
            $kegiatan = new KegiatanModel();
            $offset = ($page * 5) - 5;
            $data = $kegiatan->getDataNotLogin($offset, $key);
            return $data;
        }

        public function getById($id){
            $kegiatan = new KegiatanModel();
            $result = $kegiatan->getDataById($id);
            return $result;
        }

        public function getByCategory($id){
            $kegiatan = new KegiatanModel();
            $result = $kegiatan->getDataByCategory($id);
            return $result;
        }

        public function getByIdJson($id){
            $kegiatan = new KegiatanModel();
            $result = $kegiatan->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $kegiatan = new KegiatanModel();
            $save = $kegiatan->addData($data);

            if($save){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: kegiatan.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: kegiatan.php' );
                die();
            }
        }

        public function addArtikel($data){
            $artikel = new ArtikelModel();
            $save = $artikel->addDataKegiatan($data);
            
            if($save){
                return true;
            } else{
                return false;
            }
        }

        public function update($id, $data){
            $kegiatan = new KegiatanModel();
            $update = $kegiatan->updateData($id, $data);
            if($update){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: kegiatan.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: kegiatan.php' );
                die();
            }
        }

        public function delete($id){
            $kegiatan = new KegiatanModel();
            $delete = $kegiatan->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: kegiatan.php' );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: kegiatan.php' );
                die();
            }
        }

        public function getTotal(){
            $kegiatan = new KegiatanModel();
            $jumlah = 0;
            $result = $kegiatan->getTotal();
            while($row = $result->fetch())
            {
                $jumlah = $row['jumlah'];
            }
            return $jumlah;
        }
    }

?>