<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/AuthModel.php');
    require_once($path.'/model/UsersModel.php');

    class AuthController{

        function doLogin($data){
            $auth   = new AuthModel();
            $result = $auth->getUserByData($data);
            $id_user = '';
            while($row = $result->fetch())
            {
                $id_user = $row['id_user'];
            }
            $count  = $result->rowCount();
            if($count > 0){
                session_start();
                $_SESSION['user_login'] = $id_user;

                header('Location: admin/index.php' );
                die();
            } else{
                $_SESSION['form'] = 1;
                header('Location: login.php');
                die();
            }
        }

        function getUserLogin(){
            if(isset($_SESSION['user_login'])){
                $id_user = $_SESSION['user_login'];
                $user = new UsersModel();
                $result = $user->getDataById($id_user);
                $row = [];
                while($rows = $result->fetch())
                {
                    $row = [
                        'id_user'   => $rows['id_user'],
                        'username'  => $rows['username'],
                        'email'     => $rows['email'],
                        'nama'      => $rows['nama'],
                        'role'      => $rows['role']
                    ];
                }
                return $row;
            }
            return false;
        }

        function logout(){
            session_start();
            if(isset($_SESSION['user_login'])){
                session_unset();
                session_destroy();
                header('Location: login.php');
                die();
            } else{
                header('Location: login.php');
                die();
            }
        }
    }

?>