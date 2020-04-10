<html>
	<head>
	
        <meta charset="UTF-16" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shorcut icon" href="../images/logo.jpg" />
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
                
                jQuery.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '../controller/controllerUsuario.php',
                    data: {functionname: 'validateLogin', txtUser: $("#txtUser").val(), txtPassword: $("#txtPassword").val()}, 
                    success:function(data) {
                        if(data && data.validUser){
                            $("#txtUser"). prop("disabled", true);
                            $("#txtPassword"). prop("disabled", true);
                            $(".btn"). prop("disabled", true);
                            $(".btn").css('background-color','green');

                            notification("Usuario validado correctamente.", 'success');
                            setTimeout(function(){ window.location = './unphu.php'; }, 2000);
                        }
                        else {
                            notification(data.error, 'warning');
                        }
                    }
                });
            }

        </script>
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
                                <img src="../images/loginLogo.png" class="login-image">
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
							<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="btnSignIn" type="button" onClick="checkLoginForm();">Sign in</button>
							<div class="text-center">
							    <a class="small" href="#">Olvide mi contreseña</a>
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