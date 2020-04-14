<?php

	if (!isset($_SESSION))
		session_start();
	
	include('./metodos/asgclass.php');
	include('./metodos/shortclass.php');
	$usuario = obtenerUsuario();
	$userLogged = false;
	$isAdmin = false;

	if($usuario != null){
		$userLogged = true;
		$isAdmin = ($usuario->Tipo == "Administrador");
	}

	$currentPage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Home - UNPHU Virtual</title>
		<link rel="shorcut icon" href="./images/unphu-favicon-32x32-1.webp">
		<script src="./Scripts/jquery-1.11.2.min.js"></script>
		<script src="./Scripts/uikit.js"></script>
		<link rel="stylesheet" href="./css/uikit.min.css"/>
	</head>
	<body>
		<nav class="uk-navbar-container uk-margin" uk-navbar>
			<div class="uk-navbar-left">

				<a style="width: 12%;" href="./" class="uk-navbar-item uk-logo">
					<img   src=".\images\unphuVirtual.png">
				</a>
				<ul class="uk-navbar-nav">
					<li>
						<a href="./views/about.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Sobre Nosotros
						</a>
					</li>	
					<?php 
					if($isAdmin){
						echo <<<E
						<li>
							<a href="./views/usuario.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Registro de Usuario
							</a>
						</li>
						<li>
							<a href="./views/estudiante.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Registro de Estudiante
							</a>
						</li>	
						<li>
							<a href="./views/docente.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Registro de Docente
							</a>
						</li>
E;
						}
						else if(!$userLogged) {
							echo <<<E
							<li>
							<a href="./views/loginEst.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Estudiantes
							</a>
						</li>
						<li>
							<a href="./views/loginAdm.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Docentes
							</a>
						</li>	
						<li>
							<a href="./views/loginAdm.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Administrativos
							</a>
						</li>
E;
						}
						?>
					<li>
						<a href="./views/ofertaAcademica.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Oferta Academica
						</a>
					</li>
				</ul>
			</div>
			
			<div class="uk-navbar-left">
				<ul class="uk-navbar-nav">
					<?php
						if($userLogged) {
							echo <<<E
						<li>
							<a href="./views/logout.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Salir
							</a>
						</li>
E;
						}
					?>
				</ul>
			</div>
		</nav>
		
		<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: scale; autoplay: true;autoplay-interval:4000">
			<ul class="uk-slideshow-items">
				<li>
					<img  style="width: 12%;" src="./images/unphuVirtual.png" width="100" height="100" alt="" uk-cover>
				</li>
				<li>
					<img  style="width: 12%;" src="./images/logo.jpg" width="100" height="100" alt="" uk-cover>
				</li>
				<li>
					<img  style="width: 12%;"  src="./images/logo.jpg" width="100" height="100" alt="" uk-cover>
				</li>
			</ul>

			<a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
			<a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

		</div>
	</body>
</html>