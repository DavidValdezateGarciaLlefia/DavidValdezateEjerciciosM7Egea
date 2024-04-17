<?php

$html = file_get_contents("http://tle.ivanstanojevic.me/api/tle/25544");

$json = json_decode($html);

$id = $json->satelliteId;
$name = $json->name;
$date = date('Y-m-d H:i:s', strtotime($json->date)); 
$line1 = $json->line1;
$line2 = $json->line2;

echo '<table border="1" style="border-collapse: collapse; width: 100%;">';
echo '<tr><th>ID del Satélite</th><th>Nombre</th><th>Fecha</th><th>Línea 1</th><th>Línea 2</th></tr>';  
echo "<tr>";
echo "<td>{$id}</td>";
echo "<td>{$name}</td>";
echo "<td>{$date}</td>";
echo "<td>{$line1}</td>";
echo "<td>{$line2}</td>";
echo "</tr>";
echo '</table>';

?>
