<?php  
	$titulo = "Inicio";	
?>
<html>
	<head>
	
	<meta charset="UTF-16">
		<!--<meta charset="SQL_LATIN1_GENERAL_CP1_CI_AS">-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shorcut icon" href="./images/logo.jpg">
		<script type="text/javascript" src="./Scripts/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="./Scripts/bootstrap.js"> </script>
		<link href="./css/bootstrap.min.css" rel="stylesheet">
		<link href="./css/style.css" rel="stylesheet">
		
		<title>Inicio - UNPHU Virtual</title>

		<script type="text/javascript" src="./Scripts/jquery.slim.js"> </script>
		<script type="text/javascript" src="./Scripts/bootstrap.bundle.min.js"> </script>
		<link href="./css/index.css" rel="stylesheet">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row no-gutter">
				<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
				<div class="col-md-8 col-lg-6">
				<div class="login d-flex align-items-center py-5">
					<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">
						<div class="image-section">
							<img src="./images/loginLogo.png" class="login-image">
						</div>
						<form>
							<div class="form-label-group">
							<input type="input" id="inputUser" class="form-control" placeholder="Usuario" required autofocus>
							<label for="inputUser">Usario</label>
							</div>

							<div class="form-label-group">
							<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
							<label for="inputPassword">Contraseña</label>
							</div>

							<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
							<div class="text-center">
							<a class="small" href="#">Olvide mi contreseña</a></div>
						</form>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>