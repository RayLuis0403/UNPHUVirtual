<?php  
	$titulo = "Registro de Usuarios";
	include('plantilla.php');
	include ('../metodos/engine.php');
	$usuario=new asgClass("usuario");
	
?>
<html>
	<head>
	
		<link rel="shorcut icon" href="./img/rayo.ico">
		<script type="text/javascript" src="./js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="./css/bootstrap.js"> </script>
		<link href="./css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="col-md-12" style="background-color:white"> 	
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form role="form" method='post' id='frmusuario' action='controller/controllerUsuario.php'>			
					
						<div class="form-group hidden">
							<label>Id</label>
							<input class="form-control" placeholder="" readonly type='text' name='txtId' id='txtId' value="<?php  echo htmlentities($usuario->Id); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Nombre</label>
							<input class="form-control" placeholder="" type='text' name='txtNombre' id='txtNombre' value="<?php  echo htmlentities($usuario->Nombre); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Apellidos</label>
							<input class="form-control" placeholder="" type='text' name='txtApellidos' id='txtApellidos' value="<?php  echo htmlentities($usuario->Apellidos); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" placeholder="" type='email' name='txtEmail' id='txtEmail' value="<?php  echo htmlentities($usuario->Email); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Clave</label>
							<input class="form-control" placeholder="" type='password' name='txtClave' id='txtClave' value="<?php  echo htmlentities($usuario->Clave); ?>"  />
						</div>			
					
						<div class="form-group">
							<label>Tipo</label>
                            <?php 
                                $td = new dataTable("SELECT Codigo, Descripcion FROM catalogo where catalogo = 'Sexo'");
                                $cb = new comboBox("Tipo", $td );
                                $cb->setValue($usuario->Tipo);
                                $cb->display();
                            ?>
						</div>
					
						<div class="form-group">
							<label>Estado</label>
							
                            <?php 
                                $dTEstado = new dataTable("SELECT Codigo, Descripcion FROM catalogo where catalogo = 'Estado'");
                                $Estado = new comboBox("Estado", $dTEstado );
                                $Estado->setValue($usuario->Estado);
                                $Estado->display();
                            ?>
						</div>
					</form>
					<div>
						<button type='submit' class='btn btn-default'>Guardar</button>
					</div>
					<div id='divRsusuario'></div>
					<script language='javascript'>
						asgForm($('#frmusuario'),$('#divRsusuario'));
					</script>
				</div>
		
				<div style="margin:0px 15px 30px 15px;">
				<?php
						$sql="select * from usuario";
						$grid=new dataGrid(new dataTable($sql));
						$grid->setRowAction('onclick','editar',array('Id'));
						$grid->display();
					?>
				</div>
			</div>
		</div>
	</body>
</html>