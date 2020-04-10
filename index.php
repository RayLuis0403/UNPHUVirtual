<!DOCTYPE HTML>
<html>
	<head>
		<title>Home - UNPHU Virtual</title>
		<link rel="shorcut icon" href="./images/logo.jpg">
		<script src="./Scripts/jquery-1.11.2.min.js"></script>
		<script src="./Scripts/uikit.js"></script>
		<link rel="stylesheet" href="./css/uikit.min.css"/>
	</head>
	<body>
		<nav class="uk-navbar-container uk-margin" uk-navbar>
			<div class="uk-navbar-left">

			<a style="width: 12%;" href="./" class="uk-navbar-item uk-logo">
				<img   src=".\images\loginLogo.png">
			</a>
				<ul class="uk-navbar-nav">
					<li>
						<a href="./views/about.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Sobre Nosotros
						</a>
					</li>	
					<li>
						<a href="./views/loginEst.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Estudiantes
						</a>
					</li>	
					<li>
						<a href="./views/loginEst.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Docentes
						</a>
					</li>
					<li>
						<a href="./views/loginEst.php">
							<span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
							Administrador
						</a>
					</li>
				</ul>
			</div>
		</nav>
		
		<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="animation: scale; autoplay: true;autoplay-interval:4000">
			<ul class="uk-slideshow-items">
				<li>
					<img  style="width: 12%;" src="./images/loginLogo.png" width="100" height="100" alt="" uk-cover>
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