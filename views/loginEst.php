<?php

    if (!isset($_SESSION))
        session_start();
?>
<html>
	<head>
	
        <meta charset="UTF-16" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shorcut icon" href="../images/unphu-favicon-32x32-1.webp" />
		<script type="text/javascript" src="../Scripts/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="../Scripts/bootstrap.js"> </script>
		<script type="text/javascript" src="../Scripts/jquery-3.4.1.js"> </script>
		<script type="text/javascript" src="../Scripts/bootstrap.bundle.min.js"> </script>
 		<script src="../Scripts/uikit.js"></script>
 		<script src="../Scripts/utils.js"></script>
		
		<title>UNPHU Virtual</title>

		<link href="../css/bootstrap.min.css" rel="stylesheet" />
		<link href="../css/style.css" rel="stylesheet" />
 		<link rel="stylesheet" href="../css/uikit.min.css"/>
		<link href="../css/index.css" rel="stylesheet">

        <script type="text/javascript">
            $(document).ready(function(){
                $('#txtUser').keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13'){
                        $("#txtPassword").focus();
                    }
                });
                $('#txtPassword').keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13'){
                        $(".btn").click();
                    }
                });
            });

            function checkLoginForm(){
                
				var inputUser = $("#txtUser").val();
				var inputPassword = $("#txtPassword").val();

                let checked = true;

                if(inputUser == '')
                {
                    checked = false;
                    notification('Usuario requerido.', 'warning');
                }

                if(inputPassword == '')
                {
                    checked = false;
                    notification('Contraseña requerida.', 'warning');
                }

                if(checked){
                    validateLogin();
                }1
            }

            function validateLogin(){
                
                setDisableToControls(true);
                jQuery.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '../controller/controllerUsuario.php',
                    data: {functionname: 'validateLogin', txtUser: $("#txtUser").val(), txtPassword: $("#txtPassword").val()}, 
                    success:function(data) {
                        
                        if(data && data.validUser){

                            if(data.user){
                                localStorage.setItem('currentUser', JSON.stringify(data.user));
                            }

                            $("#btnSignIn").css('background-color','green');

                            notification("Usuario validado correctamente.", 'success');
                            setTimeout(function(){ window.location = './about.php'; }, 2000);
                        }
                        else {
                            notification(data.error, 'warning');
                        }
                        
                        setDisableToControls(false);
                    }
                });
            }

            function setDisableToControls(disabled){
                
                $("#btnSignIn"). prop("disabled", disabled);
                $("#txtUser"). prop("disabled", disabled);
                $("#txtPassword"). prop("disabled", disabled);

                if(disabled)
                    $("#forgotPassword").addClass("uk-invisible");
                else
                $("#forgotPassword").removeClass("uk-invisible");
            }

        </script>
        
        <style>
           .bg-image {
                background-image: url('../images/backgroundEst.jpg');
                background-size: cover;
                background-position: center;
            }
        </style>
	</head>
	<body>
    <?php  
	    include ("navbar.php");
    ?>
		<div class="container-fluid">
			<div class="row no-gutter">
				<div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
				<div class="col-md-8 col-lg-6">
				<div class="login d-flex align-items-center py-5">
					<div class="container">
					<div class="row">
						<div class="col-md-9 col-lg-8 mx-auto">
                            <div class="image-section">
                                <img src="../images/unphuVirtual.png" class="login-image">
                            </div>
                            <form role="form" method='post' onsubmit=" checkLoginForm(this);" >
                                <div class="form-label-group">
                                    <input type="email" id="txtUser" name="txtUser" class="form-control" placeholder="Usuario" required autofocus>
                                    <label for="txtUser">Usuario</label>
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="txtPassword" name="txtPassword"  class="form-control" placeholder="Password" required>
                                    <label for="txtPassword">Contraseña</label>
                                </div>

                            </form>
							<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="btnSignIn" type="button" onClick="checkLoginForm();">Ingresar</button>
							<div class="text-center">
							    <a class="small" id="forgotPassword" href="#">Olvide mi contreseña</a>
                            </div>
						</div>
					</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</body>
</html>