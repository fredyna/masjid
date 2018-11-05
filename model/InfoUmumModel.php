<?php 
$path = dirname(__DIR__);
require_once($path.'/config/Koneksi.php');

class InfoUmumModel extends Koneksi{
    private $table = 'informasi_umum';

    public function getData(){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM ".$this->table;
            $stmt = $conn->prepare($query); 
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    public function updateData($id, $data){
        $nama_masjid        = $data['nama_masjid'];
        $ketua_takmir       = $data['ketua_takmir'];
        $tanggal_berdiri    = date('Y-m-d', strtotime($data['tanggal_berdiri']));
        $luas_tanah         = $data['luas_tanah'];
        $luas_bangunan      = $data['luas_bangunan'];
        $keterangan         = $data['keterangan'];
        $foto               = $_FILES["foto"];

        $target_dir = dirname(__DIR__).'/uploads/profil/';
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

            $query = "UPDATE informasi_umum set nama_masjid='$nama_masjid', ketua_takmir='$ketua_takmir', foto='$foto', tanggal_berdiri='$tanggal_berdiri', luas_tanah='$luas_tanah', luas_bangunan='$luas_bangunan',
            keterangan='$keterangan' WHERE id_masjid='$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? true:false;
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }
}

?>