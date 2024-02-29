<?php

require("class.pdofactory.php");
require("abstract.databoundobject.php");

class City extends DataBoundObject {

        protected $ID;
        protected $City;
        protected $CountryID;
        protected $LastUpdate;



        protected function DefineTableName() {
                return("city");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "city" => "City",
                        "country_id" => "CountryID",
                        "last_update" => "LastUpdate"));
        }
}

print "Running...<br />";

$strDSN = "pgsql:dbname=practica;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $objCity = new City($objPDO);






// $objCity->setCity('Barcelona');
// $objCity->setCountryID(5);

// $objCity->Save();
// print "Saving...<br /> <br />";

// print "First City: <br /> ";
// print "ID: " . $objCity->getID() . "<br />";
// print "City: " . $objCity->getCity() . "<br />";
// print "CountryID: " . $objCity->getCountryID() . "<br />";
// print "LastUpdate: " . $objCity->getLastUpdate() . "<br />";


// print "Updating...<br /> <br />";
// $objCity->setCity('Tokyo');
// $objCity->setCountryID(3);
// print "City   updated: <br /> <br />";
// print "ID: " . $objCity->getID() . "<br />";
// print "City: " . $objCity->getCity() . "<br />";
// print "CountryID: " . $objCity->getCountryID() . "<br />";
// print "LastUpdate: " . $objCity->getLastUpdate() . "<br />";
// $objCity->Save();
$objCity = new City($objPDO,4);


print "Deleting city: <br />";
print "Deleted city with id " . $objCity->getID() . "<br />";

$objCity->MarkForDeletion();
unset($objCity);




?>