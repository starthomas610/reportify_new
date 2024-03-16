<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_gprepapp = "localhost";
$database_gprepapp = "gpreportifyapp";
$username_gprepapp = "solocla";
$password_gprepapp = "!Massarosa2";

$servername = $hostname_gprepapp;
$username = $username_gprepapp;
$password = $password_gprepapp;
$database = $database_gprepapp;

@session_start();

$gprepapp = mysqli_init();
if (defined("MYSQLI_OPT_INT_AND_FLOAT_NATIVE")) $gprepapp->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, TRUE);
$gprepapp->real_connect($hostname_gprepapp, $username_gprepapp, $password_gprepapp, $database_gprepapp) or die("Connect Error: " . mysqli_connect_error());

?>