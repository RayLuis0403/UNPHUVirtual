 <?php
 set_time_limit(0);
 error_reporting(E_ALL^E_NOTICE);
 
	if(!isset($titulo)){
		$titulo="";
	}
	
	$titulo .= "-UNPHU Virtual";

	/*ini_set("display_errors", 0);
	ini_set("register_globals",0);
	ini_set("memory_limit", "16M");
	ini_set("upload_max_filesize", "2M");
	ini_set("post_max_size","8M");
	ini_set("max_input_nesting_levels ",64);
	ini_set("allow_url_fopen",0);
	ini_set("allow_url_include ",0);
	ini_set("expose_php",0);*/

	$obj=new plantilla($titulo);

	class plantilla{

	function __construct($titulo=""){
?>
<!DOCTYPE HTML>
<html>

	<head>
	
		<meta charset="UTF-16">
		<!--<meta charset="SQL_LATIN1_GENERAL_CP1_CI_AS">-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shorcut icon" href="../images/logo.jpg">
		<script type="text/javascript" src="../Scripts/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="../Scripts/bootstrap.js"> </script>
 		<script src="../Scripts/uikit.js"></script>

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
 		<link rel="stylesheet" href="../css/uikit.min.css"/>
		
		<title><?php echo $titulo; ?></title>

		
	</head>

	<body >
		<!-- ABAJO opcion para salir -- >
		<div class="modal fade" id="salir" tabindex="-1" role="dialog">
			< !-- cambiar el id junto con el data-target-- >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"></button>
						<h4 class="modal-title">¿Desea Salir?</h4>
					</div>
					< !--Aca abajo hay una parte para el cuerpo de la opcion salir 
					por si hay interes en modificar
					<div class="modal-body">
					</div> -- >
					<div class="modal-footer">
						<a href="logout.php" ><button type="button" class="btn btn-primary" onclick="salir();">Salir</button></a>
					</div>
				</div>
				
			</div>	
		</div>
		-->
		<div id='divcuerpo'>
	<?php
	}

	function __destruct(){
	?>	
			</div>
			<div class="col-md-12" id="divpie">
			    <footer >
					<p style="font-size: 18px;">&copy; <?php $f=getdate(); echo($f['year']); ?>  -  Derechos Reservados UNPHU Virtual.</p> </br>
				</footer>
    
			</div>
	</body>
</html>
	
	<?php
	}


}