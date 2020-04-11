<?php

	if (!isset($_SESSION))
		session_start();
	
	include('../metodos/asgclass.php');
	include('../metodos/shortclass.php');
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
	</head>
	<body>
		<nav class="uk-navbar-container uk-margin" uk-navbar>
			<div class="uk-navbar-left">

				<a href="../"  class="uk-navbar-item uk-logo"  style="width: 12%;" >
					<img src="../images/unphuVirtual.png">
				</a>
				<ul class="uk-navbar-nav">
					<li>
						<a href="../views/about.php">
							<span class="uk-icon uk-margin-small-right"></span>
							Sobre Nosotros
						</a>
					</li>
					<?php 
					if($isAdmin){
						echo <<<E
						<li>
							<a href="./usuario.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Registro de Usuario
							</a>
						</li>
						<li>
							<a href="./estudiante.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Registro de Estudiante
							</a>
						</li>	
						<li>
							<a href="./docente.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Registro de Docente
							</a>
						</li>
E;
						}
						else if(!$userLogged) {
							echo <<<E
							<li>
							<a href="../views/loginEst.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Estudiantes
							</a>
						</li>
						<li>
							<a href="../views/loginAdm.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Docentes
							</a>
						</li>	
						<li>
							<a href="../views/loginAdm.php">
								<span class="uk-icon uk-margin-small-right"></span>
								Administrativos
							</a>
						</li>
E;
						}
						?>
					<li>
						<a href="../views/ofertaAcademica.php">
							<span class="uk-icon uk-margin-small-right"></span>
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
							<a href="logout.php">
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
	</body>
</html>