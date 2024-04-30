<?php




session_start();


$loginDetails = new LoginDetails($connect);
$loginDetails->ID = $_SESSION["login_details_id"];
$loginDetails->Load();


$loginDetails->is_type = $_POST["is_type"];
$loginDetails->Save();


?>
