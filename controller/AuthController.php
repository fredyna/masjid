<?php

    require_once('../model/AuthModel.php');

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

            }
        }
    }

?>