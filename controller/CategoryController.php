<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/CategoryModel.php');

    class CategoryController{

        public function getAll(){
            $kategori = new CategoryModel();
            $data = $kategori->getData();
            return $data;
        }

        public function getById($id){
            $kategori = new CategoryModel();
            $result = $kategori->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $kategori = new CategoryModel();
            $save = $kategori->addData($data);
            if($save){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: kategori.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: kategori.php' );
                die();
            }
        }

        public function update($id, $data){
            $kategori = new CategoryModel();
            $update = $kategori->updateData($id, $data);
            if($update){
                session_start();
                $_SESSION['save'] = 1;

                header('Location: kategori.php' );
                die();
            } else{
                session_start();
                $_SESSION['save'] = 0;

                header('Location: kategori.php' );
                die();
            }
        }

        public function delete($id){
            $kategori = new CategoryModel();
            $delete = $kategori->deleteData($id);
            if($delete){
                session_start();
                $_SESSION['delete'] = 1;

                header('Location: kategori.php' );
                die();
            } else{
                session_start();
                $_SESSION['delete'] = 0;

                header('Location: kategori.php' );
                die();
            }
        }
    }

?>