<?php

require("class.pdofactory.php");
require("abstract.databoundobject.php");
class Store extends DataBoundObject {

        protected $ID;
        protected $ManagerStaffID;
        protected $AddressID;
        protected $LastUpdate;



        protected function DefineTableName() {
                return("store");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "manager_staff_id" => "ManagerStaffID",
                        "address_id" => "AddressID",
                        "last_update" => "LastUpdate"));
        }
}

print "Running...<br />";

$strDSN = "pgsql:dbname=practica;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$objStore = new Store($objPDO);

// $objStore->setManagerStaffID(2);
// $objStore->setAddressID(5);

// $objStore->Save();
// print "Saving...<br /> <br />";

// print "First Store: <br /> ";
// print "ID: " . $objStore->getID() . "<br />";
// print "ManagerStaffID: " . $objStore->getManagerStaffID() . "<br />";
// print "AddressID: " . $objStore->getAddressID() . "<br />";
// print "LastUpdate: " . $objStore->getLastUpdate() . "<br />";


// print "Updating...<br /> <br />";
// $objStore->setManagerStaffID(1);
// $objStore->setAddressID(8);
// print "Store   updated: <br /> <br />";
// print "ID: " . $objStore->getID() . "<br />";
// print "ManagerStaffID: " . $objStore->getManagerStaffID() . "<br />";
// print "AddressID: " . $objStore->getAddressID() . "<br />";
// print "LastUpdate: " . $objStore->getLastUpdate() . "<br />";

// $objStore->Save();

$objStore = new Store($objPDO,7);


print "Deleting store: <br />";
print "Deleted store with id " . $objStore->getID() . "<br />";

$objStore->MarkForDeletion();
unset($objStore);



?>

