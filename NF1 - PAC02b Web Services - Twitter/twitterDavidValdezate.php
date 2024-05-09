<?php

require_once('class.pdofactory.php');
require_once('abstract.databoundobject.php');
require_once('class.twitter.php');

$url = "https://publish.twitter.com/oembed?url=https%3A%2F%2Ftwitter.com%2FInterior%2Fstatus%2F507185938620219395";
$response = file_get_contents($url);
if ($response !== false) {
    $data = json_decode($response, true);
    $url = $data['url'];
    $authorName = $data['author_name'];
    $authorUrl = $data['author_url'];
    $htmlContent = $data['html'];
    $width = isset($data['width']) ? $data['width'] : 'not specified';
    $height = isset($data['height']) ? $data['height'] : 'not specified';
    $type = $data['type'];
    $cacheAge = $data['cache_age'];
    $providerName = $data['provider_name'];
    $providerUrl = $data['provider_url'];
    $version = $data['version'];

    echo "URL: " . $url . "<br>";
    echo "Nombre autor: " . $authorName . "<br>";
    echo "URL autor: " . $authorUrl . "<br>";
    echo "Contenido HTML: " . htmlspecialchars($htmlContent) . "<br>"; 
    echo "Ancho " . $width . "<br>";
    echo "Altura: " . $height . "<br>";
    echo "Tipo: " . $type . "<br>";
    echo "Tiempo cache: " . $cacheAge . "<br>";
    echo "Nombre proveedor: " . $providerName . "<br>";
    echo "Proveedor URL: " . $providerUrl . "<br>";
    echo "Versión: " . $version . "<br>";

    $strDSN = "pgsql:dbname=practica;host=localhost;port=5432";
    $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Metiendo datos obtenidos de twitter en la base de datos...";
    echo "<br>";

    $objTwitter = new TwitterApi($objPDO);
    $objTwitter->setURL($url);
    $objTwitter->setNombre_autor($authorName);
    $objTwitter->setURL_autor($authorUrl);
    $objTwitter->Save();

    echo "Objetos metidos en la base de datos:";

    echo "<br>";
    print "URL: " . $objTwitter->getURL() . "<br />";
    print "Nombre autor: " . $objTwitter->getNombre_autor() . "<br />";
    print "Url autor: " . $objTwitter->getURL_autor() . "<br />";



} else {
    echo "Error al recuperar los datos.";
}

?>