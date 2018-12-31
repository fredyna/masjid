<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/KomentarModel.php');

    class KomentarController{

        public function getLast($page, $id_artikel=0){
            $offset = ($page * 5) - 5;

            $komentar = new KomentarModel();
            $data = $komentar->getData($offset, $id_artikel);
            return $data;
        }

        public function add($data, $id_user=null){
            $komentar = new KomentarModel();
            $save = $komentar->addData($data, $id_user);
            if($save){
                session_start();
                $_SESSION['save'] = 1;

                if(isset($_SESSION['user_login'])){
                    header('Location: komentar_detail.php?id_artikel='.$data['id_artikel'] );
                } else{
                    header('Location: ../../index.php?page=artikel&id='.$data['id_artikel'] );
                }
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                if(isset($_SESSION['user_login'])){
                    header('Location: komentar_detail.php?id_artikel='.$data['id_artikel'] );
                } else{
                    header('Location: ../../index.php?page=artikel&id='.$data['id_artikel'] );
                }
                die();
            }
        }

        public function delete($id, $id_artikel){
            $komentar = new KomentarModel();
            $delete = $komentar->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: komentar_detail.php?id_artikel='.$id_artikel );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: komentar_detail.php?id_artikel='.$id_artikel );
                die();
            }
        }

        public function getTotal($id=0){
            $komentar = new KomentarModel();
            $jumlah = 0;
            $result = $komentar->getTotal($id);
            while($row = $result->fetch())
            {
                $jumlah = $row['jumlah'];
            }
            return $jumlah;
        }
    }

?>