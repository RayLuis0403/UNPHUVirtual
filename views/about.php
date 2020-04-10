<?php

	session_start();
	include('../metodos/asgclass.php');
	include('../metodos/shortclass.php');

	$usuario = obtenerUsuario();
	$isAdmin = ($usuario != null && $usuario->Tipo == "Administrador");
	
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Sobre Nosotros</title>
		<link rel="shorcut icon" href="../images/logo.jpg">
		<script src="../Scripts/uikit-icons.min.js"></script>
		<link rel="stylesheet" href="../content/uikit.min.css"/>
	</head>
	<body>
	
		<nav class="uk-navbar-container uk-margin" uk-navbar>
			<div class="uk-navbar-left">

				<a style="width: 12%;" href="../" class="uk-navbar-item uk-logo">
					<img   src="..\images\loginLogo.png">
				</a>
				<!-- <a class="uk-navbar-item uk-logo" href="#">Logo</a> -->
				<ul class="uk-navbar-nav">
					<li class="uk-active">
						<a href="#">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Sobre Nosotros
						</a>
					</li>
					<?php 
					if($isAdmin){
						echo <<<E
						<li>
							<a href="./usuario.php">
								<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
								Registrar de Usuario
							</a>
						</li>
					<li>
						<a href="./estudiante.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Registrar de Estudiante
						</a>
					</li>	
						<li>
							<a href="./docente.php">
								<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
								Registrar de Docente
							</a>
						</li>
E;
						}
						?>
				</ul>
			</div>
			
			<div class="uk-navbar-right">

				<ul class="uk-navbar-nav">
					<li>
						<a href="./logout.php">Salir</a>
					</li>
				</ul>
			</div>
		</nav>
	</body>
</html>