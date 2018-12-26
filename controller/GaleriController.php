<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/GaleriModel.php');

    class GaleriController{

        public function getAll(){
            $galeri = new GaleriModel();
            $data = $galeri->getData();
            return $data;
        }
        
        public function getById($id){
            $galeri = new GaleriModel();
            $result = $galeri->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function getByKegiatan($id){
            $galeri = new GaleriModel();
            $result = $galeri->getDataByKegiatan($id);
            return $result;
        }

        public function getListTahun(){
            $galeri = new GaleriModel();
            $data = $galeri->getListTahun();
            return $data;
        }

        public function add($data){
            $galeri = new GaleriModel();
            $save = $galeri->addData($data);
            if($save){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: galeri.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: galeri.php' );
                die();
            }
        }

        public function update($id, $data){
            $user = new UsersModel();
            $update = $user->updateData($id, $data);
            if($update){
                session_start();
                $_SESSION['save'] = 1;

                if($data['profil'] == 'profil'){
                    header('Location: profil_user.php' );
                    die();
                }
                header('Location: user.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                if($data['profil'] == 'profil'){
                    header('Location: profil_user.php' );
                    die();
                }
                header('Location: user.php' );
                die();
            }
        }

        public function delete($id, $id_kegiatan){
            $galeri = new GaleriModel();
            $delete = $galeri->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: galeri_detail.php?id='.$id_kegiatan );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: galeri_detail.php?id='.$id_kegiatan );
                die();
            }
        }

        public function getTotal(){
            $galeri = new GaleriModel();
            $jumlah = 0;
            $result = $galeri->getTotal();
            while($row = $result->fetch())
            {
                $jumlah = $row['jumlah'];
            }
            return $jumlah;
        }
    }

?>