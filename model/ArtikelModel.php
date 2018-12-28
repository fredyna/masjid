<?php

    $path = dirname(__DIR__);
    require_once($path.'/config/Koneksi.php');

    class ArtikelModel extends Koneksi{
        private $table = 'artikel';
        private $table2 = 'kategori_artikel';
        private $table3 = 'histori_artikel';
        private $table4 = 'users';

        public function getData(){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $id_user = $_SESSION['user_login'];

                $query = "SELECT ".$this->table.".*, ".$this->table2.".kategori AS nama_kategori, ".$this->table4.".nama AS nama_user FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori JOIN ".$this->table4." ON
                ".$this->table4.".id_user=".$this->table.".id_user WHERE ".$this->table.".id_user='$id_user' AND 
                ".$this->table.".status=1 ORDER BY ".$this->table.".updated_at DESC";

                $stmt = $conn->prepare($query); 
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function getDataNotLogin($offset=0, $key=''){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = '';

                if($key==''){

                    $query = "SELECT ".$this->table.".*, ".$this->table2.".kategori AS nama_kategori, ".$this->table4.".nama AS nama_user FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori JOIN ".$this->table4." ON
                    ".$this->table4.".id_user=".$this->table.".id_user WHERE 
                    ".$this->table.".status=1 ORDER BY ".$this->table.".updated_at DESC
                    LIMIT 5 OFFSET ".$offset;

                } else{

                    $query = "SELECT ".$this->table.".*, ".$this->table2.".kategori AS nama_kategori, ".$this->table4.".nama AS nama_user FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori JOIN ".$this->table4." ON
                    ".$this->table4.".id_user=".$this->table.".id_user WHERE (".$this->table.".judul LIKE '%$key%' OR ".$this->table.".isi LIKE '%$key%') AND
                    ".$this->table.".status=1 ORDER BY ".$this->table.".updated_at DESC
                    LIMIT 5 OFFSET ".$offset;

                }
                

                $stmt = $conn->prepare($query); 
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function getDataById($id){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT ".$this->table.".*, ".$this->table2.".kategori AS nama_kategori, ".$this->table4.".nama AS nama_user FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori JOIN ".$this->table4." ON
                ".$this->table4.".id_user=".$this->table.".id_user WHERE id_artikel='$id'";

                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function getDataByCategory($id){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT ".$this->table.".*, ".$this->table2.".kategori AS nama_kategori, ".$this->table4.".nama AS nama_user FROM ".$this->table." JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori JOIN ".$this->table4." ON
                ".$this->table4.".id_user=".$this->table.".id_user WHERE artikel.id_kategori='$id'";

                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
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
                // echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function updateData($id, $data){
            if(isset($data['id_kategori'])){
                $id_kategori    = $data['id_kategori'];
            } else{
                $id_kategori    = null;
            }
            
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
                // echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function deleteData($id){
            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "UPDATE ".$this->table." set status='0' WHERE id_artikel='$id'";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt->rowCount() > 0 ? true:false;
            } catch(PDOException $e){
                // echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function addDataHistoriArtikel($data){
            $id = $data['id_artikel'];
            $ip = $data['ip_address'];
            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "INSERT INTO ".$this->table3." (id_artikel, ip_address) VALUES('$id', '$ip')";
                $conn->exec($query);
                return true;
            } catch(PDOException $e){
                // echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function getDataHistoriArtikel(){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT ".$this->table3.".*, ".$this->table.".judul, ".$this->table.".id_kegiatan, ".$this->table.".thumbnail, count(".$this->table3.".id_artikel) AS jumlah  FROM ".$this->table3." JOIN ".$this->table." ON ".$this->table.".id_artikel=".$this->table3.".id_artikel GROUP BY ".$this->table3.".id_artikel ORDER BY jumlah DESC LIMIT 5";

                $stmt = $conn->prepare($query); 
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function getTotal(){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT COUNT(*) AS jumlah FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_kategori=".$this->table.".id_kategori JOIN ".$this->table4." ON
                ".$this->table4.".id_user=".$this->table.".id_user ORDER BY ".$this->table.".updated_at DESC";

                $stmt = $conn->prepare($query); 
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

        public function getTotalByCategory($id){
            
        }
    }

?>