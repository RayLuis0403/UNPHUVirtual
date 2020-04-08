<?php  
	$titulo = "Home";
	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $titulo; ?></title>
		<script src="Scripts/jquery-1.11.2.min.js"></script>
		<script src="Scripts/uikit.js"></script>
		<link rel="stylesheet" href="content/uikit.min.css"/>
	</head>
	<body>
	<nav class="uk-navbar-container uk-margin" uk-navbar>
		<div class="uk-navbar-left">

			<img class="uk-navbar-item uk-logo" src="images\logo.png">
			<ul class="uk-navbar-nav">
				<li>
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
	
	<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow>
		<ul class="uk-slideshow-items">
			<li>
				<img src="images\unphu.png" width="100" height="100" alt="" uk-cover>
			</li>
			<li>
				<img src="images\logo.jpg" width="1800" height="1200" alt="" uk-cover>
			</li>
			<li>
				<img src="images\logo.jpg" width="1800" height="1200" alt="" uk-cover>
			</li>
		</ul>

		<a class="uk-slidenav-large uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
		<a class="uk-slidenav-large uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

	</div>
	
	</body>
</html>