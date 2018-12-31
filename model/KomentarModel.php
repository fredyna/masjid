<?php
$path = dirname(__DIR__);
require_once($path.'/config/Koneksi.php');

class KomentarModel extends Koneksi{
    private $table  = 'komentar';
    private $table2 = 'artikel';

    public function getData($offset=0, $id_artikel=0){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($id_artikel == 0){
                $id_user = $_SESSION['user_login'];

                $query = "SELECT * FROM ".$this->table." JOIN ".$this->table2." ON 
                ".$this->table2.".id_artikel=".$this->table.".id_artikel WHERE ".$this->table.".status=1 AND ".$this->table2.".id_user='$id_user' ORDER BY ".$this->table.".created_at DESC LIMIT 5 OFFSET $offset";
            } else{
                $query = "SELECT * FROM ".$this->table." JOIN ".$this->table2." ON 
                ".$this->table2.".id_artikel=".$this->table.".id_artikel WHERE ".$this->table.".status=1 AND ".$this->table.".id_artikel='$id_artikel' ORDER BY ".$this->table.".created_at DESC LIMIT 5 OFFSET $offset";
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

    public function addData($data, $id_user=null){

        $id_artikel     = $data['id_artikel'];
        $komentar       = $data['komentar'];
        

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($id_user)){

                $query = "INSERT INTO ".$this->table." (id_user, id_artikel, komentar) 
                VALUES('$id_user','$id_artikel','$komentar')";

            } else{
                $nama   = $data['nama'];
                $email  = $data['email'];

                $query = "INSERT INTO ".$this->table." (id_artikel, nama_pengirim, email_pengirim, komentar) 
                VALUES('$id_artikel','$nama','$email','$komentar')";
            }
            
            $conn->exec($query);
            return true;
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

            $query = "UPDATE ".$this->table." set status=0 WHERE id_komentar='$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? true:false;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function getTotal($id_artikel=0){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if(isset($_SESSION['user_login'])){

                $id_user = $_SESSION['user_login'];
                
                if($id_artikel == 0){
                    $query = "SELECT COUNT(*) AS jumlah FROM ".$this->table." JOIN ".$this->table2." ON 
                    ".$this->table2.".id_artikel=".$this->table.".id_artikel WHERE ".$this->table.".status=1 AND ".$this->table2.".id_user='$id_user' ORDER BY ".$this->table.".created_at DESC";
                } else{
                    $query = "SELECT COUNT(*) AS jumlah FROM ".$this->table." JOIN ".$this->table2." ON 
                    ".$this->table2.".id_artikel=".$this->table.".id_artikel WHERE ".$this->table.".status=1 AND ".$this->table2.".id_user='$id_user' AND ".$this->table2.".id_artikel='$id_artikel' ORDER BY ".$this->table.".created_at DESC";
                }
                
            } else{
                $query = "SELECT COUNT(*) as jumlah FROM ".$this->table." JOIN ".$this->table2." ON 
                ".$this->table2.".id_artikel=".$this->table.".id_artikel WHERE ".$this->table.".status=1 AND ".$this->table.".id_artikel='$id_artikel' ORDER BY ".$this->table.".created_at DESC";
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
}

?>