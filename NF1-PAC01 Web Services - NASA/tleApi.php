<?php


$html = file_get_contents("http://tle.ivanstanojevic.me/api/tle/25544");

$json = json_decode($html);

$id = $json->satelliteId;
$name = $json->name;
$date = date('Y-m-d H:i:s', strtotime($json->date));
$line1 = $json->line1;
$line2 = $json->line2;
#$date = date('Y-m-d H:i:s', strtotime($json->date));

$host = 'localhost';
$port = 5432;
$dbname = 'practica';
$user = 'postgres';
$password = 'root';


$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
try {
   
    $conn = new PDO($dsn);
    if($conn) {
        $sql = "INSERT INTO apitsl (satelliteId, name, date, line1, line2) VALUES ({$id}, '{$name}', '{$date}', '{$line1}', '{$line2}')";
        $conn->exec($sql); 
        echo "Valores insertados correctamente";
    }
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}
?>