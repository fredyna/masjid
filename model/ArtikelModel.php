<?php

    $path = dirname(__DIR__);
    require_once($path.'/config/Koneksi.php');

    class ArtikelModel extends Koneksi{
        private $table = 'artikel';
        private $table2 = 'kategori_artikel';
        private $table3 = 'histori_artikel';

        public function getData(){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $id_user = $_SESSION['user_login'];

                $query = "SELECT ".$this->table.".*, ".$this->table2.".kategori AS nama_kategori FROM ".$this->table." JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori WHERE id_user='$id_user'";
                $stmt = $conn->prepare($query); 
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function getDataById($id){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT * FROM ".$this->table." WHERE id_artikel='$id'";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function addData($data){
            $id_kategori    = $data['id_kategori'];
            $id_user        = $_SESSION['user_login'];
            $judul          = $data['judul'];
            $isi            = $data['isi'];
            $thumbnail      = $_FILES["gambar"];

            $target_dir = dirname(__DIR__).'/uploads/artikel/';
            $target_file = $target_dir . basename($thumbnail["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($thumbnail["tmp_name"], $target_file)) {
                $thumbnail = basename( $thumbnail["name"]);
            } else{
                return false;
            }

            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "INSERT INTO ".$this->table." (id_kategori, id_user, judul, thumbnail, isi) 
                VALUES('$id_kategori','$id_user','$judul','$thumbnail','$isi')";
                $conn->exec($query);
                return true;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function updateData($id, $data){
            $id_kategori    = $data['id_kategori'];
            $judul          = $data['judul'];
            $isi            = $data['isi'];

            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $query = "";

                if($data['gambar'] != null){
                    $thumbnail = $_FILES['gambar'];
                    $target_dir = dirname(__DIR__).'/uploads/artikel/';
                    $target_file = $target_dir . basename($thumbnail["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if (move_uploaded_file($thumbnail["tmp_name"], $target_file)) {
                        $thumbnail = basename( $thumbnail["name"]);
                    } else{
                        return false;
                    }

                    $query = "UPDATE ".$this->table." set id_kategori='$id_kategori', judul='$judul', thumbnail='$thumbnail', isi='$isi'
                    WHERE id_artikel='$id'";
                } else {
                    $query = "UPDATE ".$this->table." set id_kategori='$id_kategori', judul='$judul', isi='$isi'
                    WHERE id_artikel='$id'";
                }
                
                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt->rowCount() > 0 ? true:false;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function deleteData($id){
            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "DELETE FROM ".$this->table." WHERE id_artikel='$id'";
                $conn->exec($query);
                return true;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }
    }

?>