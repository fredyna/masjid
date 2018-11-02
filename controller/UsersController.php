<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/UsersModel.php');

    class UsersController{

        public function getAll(){
            $user = new UsersModel();
            $data = $user->getData();
            return $data;
        }

        public function getById($id){
            $user = new UsersModel();
            $result = $user->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $user = new UsersModel();
            $save = $user->addData($data);
            if($save){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: user.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: user.php' );
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

        public function updatePassword($id, $data){
            $user = new UsersModel();
            $update = $user->updateDataPassword($id, $data);
            if($update){
                session_start();
                $_SESSION['update'] = 1;
                if($data['profil'] == 'profil'){
                    header('Location: profil_user.php' );
                    die();
                }
                $_SESSION['id_user'] = $id;

                header('Location: user.php' );
                die();
            } else{
                session_start();
                $_SESSION['update'] = 0;
                if($data['profil'] == 'profil'){
                    header('Location: profil_user.php' );
                    die();
                }
                $_SESSION['id_user'] = $id;

                header('Location: user.php' );
                die();
            }
        }

        public function delete($id){
            $user = new UsersModel();
            $delete = $user->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: user.php' );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: user.php' );
                die();
            }
        }
    }

?>