<?php




session_start();


$loginDetails = new LoginDetails($connect);
$loginDetails->ID = $_SESSION["login_details_id"];
$loginDetails->Load();


$loginDetails->last_activity = date("Y-m-d H:i:s");
$loginDetails->Save();


?>

