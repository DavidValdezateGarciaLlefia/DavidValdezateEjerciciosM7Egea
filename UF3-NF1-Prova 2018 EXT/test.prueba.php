<?php

require("class.pdofactory.php");
require("abstract.databoundobject.php");

class UserApp extends DataBoundObject {

        protected $ID;
        protected $Nom;
        protected $Group;
        protected $Created;
        protected $LastUpdated;
        protected $IsActive;



        protected function DefineTableName() {
                return("userapp");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "nom" => "Nom",
                        "group" => "Group",
                        "created" => "Created",
                        "isactive" => "IsActive",
                        "lastupdated" => "LastUpdated"));
        }
}

print "Running...<br />";

$strDSN = "pgsql:dbname=practica;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $objUserApp = new UserApp($objPDO);
// $now = date('Y-m-d H:i:s');






// $objUserApp->setNom('David');
// $objUserApp->setGroup('Grupo 1');
// $objUserApp->setIsActive(1);

// $objUserApp->Save();
// print "Saving...<br /> <br />";

// print "First user of the app: <br /> ";
// print "ID: " . $objUserApp->getID() . "<br />";
// print "Nom: " . $objUserApp->getNom() . "<br />";
// print "Group: " . $objUserApp->getGroup() . "<br />";
// print "Created: " . $objUserApp->getCreated() . "<br />";
// print "Is active?: " . $objUserApp->getIsActive() . "<br />";
// print "Last updated: " . $objUserApp->getLastUpdated() . "<br />";



// print "Updating...<br /> <br />";
// $objUserApp->setNom('Marcos');
// $objUserApp->setGroup('Grupo 3');
// $objUserApp->setLastUpdated($now);
// $objUserApp->setIsActive(0);

// print "First User app   updated: <br /> <br />";
// print "ID: " . $objUserApp->getID() . "<br />";
// print "Nom: " . $objUserApp->getNom() . "<br />";
// print "Group: " . $objUserApp->getGroup() . "<br />";
// print "Created: " . $objUserApp->getCreated() . "<br />";
// print "Is active?: " . $objUserApp->getIsActive() . "<br />";
// print "Last updated: " . $objUserApp->getLastUpdated() . "<br />";
// $objUserApp->Save();


$objUserApp = new UserApp($objPDO,7);


print "Deleting userapp: <br />";
print "Deleted userapp with id " . $objUserApp->getID() . "<br />";

$objUserApp->MarkForDeletion();
unset($objUserApp);




?>