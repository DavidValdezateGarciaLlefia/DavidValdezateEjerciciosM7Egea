<?php
        require("class.pdofactory.php");
        require("abstract.databoundobject.php");
	  
      

class Address extends DataBoundObject {

        protected $ID;
        protected $Address;
        protected $Address2;
        protected $District;
        protected $CityID;
        protected $PostalCode;
        protected $Phone;
        protected $LastUpdate;


        protected function DefineTableName() {
                return("address");
        }

        protected function DefineRelationMap() {
                return(array(
                        "id" => "ID",
                        "address" => "Address",
                        "address2" => "Address2",
                        "district" => "District",
                        "city_id" => "CityID",
                        "postal_code" => "PostalCode",
                        "phone" => "Phone",
                        "last_update" => "LastUpdate",));
        }
}


        print "Running...<br />";

        $strDSN = "pgsql:dbname=practica;host=localhost;port=5432";
        $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
        $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $objAddress = new Address($objPDO);

        // $objAddress->setAddress("Calle Aleatoria 12 5º 4º");
        // $objAddress->setAddress2("Calle Aleatoria2 26 1º 6º");
        // $objAddress->setDistrict("Distrito aleatorio");
        // $objAddress->setCityID(1);
        // $objAddress->setPostalCode(12345);
        // $objAddress->setPhone("666666666");
        // $objAddress->Save();
        // print "Saving...<br /> <br />";
	
	    // print "First Address: <br /> ";
        // print "ID: " . $objAddress->getID() . "<br />";
        // print "Address: " . $objAddress->getAddress() . "<br />";
        // print "Address secondary: " . $objAddress->getAddress2() . "<br />";
        // print "District: " . $objAddress->getDistrict() . "<br />";
        // print "City Id: " . $objAddress->getCityID() . "<br />";
        // print "Postal Code: " . $objAddress->getPostalCode() . "<br />";
        // print "Phone: " . $objAddress->getPhone() . "<br />";
        // print "Last update: " . $objAddress->getLastUpdate() . "<br />";
        
        // print "Updating...<br /> <br />";
        // $objAddress->setAddress("Calle Random 52 2º 4º");
        // $objAddress->setAddress2("Calle Random 64 136 1º 6º");
        // $objAddress->setDistrict("Distrito random");
        // $objAddress->setCityID(2);
        // $objAddress->setPostalCode(54321);
        // $objAddress->setPhone("777777777");
        // $objAddress->Save();
        // print "Address updated: <br /> <br />";
        // print "ID: " . $objAddress->getID() . "<br />";
        // print "Address: " . $objAddress->getAddress() . "<br />";
        // print "Address secondary: " . $objAddress->getAddress2() . "<br />";
        // print "District: " . $objAddress->getDistrict() . "<br />";
        // print "City Id: " . $objAddress->getCityID() . "<br />";
        // print "Postal Code: " . $objAddress->getPostalCode() . "<br />";
        // print "Phone: " . $objAddress->getPhone() . "<br />";
        // print "Last update: " . $objAddress->getLastUpdate() . "<br />";

    $objAddress = new Address($objPDO,6);
	

	print "Deleting address: <br />";
	print "Deleted address with id " . $objAddress->getID() . "<br />";
	
	$objAddress->MarkForDeletion();
	unset($objAddress);


      
?>