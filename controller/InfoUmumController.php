<?php 
    $path = dirname(__DIR__);
    require_once($path.'/model/InfoUmumModel.php');

    class InfoUmumController{

        public function getAll(){
            $info = new InfoUmumModel();
            $data = $info->getData();
            return $data;
        }

        public function update($id, $data){
            $info = new InfoUmumModel();
            $update = $info->updateData($id, $data);
            if($update){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: profil_masjid.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: profil_masjid.php' );
                die();
            }
        }

    }
?>