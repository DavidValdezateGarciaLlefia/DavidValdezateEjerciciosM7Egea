<?php

        require("class.user.php");
        require("class.pdofactory.php");

        print "Running...<br />";

        $strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
        $objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root",array());
        $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     $objUser = new User($objPDO);
		$objUser2 = new User($objPDO);
		$objUser3 = new User($objPDO);

		
       	$objUser->setFirstName("Carlos");
	$objUser->setLastName("Martínez");
	$objUser->setUsername("carlosuser");
	$objUser->setPassword("c3254weRweTrtwedsfss");
	$objUser->setEmailAddress("carlosmar@gmail.com");
	$objUser->setDateLastLogin("2024-02-22");
	$objUser->setTimeLastLogin("15:30:00");
	$objUser->setDateAccountCreated("2024-01-23");
	$objUser->setTimeAccountCreated("16:20:00");
        $objUser->Save();

	
       	$objUser2->setFirstName("Marta");
	$objUser2->setLastName("Gómez");
	$objUser2->setUsername("martauser");
	$objUser2->setPassword("543a54RweTrtwedsfss");
	$objUser2->setEmailAddress("magomez@gmail.com");
	$objUser2->setDateLastLogin("2024-12-01");
	$objUser2->setTimeLastLogin("11:25:00");
	$objUser2->setDateAccountCreated("2023-11-21");
	$objUser2->setTimeAccountCreated("12:20:00");
        $objUser2->Save();

	
       	$objUser3->setFirstName("Juan");
	$objUser3->setLastName("Garcia");
	$objUser3->setUsername("juanuser");
	$objUser3->setPassword("34345254weRweTrtwedsfss");
	$objUser3->setEmailAddress("juga@gmail.com");
	$objUser3->setDateLastLogin("2022-10-21");
	$objUser3->setTimeLastLogin("16:50:00");
	$objUser3->setDateAccountCreated("2022-09-12");
	$objUser3->setTimeAccountCreated("12:10:25");
        $objUser3->Save();
	
        

        print "Saving...<br /> <br />";
	
	print "First user: <br /> ";
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
	
	print "Second user: . <br /> ";
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

        print "Third user: . <br /> ";
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

	
	print "Updating...<br /> <br />";

	
	$ogFirstName = $objUser->getFirstName();
	$ogLastName = $objUser->getLastName();
	$ogUsername = $objUser->getUsername();
	$ogPassword = $objUser->getPassword();
	$ogEmailAddress = $objUser->getEmailAddress();
	$ogDateLastLogin = $objUser->getDateLastLogin();
	$ogTimeLastLogin = $objUser->getTimeLastLogin();
	$ogDateAccountCreated = $objUser->getDateAccountCreated();
	$ogTimeAccountCreated = $objUser->getTimeAccountCreated();

	$og2FirstName = $objUser2->getFirstName();
	$og2LastName = $objUser2->getLastName();
	$og2Username = $objUser2->getUsername();
	$og2Password = $objUser2->getPassword();
	$og2EmailAddress = $objUser2->getEmailAddress();
	$og2DateLastLogin = $objUser2->getDateLastLogin();
	$og2TimeLastLogin = $objUser2->getTimeLastLogin();
	$og2DateAccountCreated = $objUser2->getDateAccountCreated();
	$og2TimeAccountCreated = $objUser2->getTimeAccountCreated();
	

        $objUser->setFirstName($objUser3->getFirstName());
	$objUser->setLastName($objUser3->getLastName());
	$objUser->setUsername($objUser3->getUsername());
	$objUser->setPassword($objUser3->getPassword());
	$objUser->setEmailAddress($objUser3->getEmailAddress());
	$objUser->setDateLastLogin($objUser3->getDateLastLogin());
	$objUser->setTimeLastLogin($objUser3->getTimeLastLogin());
	$objUser->setDateAccountCreated($objUser3->getDateAccountCreated());
	$objUser->setTimeAccountCreated($objUser3->getTimeAccountCreated());
        $objUser->Save();

	$objUser2->setFirstName($ogFirstName);
	$objUser2->setLastName($ogLastName);
	$objUser2->setUsername($ogUsername);
	$objUser2->setPassword($ogPassword);
	$objUser2->setEmailAddress($ogEmailAddress);
	$objUser2->setDateLastLogin($ogDateLastLogin);
	$objUser2->setTimeLastLogin($ogTimeLastLogin);
	$objUser2->setDateAccountCreated($ogDateAccountCreated);
	$objUser2->setTimeAccountCreated($ogTimeAccountCreated);
        $objUser2->Save();

	$objUser3->setFirstName($og2FirstName);
	$objUser3->setLastName($og2LastName);
	$objUser3->setUsername($og2Username);
	$objUser3->setPassword($og2Password);
	$objUser3->setEmailAddress($og2EmailAddress);
	$objUser3->setDateLastLogin($og2DateLastLogin);
	$objUser3->setTimeLastLogin($og2TimeLastLogin);
	$objUser3->setDateAccountCreated($og2DateAccountCreated);
	$objUser3->setTimeAccountCreated($og2TimeAccountCreated);
        $objUser3->Save();
	
	print "Update complete! <br /> <br />";

	print "First user: . <br /> ";
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
	
	print "Second user: . <br /> ";
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

        print "Third user: . <br />  ";
	print "ID: " . $objUser2->getID() . "<br />";
        print "First name is " . $objUser3->getFirstName() . "<br />";
        print "Last name is " . $objUser3->getLastName() . "<br />";
	print "Username is " . $objUser3->getUsername() . "<br />";
	print "md5_pw (password) is " . $objUser3->getPassword() . "<br />";
	print "Email address is " . $objUser3->getEmailAddress() . "<br />";
	print "Last date login is " . $objUser3->getDateLastLogin() . "<br />";
	print "Time last login is " . $objUser3->getTimeLastLogin() . "<br />";
	print "Date account created is " . $objUser3->getDateAccountCreated() . "<br />";
	print "Time account created is " . $objUser3->getTimeAccountCreated() . "<br />";

	$objUser = new User($objPDO,53);
	$objUser2 = new User($objPDO,54);
	$objUser3 = new User($objPDO,55);

	print "Deleting users: <br />";
	print "Deleted user with id " . $objUser->getID() . "<br />";
	print "Deleted user with id " . $objUser2->getID() . "<br />";
	print "Deleted user with id " . $objUser3->getID() . "<br />";
	$objUser->MarkForDeletion();
	unset($objUser);

	$objUser2->MarkForDeletion();
	unset($objUser2);

	$objUser3->MarkForDeletion();
	unset($objUser3);


	
	