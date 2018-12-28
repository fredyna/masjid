<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_masjid";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM artikel";
    $stmt = $conn->prepare($query); 
    $stmt->execute();

    // set the resulting array to associative
    // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    while($row = $stmt->fetch()){
        echo $row['judul'];
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?>