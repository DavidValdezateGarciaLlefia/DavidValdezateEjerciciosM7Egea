<?php

        require("class.user.select.php");
        require("class.pdofactory.php");

        print "Running...<br />";

        $strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
        $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
        $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $objUser = new User($objPDO, 1);
	$objUser2 = new User($objPDO, 2);
	$objUser3 = new User($objPDO, 3);

        print "ID: " . $objUser->getID() . "<br />";
        print "First name is " . $objUser->getFirstName() . "<br />";
        print "Last name is " . $objUser->getLastName() . "<br />";
	print "Username is " . $objUser->getUsername() . "<br />";
	print "md5_pw (password) is " . $objUser->getPassword() . "<br />";
	print "Email address is " . $objUser->getEmailAddress() . "<br />";
	print "Last date login is " . $objUser->getDateLastLogin() . "<br />";
	print "Time last login is " . $objUser->getTimeLastLogin() . "<br />";
	print "Date account created is " . $objUser->getDateAccountCreated() . "<br />";
	print "Time account created is " . $objUser->getTimeAccountCreated() . "<br />";

	print "ID: " . $objUser2->getID() . "<br />";
        print "First name is " . $objUser2->getFirstName() . "<br />";
        print "Last name is " . $objUser2->getLastName() . "<br />";
	print "Username is " . $objUser2->getUsername() . "<br />";
	print "md5_pw (password) is " . $objUser2->getPassword() . "<br />";
	print "Email address is " . $objUser2->getEmailAddress() . "<br />";
	print "Last date login is " . $objUser2->getDateLastLogin() . "<br />";
	print "Time last login is " . $objUser2->getTimeLastLogin() . "<br />";
	print "Date account created is " . $objUser2->getDateAccountCreated() . "<br />";
	print "Time account created is " . $objUser2->getTimeAccountCreated() . "<br />";

	print "ID: " . $objUser3->getID() . "<br />";
        print "First name is " . $objUser3->getFirstName() . "<br />";
        print "Last name is " . $objUser3->getLastName() . "<br />";
	print "Username is " . $objUser3->getUsername() . "<br />";
	print "md5_pw (password) is " . $objUser3->getPassword() . "<br />";
	print "Email address is " . $objUser3->getEmailAddress() . "<br />";
	print "Last date login is " . $objUser3->getDateLastLogin() . "<br />";
	print "Time last login is " . $objUser3->getTimeLastLogin() . "<br />";
	print "Date account created is " . $objUser3->getDateAccountCreated() . "<br />";
	print "Time account created is " . $objUser3->getTimeAccountCreated() . "<br />";
	


?>
