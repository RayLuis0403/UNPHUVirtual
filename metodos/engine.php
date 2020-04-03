<?php
session_start();
include("configx.php");
include("conexion.php");
include("asgControls.php");
include("asgclass.php");

//Set zona a Santo domingo
date_default_timezone_set("America/Santo_Domingo"); //TU time zone

$n = strpos($_SERVER['HTTP_USER_AGENT'],"MSIE");
$isie = false;
if(!($n === false))
{
	$isie= true;
}
define("ISIE",$isie); //Constante que te dice si el Navegador es IE.

//----------------------------------------------------------------

function SelectControl($controlName, $valor, $options = []){
		
	$selectHtml = "<select class='form-control'  name='{$controlName}' id='{$controlName}' style='visibility:visible; width:px;' >";
	foreach($options as $option) {
				
		$comp = "";
		
		if($option->code == $valor || $valor == $option->descripcion){
			$comp = " selected='selected' ";
		}

		$selectHtml .= "<option $comp value='{$option->code}'>{$option->descripcion}</option>";
	}
	$selectHtml .= "</select>";
		
	echo $selectHtml;
}
