<?php

        require("class.user.insert.php");
        require("class.pdofactory.php");

        print "Running...<br />";

        $strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
        $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
        $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $objUser = new User($objPDO, 1);
	$objUser2 = new User($objPDO, 2);

        $ogFirstName = $objUser->getFirstName();
	$ogLastName = $objUser->getLastName();
	$ogUserName = $objUser->getUsername();
	$ogPassword = $objUser->getPassword();
	$ogEmailAddress = $objUser->getEmailAddress();
	$ogDateLastLogin = $objUser->getDateLastLogin();
	$ogTimeLastLogin = $objUser->getTimeLastLogin();
	$ogDateAccountCreated = $objUser->getDateAccountCreated();
	$ogTimeAccountCreated = $objUser->getTimeAccountCreated();

        $objUser->setFirstName($objUser2->getFirstName());
	$objUser->setLastName($objUser2->getLastName());
	$objUser->setUserName($objUser2->getUsername());
	$objUser->setPassword($objUser2->getPassword());
	$objUser->setEmailAddress($objUser2->getEmailAddress());
	$objUser->setDateLastLogin($objUser2->getDateLastLogin());
	$objUser->setTimeLastLogin($objUser2->getTimeLastLogin());
	$objUser->setDateAccountCreated($objUser2->getDateAccountCreated());
	$objUser->setTimeAccountCreated($objUser2->getTimeAccountCreated());
        $objUser->Save();

	$objUser2->setFirstName($ogFirstName);
	$objUser2->setLastName($ogLastName);
	$objUser2->setUserName($ogUserName);
	$objUser2->setPassword($ogPassword);
	$objUser2->setEmailAddress($ogEmailAddress);
	$objUser2->setDateLastLogin($ogDateLastLogin);
	$objUser2->setTimeLastLogin($ogTimeLastLogin);
	$objUser2->setDateAccountCreated($ogDateAccountCreated);
	$objUser2->setTimeAccountCreated($ogTimeAccountCreated);
        $objUser2->Save();

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

