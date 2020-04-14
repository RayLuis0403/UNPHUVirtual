<?php  
	$titulo = "Registro de Usuarios";
	$validateAdmin = true;

	include ("plantilla.php");
	include ("../metodos/engine.php");
	$usuario = new asgClass("usuario");

	if(isset($_GET['cod'])){
		$cod=(isset($_GET['cod']))?$_GET['cod']:0;
		$usuario->Id=$cod+0;
		$usuario->cargar();
	}
?>
<html>
	<head>
		<script type="text/javascript">
			
            var frmusuario;
            $(document).ready(function(){

				frmusuario = document.getElementById('frmusuario');

				frmusuario.onsubmit = saveUsuario;
			});

            function saveUsuario(e){
                e.preventDefault();
                if(!checkForm()){
                    return;
                }
				
                var formData= getFormData('frmusuario');

                $("#btnSave"). prop("disabled", true);
                $("#btnCancel"). prop("disabled", true);

                jQuery.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '../controller/controllerUsuario.php',
                    data: {functionname: 'saveUsuario', formData: formData}, 
                    success:function(dataResponse) {
                        
                        if(dataResponse && dataResponse.saved){

                            $("#btnSave").css('background-color','green');

                            notification("Usuario guardado correctamente.", 'success');
                            setTimeout(function(){ window.location = './usuario.php'; }, 2000);
                        }
                        else {
                            notification(dataResponse.error, 'warning');
                        }
                        
                        $("#btnSave"). prop("disabled", false);
                        $("#btnCancel"). prop("disabled", false);
                    },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log('xhr.status', xhr.status);
						console.log('thrownError', thrownError);
						notification(thrownError, 'danger');
                        
                        $("#btnSave"). prop("disabled", false);
                        $("#btnCancel"). prop("disabled", false);

					}
                });

			}

			function checkForm(){
				
				var cbx_Tipo = document.getElementById("cbx_Tipo").value;
				var cbx_Estado = document.getElementById("cbx_Estado").value;

				let checked = true;

				if(cbx_Tipo == '')
				{
					checked = false;
                    notification('Tipo de usuario requerido.', 'warning');
				}

				if(cbx_Estado == '')
				{
					checked = false;
                    notification('Estado de usuario requerido.', 'warning');
				}

				return checked;
			}

		</script>
	</head>
	<body>
		<div class="col-md-12"> 	
			<h1>Registro de Usuario</h1>
			<form class="uk-grid-small" uk-grid  role="form" method='post' id='frmusuario' >
				
				<div class="uk-width-1-3@s" style="display:none;">
					<label class="uk-form-label" for="txtId">Id</label>
					<div class="uk-form-controls">
						<input class="uk-input" readonly type="text" name='txtId' id='txtId' value="<?php  echo htmlentities($usuario->Id); ?>"  />
					</div>
				</div>

				<div class="uk-width-1-3@s">
					<label class="uk-form-label" for="txtNombre">Nombre</label>
					<div class="uk-form-controls">
						<input class="uk-input" placeholder="" required type='text' name='txtNombre' id='txtNombre' value="<?php  echo htmlentities($usuario->Nombre); ?>"  />
					</div>
				</div>
				
				<div class="uk-width-1-3@s">
					<label class="uk-form-label" for="txtApellidos">Apellidos</label>
					<div class="uk-form-controls">
						<input class="uk-input" placeholder="" required  type='text' name='txtApellidos' id='txtApellidos' value="<?php  echo htmlentities($usuario->Apellidos); ?>"  />
					</div>
				</div>
				
				<div class="uk-width-1-3@s">
					<label class="uk-form-label" for="cbx_Tipo">Tipo</label>
					<div class="uk-form-controls">
						<select class='uk-select'  name='cbx_Tipo' id='cbx_Tipo' style='visibility:visible; width:px;' >
							<option style='visibility:hidden; height:1px;' value=''></option>
							<option <?php if($usuario->Tipo == 'Administrador') echo('selected=selected');?>   value='Administrador'>Administrador</option>
							<option <?php if($usuario->Tipo == 'Docente') echo('selected=selected');?>   value='Docente'>Docente</option>
							<option <?php if($usuario->Tipo == 'Estudiante') echo('selected=selected');?>   value='Estudiante'>Estudiante</option>
						</select>
					</div>
				</div>
				
				<div class="uk-width-1-3@s">
					<label class="uk-form-label" for="txtEmail">Email</label>
					<div class="uk-form-controls">
						<input class="uk-input" placeholder="" required  type='email' name='txtEmail' id='txtEmail' value="<?php  echo htmlentities($usuario->Email); ?>"  />
					</div>
				</div>
				
				<div class="uk-width-1-3@s">
					<label class="uk-form-label" for="txtClave">Clave</label>
					<div class="uk-form-controls">
						<input class="uk-input" placeholder="" required  type='password' name='txtClave' id='txtClave' value="<?php  echo htmlentities(decrypt($usuario->Clave)); ?>"  />
					</div>
				</div>
				
				<div class="uk-width-1-3@s">
					<label class="uk-form-label" for="cbx_Estado">Estado</label>
					<div class="uk-form-controls">
						<select class='uk-select'  name='cbx_Estado' id='cbx_Estado' style='visibility:visible; width:px;' >
							<option style='visibility:hidden; height:1px;' value=''></option>
							<option <?php if($usuario->Estado == 'Activo') echo('selected=selected');?>   value='Activo'>Activo</option>
							<option <?php if($usuario->Estado == 'Inactivo') echo('selected=selected');?>   value='Inactivo'>Inactivo</option>
						</select>
					</div>
				</div>
				
				<div class="uk-width-1-3@s">
						<div class="uk-form-controls" style="margin-top: 31px;">
							<button type='submit' id="btnSave" class='btn btn-primary'>Guardar</button>
							<button type='button' id="btnCancel" class='btn btn-danger' onClick="editar();">Cancelar</button>
						</div>
					</div>

			</form>
			<p></p>
			<?php
				$sql="select * from usuario";
				$grid=new dataGrid(new dataTable($sql));
				$grid->noVisibles = array('Id', 'Clave');
				$grid->setRowAction('onclick','editar',array('Id'));
				$grid->display();
			?>
		</div>
	</body>
</html>