<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/LogsModel.php');

    class LogsController{

        public function getAll(){
            $log = new LogsModel();
            $data = $log->getData();
            return $data;
        }

        public function getLast(){
            $log = new LogsModel();
            $data = $log->getLast();
            return $data;
        }

        public function getById($id){
            $log = new LogsModel();
            $result = $log->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function addData($data){
            $log = new LogsModel();
            $save = $log->addData($data);
            if($save){
                return true;
            } else{
                return false;
            }
        }

        public function delete($id){
            $log = new LogsModel();
            $delete = $log->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: log.php' );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: log.php' );
                die();
            }
        }
    }

?>