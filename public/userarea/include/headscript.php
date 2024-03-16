<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);
// This should be equal to: PATH_TO_VANGUARD_FOLDER/extra/auth.php
include('../../extra/auth.php');
//require_once __DIR__ . '/extra/auth.php';

// Here we just check if user is not 
// logged in, and in that case we redirect
// the user to vanguard login page.

if (! Auth::check()) {
	
	redirectTo('../../public/login');

} 

$user = Auth::user();

$iduserlogin=$user->present()->id;
$nameuser=$user->present()->first_name;
$surnameuser=$user->present()->last_name;
$emailuser=$user->present()->email;
$avatar=$user->present()->avatar;
$idcompany=$user->present()->idcompany;
$kindofrole=$user->present()->role_id;



//$user = "1";
//$iduserlogin="1";
//$nameuser="Claudio";
//$emailuser="info@claudiosironi.com";


?>



<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION["iduserlogin"]=$iduserlogin;
$iduserlog=$_SESSION["iduserlogin"];
$_SESSION["nameuser"]=$nameuser;
$_SESSION["surnameuser"]=$surnameuser;
$_SESSION["emailuser"]=$emailuser;
$_SESSION["photouser"]=$avatar;
$photouser=$_SESSION["photouser"];
?>
<?php 

if (isset($_GET['info'])) {
$infobox=$_GET['info'];
$_SESSION["infobox"]=$infobox;
} 
if (isset($_SESSION["infobox"])) {
	$infobox=$_SESSION["infobox"];
	} else {
	$infobox=""; }
	
?>
<?php require_once('../Connections/gprepapp.php'); 

?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>

<?php //include files
include('../languages/en/general.php');

include("generalsettings.php");
include("class/company.php"); 
?>