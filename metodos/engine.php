<?php
session_start();
include("configx.php");
include("conexion.php");
include("asgControls.php");
if(!class_exists('asgclass'))
include("asgclass.php");
if(!class_exists('usuario'))
	include("shortclass.php");
include("util.php");

//Set zona a Santo domingo
date_default_timezone_set("America/Santo_Domingo"); //TU time zone

$n = strpos($_SERVER['HTTP_USER_AGENT'],"MSIE");
$isie = false;
if(!($n === false))
{
	$isie= true;
}
define("ISIE",$isie); //Constante que te dice si el Navegador es IE.

