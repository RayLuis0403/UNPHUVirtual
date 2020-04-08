<?php  
	$titulo = "Sobre Nosotros";
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $titulo; ?></title>
		<script src="../Scripts/uikit-icons.min.js"></script>
		<link rel="stylesheet" href="../content/uikit.min.css"/>
	</head>
	<body>
	<nav class="uk-navbar-container uk-margin" uk-navbar>
		<div class="uk-navbar-left">

			<img class="uk-navbar-item uk-logo" src="..\images\logo.png">
			<!-- <a class="uk-navbar-item uk-logo" href="#">Logo</a> -->
			<ul class="uk-navbar-nav">
				<li class="uk-active">
					<a href="#">
						<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
						Sobre Nosotros
					</a>
				</li>	
				<li>
					<a href="#">
						<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
						Estudiantes
					</a>
				</li>
			</ul>
		</div>
	</nav>
	</body>
</html>