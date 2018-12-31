<?php
$path = dirname(__DIR__);
require_once($path.'/config/Koneksi.php');

class GaleriModel extends Koneksi{
    private $table  = 'galeri';
    private $table2 = 'kegiatan';

    public function getData(){

        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($_SESSION['user_login'])){
                $id_user = $_SESSION['user_login'];

                $query = "SELECT * FROM ".$this->table2." JOIN ".$this->table." ON 
                ".$this->table.".id_kegiatan=".$this->table2.".id_kegiatan WHERE ".$this->table.".id_user='$id_user' AND ".$this->table.".status=1 GROUP BY ".$this->table2.".id_kegiatan ORDER BY ".$this->table2.".event_date DESC";
            } else{
                $query = "SELECT * FROM ".$this->table2." JOIN ".$this->table." ON 
                ".$this->table.".id_kegiatan=".$this->table2.".id_kegiatan WHERE ".$this->table.".status=1 GROUP BY ".$this->table2.".id_kegiatan ORDER BY ".$this->table2.".event_date DESC";
            }
            
            $stmt = $conn->prepare($query); 
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function getDataById($id){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM ".$this->table." WHERE id_galeri='$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function getDataByKegiatan($id){

        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($_SESSION['user_login'])){
                $id_user = $_SESSION['user_login'];

                $query = "SELECT * FROM ".$this->table2." JOIN ".$this->table." ON "
                .$this->table.".id_kegiatan=".$this->table2.".id_kegiatan WHERE ".$this->table.".id_kegiatan='$id' AND ".$this->table.".status=1 AND ".$this->table.".id_user='$id_user' ORDER BY ".$this->table2.".event_date DESC";
            } else{
                $query = "SELECT * FROM ".$this->table2." JOIN ".$this->table." ON "
                .$this->table.".id_kegiatan=".$this->table2.".id_kegiatan WHERE ".$this->table.".id_kegiatan='$id' AND ".$this->table.".status=1 AND ORDER BY ".$this->table2.".event_date DESC";
            }

            

            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function addData($data){
        $id_kegiatan    = $data['id_kegiatan'];
        $id_user        = $_SESSION['user_login'];
        $judul          = $data['judul'];
        $keterangan     = $data['keterangan'];
        $foto           = $_FILES["foto"];

        $target_dir = dirname(__DIR__).'/uploads/galeri/';
        $target_file = $target_dir . basename($foto["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (move_uploaded_file($foto["tmp_name"], $target_file)) {
            $foto = basename( $foto["name"]);
        } else{
            return false;
        }

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO ".$this->table." (id_user, id_kegiatan, foto, judul, keterangan) 
            VALUES('$id_user','$id_kegiatan','$foto','$judul','$keterangan')";
            $conn->exec($query);
            return true;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function updateData($id, $data){
        $id_kegiatan    = $data['id_kegiatan'];
        $judul          = $data['judul'];
        $keterangan     = $data['keterangan'];

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "";

            if($data['foto'] != null){
                $foto = $_FILES['foto'];
                $target_dir = dirname(__DIR__).'/uploads/galeri/';
                $target_file = $target_dir . basename($foto["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if (move_uploaded_file($foto["tmp_name"], $target_file)) {
                    $foto = basename( $foto["name"]);
                } else{
                    return false;
                }

                $query = "UPDATE ".$this->table." set id_kegiatan='$id_kegiatan', judul='$judul', foto='$foto', keterangan='$keterangan'
                WHERE id_galeri='$id'";
            } else {
                $query = "UPDATE ".$this->table." set id_kegiatan='$id_kegiatan', judul='$judul', keterangan='$keterangan'
                WHERE id_galeri='$id'";
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

            $query = "UPDATE ".$this->table." set status=0 WHERE id_galeri='$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? true:false;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function getListTahun(){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT id_kegiatan, YEAR(event_date) as tahun FROM '.$this->table2.' GROUP BY YEAR(event_date)';
            $stmt = $conn->prepare($query); 
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function getTotal(){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT COUNT(*) AS jumlah FROM '.$this->table2.' JOIN '.$this->table.' ON '
            .$this->table.'.id_kegiatan='.$this->table2.'.id_kegiatan GROUP BY '.$this->table2.
            '.id_kegiatan';

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