<?php  
	$titulo = "Registro de Usuarios";
	
	include ("plantilla.php");
	include ("../metodos/engine.php");
	$usuario=new asgClass("usuario");

	if(isset($_GET['cod'])){
		$cod=(isset($_GET['cod']))?$_GET['cod']:0;
		$usuario->Id=$cod+0;
		$usuario->cargar();
	}
?>
<html>
	<head>
		<script type="text/javascript">

			function editar(cod){
				let path = window.location.pathname;
				let page = path.split("/").pop();

				let queryString = '';
				if(cod >= 0){
					queryString = "?cod="+cod;
				}
				
				window.location= page + queryString;
			}

			function checkForm(){
				
				var cbx_Tipo = document.getElementById("cbx_Tipo").value;
				var cbx_Estado = document.getElementById("cbx_Estado").value;

				let checked = true;

				if(cbx_Tipo == '')
				{
					checked = false;
					alert('Tipo de usuario requerido.');
				}

				if(cbx_Estado == '')
				{
					checked = false;
					alert('Estado de usuario requerido.');
				}

				return checked;
			}

		</script>
	</head>
	<body>
		<div class="col-md-12" style="background-color:white"> 	
			<div class="row">
				<div class="col-md-4">
					<form role="form" method='post' id='frmusuario' action='../controller/controllerUsuario.php'
					onsubmit="return checkForm(this);" >			
					
						<div class="form-group hidden">
							<label>Id</label>
							<input class="form-control" placeholder="" readonly type='text' name='txtId' id='txtId' value="<?php  echo htmlentities($usuario->Id); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Nombre</label>
							<input class="form-control" placeholder="Nombre" required type='text' name='txtNombre' id='txtNombre' value="<?php  echo htmlentities($usuario->Nombre); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Apellidos</label>
							<input class="form-control" placeholder="Apellidos" required  type='text' name='txtApellidos' id='txtApellidos' value="<?php  echo htmlentities($usuario->Apellidos); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" placeholder="Email" required  type='email' name='txtEmail' id='txtEmail' value="<?php  echo htmlentities($usuario->Email); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Clave</label>
							<input class="form-control" placeholder="Clave" required  type='password' name='txtClave' id='txtClave' value="<?php  echo htmlentities(decrypt($usuario->Clave)); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Tipo</label>
							<select class='form-control'  name='cbx_Tipo' id='cbx_Tipo' style='visibility:visible; width:px;' >
								<option style='visibility:hidden; height:1px;' value=''></option>
								<option <?php if($usuario->Tipo == 'Administrador') echo('selected=selected');?>   value='Administrador'>Administrador</option>
								<option <?php if($usuario->Tipo == 'Docente') echo('selected=selected');?>   value='Docente'>Docente</option>
								<option <?php if($usuario->Tipo == 'Estudiante') echo('selected=selected');?>   value='Estudiante'>Estudiante</option>
							</select>
						</div>
					
						<div class="form-group">
							<label>Estado</label>
							
							<select class='form-control'  name='cbx_Estado' id='cbx_Estado' style='visibility:visible; width:px;' >
								<option style='visibility:hidden; height:1px;' value=''></option>
								<option <?php if($usuario->Estado == 'Activo') echo('selected=selected');?>   value='Activo'>Activo</option>
								<option <?php if($usuario->Estado == 'Inactivo') echo('selected=selected');?>   value='Inactivo'>Inactivo</option>
							</select>
						</div>
					<div>
						<button type='submit' class='btn btn-primary'>Guardar</button>
						<button type='button' class='btn btn-default' onClick="editar();">Cancelar</button>
					</div>
					</form>
					<div id='divRsusuario'></div>
					<script language='javascript'>
						asgForm($('#frmusuario'),$('#divRsusuario'));
					</script>
				</div>
		
				<div style="margin:0px 15px 30px 15px;">
				<?php
						$sql="select * from usuario";
						$grid=new dataGrid(new dataTable($sql));
						$grid->noVisibles = array('Id', 'Clave');
						$grid->setRowAction('onclick','editar',array('Id'));
						$grid->display();
					?>
				</div>
			</div>
		</div>
	</body>
</html>