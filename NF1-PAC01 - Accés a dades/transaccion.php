<?php

require_once("class.pdofactory.php");
print "Running...<br />";

$strDSN = "pgsql:dbname=practica;host=localhost;port=5432;user=postgres;password=postgres";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Begin the transaction
    $objPDO->beginTransaction();

    $strQuery1 = "INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country) VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway')";
    // Asumiendo que quieras ejecutar la misma consulta nuevamente, asegúrate de que el comando SQL esté correctamente formateado
    $strQuery2 = "INSERT INTO Customers (omerName, ContactName, Address, City, PostalCode, Country) VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway')";

    $objPDO->exec($strQuery1);
    $objPDO->exec($strQuery2);

    // Commit the transaction
    $objPDO->commit();

} catch (\PDOException $e) {
    // Rollback the transaction
    $objPDO->rollBack();
    echo "Failed: " . $e->getMessage();
}
?>
