<?php

    $path = dirname(__DIR__);
    require_once($path.'/config/Koneksi.php');

    class KegiatanModel extends Koneksi{
        private $table = 'kegiatan';
        private $table2 = 'users';
        private $table3 = 'artikel';

        public function getData(){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $id_user = $_SESSION['user_login'];

                $query = "SELECT ".$this->table.".*, ".$this->table2.".nama AS nama_user FROM ".$this->table." JOIN ".$this->table2." ON ".$this->table2.".id_user=".$this->table.".id_user WHERE ".$this->table.".id_user='$id_user' ORDER BY ".$this->table.".updated_at DESC";

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

                if($key==''){
                    $query = "SELECT ".$this->table.".*, ".$this->table2.".nama AS nama_user FROM ".$this->table." JOIN ".$this->table2." ON ".$this->table2.".id_user=".$this->table.".id_user ORDER BY ".$this->table.".updated_at DESC LIMIT 5 OFFSET ".$offset;
                } else{
                    $query = "SELECT ".$this->table.".*, ".$this->table2.".nama AS nama_user FROM ".$this->table." JOIN ".$this->table2." ON ".$this->table2.".id_user=".$this->table.".id_user WHERE ".$this->table.".nama_kegiatan LIKE '%$key%' OR ".$this->table.".deskripsi LIKE '%$key%' ORDER BY ".$this->table.".updated_at DESC LIMIT 5 OFFSET ".$offset;
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

                $query = "SELECT ".$this->table.".*, ".$this->table2.".nama AS nama_user FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_user=".$this->table.".id_user WHERE ".$this->table.".id_kegiatan='$id'";

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
            $id_user        = $_SESSION['user_login'];
            $nama_kegiatan  = $data['nama_kegiatan'];
            $deskripsi      = $data['deskripsi'];
            $event_date     = date('Y-m-d',strtotime($_POST['event_date']));
            $gambar         = $_FILES["gambar"];

            $target_dir = dirname(__DIR__).'/uploads/kegiatan/';
            $target_file = $target_dir . basename($gambar["name"]);

            if (move_uploaded_file($gambar["tmp_name"], $target_file)) {
                $gambar = basename( $gambar["name"]);
            } else{
                return false;
            }

            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //insert kegiatan
                $query = "INSERT INTO ".$this->table." (id_user, nama_kegiatan, gambar, deskripsi, event_date) 
                VALUES('$id_user','$nama_kegiatan','$gambar','$deskripsi','$event_date')";
                $conn->exec($query);
                $id_kegiatan = $conn->lastInsertId();

                //insert artikel
                $query2 = "INSERT INTO ".$this->table3." (id_kegiatan, id_user, judul, thumbnail, isi) 
                VALUES('$id_kegiatan','$id_user','$nama_kegiatan','$gambar','$deskripsi')";
                $conn->exec($query2);

                return true;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                // return false;
            }
            $conn = null;
        }

        public function updateData($id, $data){
            $nama_kegiatan  = $data['nama_kegiatan'];
            $event_date     = date('Y-m-d',strtotime($data['event_date']));
            $deskripsi      = $data['deskripsi'];

            try{
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $query = "";

                if($data['gambar'] != null){
                    $gambar = $_FILES['gambar'];
                    $target_dir = dirname(__DIR__).'/uploads/kegiatan/';
                    $target_file = $target_dir . basename($gambar["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    if (move_uploaded_file($gambar["tmp_name"], $target_file)) {
                        $gambar = basename( $gambar["name"]);
                    } else{
                        return false;
                    }

                    $query = "UPDATE ".$this->table." set nama_kegiatan='$nama_kegiatan', event_date='$event_date', gambar='$gambar', deskripsi='$deskripsi'
                    WHERE id_kegiatan='$id'";

                    $query2 = "UPDATE ".$this->table3." set judul='$nama_kegiatan', thumbnail='$gambar', isi='$deskripsi'
                    WHERE id_kegiatan='$id'";
                } else {
                    $query = "UPDATE ".$this->table." set nama_kegiatan='$nama_kegiatan', event_date='$event_date', deskripsi='$deskripsi'
                    WHERE id_kegiatan='$id'";

                    $query2 = "UPDATE ".$this->table." set judul='$nama_kegiatan', isi='$deskripsi'
                    WHERE id_kegiatan='$id'";
                }
                
                //update kegiatan
                $stmt = $conn->prepare($query);
                $stmt->execute();

                //update artikel
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute();

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

                //delete kegiatan
                $query = "DELETE FROM ".$this->table." WHERE id_kegiatan='$id'";
                $conn->exec($query);

                //delete artikel
                $query2 = "DELETE FROM ".$this->table3." WHERE id_kegiatan='$id'";
                $conn->exec($query2);

                return true;
            } catch(PDOException $e){
                // echo "Error: " . $e->getMessage();
                return false;
            }
            $conn = null;
        }

        public function getTotal(){
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $query = "SELECT COUNT(*) AS jumlah FROM ".$this->table." LEFT JOIN ".$this->table2." ON ".$this->table2.".id_user=".$this->table.".id_user ORDER BY ".$this->table.".updated_at DESC";

                $stmt = $conn->prepare($query); 
                $stmt->execute();
                return $stmt;
            }
            catch(PDOException $e) {
                // echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
    }

?>