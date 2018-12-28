<?php
$path = dirname(__DIR__);
require_once($path.'/config/Koneksi.php');

class LogsModel extends Koneksi{
    private $table  = 'logs';
    private $table2 = 'users';

    public function getData(){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT * FROM '.$this->table.' JOIN '.$this->table2.' ON '
            .$this->table2.'.id_user='.$this->table.'.id_user WHERE '.$this->table.'.status=1 ORDER BY '.$this->table.'.created_at DESC';
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

    public function getLast(){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT * FROM '.$this->table.' JOIN '.$this->table2.' ON '
            .$this->table2.'.id_user='.$this->table.'.id_user WHERE '.$this->table.'.status=1 LIMIT 5 ORDER BY '.$this->table.'.created_at DESC';
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

            $query = "SELECT * FROM ".$this->table." WHERE id_log='$id'";
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

    public function addData($activity){
        $id_user        = $_SESSION['user_login'];

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO ".$this->table." (id_user, activity) 
            VALUES('$id_user','$activity')";
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

            $query = "UPDATE ".$this->table." set status=0 WHERE id_log='$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? true:false;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }
}

?>