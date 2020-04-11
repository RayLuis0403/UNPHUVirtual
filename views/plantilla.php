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

	echo "<script>var validateEst = '". (isset($validateEst) ? $validateEst : false)."';</script>\n";
	echo "<script>var validateAdmin = '". (isset($validateAdmin) ? $validateAdmin : false)."';</script>\n";
	echo "<script>var validateUser = validateAdmin;</script>\n";

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
		<link rel="shorcut icon" href="../images/unphu-favicon-32x32-1.webp">
		<script type="text/javascript" src="../Scripts/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="../Scripts/bootstrap.js"> </script>
		<script src="../Scripts/uikit-icons.min.js"></script>
 		<script src="../Scripts/uikit.js"></script>
 		<script src="../Scripts/utils.js"></script>

		<link rel="stylesheet" href="../css/bootstrap.min.css">
 		<link rel="stylesheet" href="../css/uikit.min.css"/>
		<link rel="stylesheet" href="../css/style.css">
		
		<title><?php echo $titulo; ?></title>

		<script type="text/javascript">
			console.log('plantilla', '<?php echo $titulo?>' );
				
				let path = window.location.pathname;
				let page = path.split("/").pop();

				if(validateUser){
					let currentUser = localStorage.currentUser;
					if(!currentUser){
						alert('No tiene permisos para acceder a esta area.', 'warning');
						window.location = './logout.php';	
					}

					currentUser = JSON.parse(localStorage.currentUser);

					if(validateAdmin && currentUser.Tipo !== 'Administrador'){
						alert('No tiene permisos de administrador para acceder a esta area.', 'warning');
						window.location = './logout.php';	
					}
				}

			function editar(cod){

				let queryString = '';
				if(cod >= 0){
					queryString = "?cod="+cod;
				}
				
				window.location= page + queryString;
			}
		</script>
		
	</head>

	<body >
		<div id='divcuerpo'>
			<?php include('navbar.php'); ?>
	<?php
	}
		
	function __destruct(){
	?>	
		</div>
		<div class="col-md-12" id="divpie">
			<!-- Footer --><!-- Footer -->
			<footer class="page-footer font-small special-color-dark pt-4">

			<!-- Footer Elements -->
			<div class="container">

			<!-- Social buttons -->
			<ul class="list-unstyled list-inline text-center">
				<li class="list-inline-item">
					<a href="" class="uk-icon-button  uk-margin-small-right" uk-icon="facebook"></a>
				</li>
				<li class="list-inline-item">
					<a href="" class="uk-icon-button uk-margin-small-right" uk-icon="twitter"></a>
				</li>
				<li class="list-inline-item">
					<a href="" class="uk-icon-button" uk-icon="google-plus"></a>
				</li>
				<li class="list-inline-item">
					<a href="" class="uk-icon-button" uk-icon="linkedin"></a>
				</li>
			</ul>
			<!-- Social buttons -->

			</div>
			<!-- Footer Elements -->

			<!-- Copyright -->
			<div class="footer-copyright text-center py-3">
				&copy; <?php $f=getdate(); echo($f['year']); ?> Copyright: Derechos Reservados UNPHU Virtual
			</div>
			<!-- Copyright -->

			</footer>
			<!-- Footer -->
		</div>
	</body>
</html>
	
	<?php
	}


}