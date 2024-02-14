<?php

        require("class.customer.php");

        //customer 1 
        $objCustomer1 = new Customer();
        $objCustomer1->setCUST_NAME("Marcos");
        $objCustomer1->setCUST_CITY("New York");
        $objCustomer1->setWORKING_AREA("administracion");
        $objCustomer1->setCUST_COUNTRY("America");
        $objCustomer1->setGRADE("Special");
        $objCustomer1->setOPENING_AMT("AMT2");
        $objCustomer1->setPAYMENT_AMT("AMT2PAY");
        $objCustomer1->setOUTSTANDING_AMT("AMT2OUT");
        $objCustomer1->setPHONE_NO(777777777);
        $objCustomer1->setAGENT_CODE(1356);

       
        
        //customer 2 
        $objCustomer2 = new Customer();
        $objCustomer2->setCUST_NAME("Juan");
        $objCustomer2->setCUST_CITY("Barcelona");
        $objCustomer2->setWORKING_AREA("it");
        $objCustomer2->setCUST_COUNTRY("Espana");
        $objCustomer2->setGRADE("Special");
        $objCustomer2->setOPENING_AMT("AMT1");
        $objCustomer2->setPAYMENT_AMT("AMT1PAY");
        $objCustomer2->setOUTSTANDING_AMT("AMT1OUT");
        $objCustomer2->setPHONE_NO(666666666);
        $objCustomer2->setAGENT_CODE(5462);

        print "OBJETO CUSTOMER 1:  <br/>";
        
        print "Nombre: ". $objCustomer1->getCUST_NAME() . "<br/>";
        print "Ciudad: ". $objCustomer1->getCUST_CITY() . "<br/>";
        print "Lugar de trabajo: ". $objCustomer1->getWORKING_AREA() . "<br/>";
        print "Pais: ". $objCustomer1->getCUST_COUNTRY() . "<br/>";
        print "Grado: ". $objCustomer1->getGRADE() . "<br/>";
        print "Obertura amt: ". $objCustomer1->getOPENING_AMT() . "<br/>";
        print "Pago amt: ". $objCustomer1->getPAYMENT_AMT() . "<br/>";
        print "Fuera de sitio amt: ". $objCustomer1->getOUTSTANDING_AMT() . "<br/>";
        print "Numero de telefono: ". $objCustomer1->getPHONE_NO() . "<br/>";
        print "Numero agente: ". $objCustomer1->getAGENT_CODE() . "<br/>";
        
        print "OBJETO CUSTOMER 2:  <br/>";
       
        print "Nombre: ". $objCustomer2->getCUST_NAME() . "<br/>";
        print "Ciudad: ". $objCustomer2->getCUST_CITY() . "<br/>";
        print "Lugar de trabajo: ". $objCustomer2->getWORKING_AREA() . "<br/>";
        print "Pais: ". $objCustomer2->getCUST_COUNTRY() . "<br/>";
        print "Grado: ". $objCustomer2->getGRADE() . "<br/>";
        print "Obertura amt: ". $objCustomer2->getOPENING_AMT() . "<br/>";
        print "Pago amt: ". $objCustomer2->getPAYMENT_AMT() . "<br/>";
        print "Fuera de sitio amt: ". $objCustomer2->getOUTSTANDING_AMT() . "<br/>";
        print "Numero de telefono: ". $objCustomer2->getPHONE_NO() . "<br/>";
        print "Numero agente: ". $objCustomer2->getAGENT_CODE() . "<br/>";
       

?>
