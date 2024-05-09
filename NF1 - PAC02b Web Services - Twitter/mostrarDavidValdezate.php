<?php

require_once('class.pdofactory.php');
require_once('abstract.databoundobject.php');
require_once('class.twitter.php');


$strDSN = "pgsql:dbname=practica;host=localhost;port=5432";
    $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $objTwitter = new TwitterApi($objPDO,1);

    echo "Mostrando datos de la base de datos twitterapi:";

    echo "<br>";
    print "ID: " . $objTwitter->getID() . "<br />";

    print "URL: " . $objTwitter->getURL() . "<br />";
    print "Nombre autor: " . $objTwitter->getNombre_autor() . "<br />";
    print "Url autor: " . $objTwitter->getURL_autor() . "<br />";

?>