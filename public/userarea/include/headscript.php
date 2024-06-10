<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

define('BASE_PATH', realpath(__DIR__ . '/../../..'));
define('BASE_URL', '/reportifynew/public/');
define('USERAREA_PATH', '/reportifynew/public/userarea/');
define('INCLUDE_PATH', BASE_URL . 'userarea/include/');
define('ASSETS_PATH', BASE_URL . 'userarea/include/assets/');
// This should be equal to: PATH_TO_VANGUARD_FOLDER/extra/auth.php

require_once(BASE_PATH . '/extra/auth.php');

//require_once __DIR__ . '/extra/auth.php';

// Here we just check if user is not 
// logged in, and in that case we redirect
// the user to vanguard login page.

if (!Auth::check()) {

	redirectTo(BASE_URL . 'login'); // Percorso relativo alla radice del sito

}

$user = Auth::user();

$iduserlogin = $user->present()->id;
$nameuser = $user->present()->first_name;
$surnameuser = $user->present()->last_name;
$emailuser = $user->present()->email;
$avatar = $user->present()->avatar;
$idcompany = $user->present()->idcompany;
$kindofrole = $user->present()->role_id;



//$user = "1";
//$iduserlogin="1";
//$nameuser="Claudio";
//$emailuser="info@claudiosironi.com";


?>



<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

$_SESSION["iduserlogin"] = $iduserlogin;
$iduserlog = $_SESSION["iduserlogin"];
$_SESSION["nameuser"] = $nameuser;
$_SESSION["surnameuser"] = $surnameuser;
$_SESSION["emailuser"] = $emailuser;
$_SESSION["photouser"] = $avatar;
$photouser = $_SESSION["photouser"];
?>
<?php

if (isset($_GET['info'])) {
	$infobox = $_GET['info'];
	$_SESSION["infobox"] = $infobox;
}
if (isset($_SESSION["infobox"])) {
	$infobox = $_SESSION["infobox"];
} else {
	$infobox = "";
}

?>
<?php



require_once(BASE_PATH . '\public\Connections\repnew.php');



?>
<?php require_once(BASE_PATH . '/public/webassist/mysqli/rsobj.php'); ?>
<?php require_once(BASE_PATH . '/public/webassist/mysqli/queryobj.php'); ?>
<?php require_once(BASE_PATH . "/public/webassist/form_validations/wavt_scripts_php.php"); ?>
<?php //include files


include(BASE_PATH . '/public/languages/en/general.php');
include(BASE_PATH . '/public/languages/en/dash.php');

include(BASE_PATH . "/public/userarea/include/generalsettings.php");

include(BASE_PATH . "/public/userarea/include/class/company.php");

?>