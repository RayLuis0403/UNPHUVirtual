<?php  
	$titulo = "Registro de Estudiantes";
	
	include ("plantilla.php");
	include ("../metodos/engine.php");
	$estudiantes=new asgClass("estudiante");
?>
<html>

    <body>
        <div class="row col-md-12">
            <div class="col-md-4 col-md-offset-4">
                <form role="form" method='post' id='frmestudiante' action='modulos/sfsdfsdf/pagina.php'>			
                
                    <div class="form-group">
                        <label>Id</label>
                        <input class="form-control" placeholder="Id" type='text' name='txtId' id='txtId' value="<?php  echo htmlentities($estudiante->Id); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Matricula</label>
                        <input class="form-control" placeholder="Matricula" type='text' name='txtMatricula' id='txtMatricula' value="<?php  echo htmlentities($estudiante->Matricula); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Cedula</label>
                        <input class="form-control" placeholder="Cedula" type='text' name='txtCedula' id='txtCedula' value="<?php  echo htmlentities($estudiante->Cedula); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Nombres</label>
                        <input class="form-control" placeholder="Nombres" type='text' name='txtNombres' id='txtNombres' value="<?php  echo htmlentities($estudiante->Nombres); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input class="form-control" placeholder="Apellidos" type='text' name='txtApellidos' id='txtApellidos' value="<?php  echo htmlentities($estudiante->Apellidos); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Fecha De Nacimiento</label>
                        <input class="form-control" placeholder="Fecha De Nacimiento" type='text' name='txtFecha_Nacimiento' id='txtFecha_Nacimiento' value="<?php  echo htmlentities($estudiante->Fecha_Nacimiento); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Sexo</label>
                        <input class="form-control" placeholder="Sexo" type='text' name='txtSexo' id='txtSexo' value="<?php  echo htmlentities($estudiante->Sexo); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" placeholder="Email" type='text' name='txtEmail' id='txtEmail' value="<?php  echo htmlentities($estudiante->Email); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Celular</label>
                        <input class="form-control" placeholder="Celular" type='text' name='txtCelular' id='txtCelular' value="<?php  echo htmlentities($estudiante->Celular); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Estado</label>
                        <input class="form-control" placeholder="Estado" type='text' name='txtEstado' id='txtEstado' value="<?php  echo htmlentities($estudiante->Estado); ?>"  />
                    </div>			
                
                    <div class="form-group">
                        <label>Direccion</label>
                        <input class="form-control" placeholder="Direccion" type='text' name='txtDireccion' id='txtDireccion' value="<?php  echo htmlentities($estudiante->Direccion); ?>"  />
                    </div>
                    <div>
                        <button type='submit' class='btn btn-default'>Guardar</button>
                    </div>
                </form>
                <div id='divRsestudiante'></div>
                <script language='javascript'>
                    asgForm($('#frmestudiante'),$('#divRsestudiante'));
                </script>
                
            </div>
        
            <div style="margin:0px 15px 30px 15px;">
            <?php
                    $sql="select * from estudiante";
                    $grid=new dataGrid(new dataTable($sql));
                    $grid->noVisibles = array('Id', 'Clave');
                    $grid->setRowAction('onclick','editar',array('Id'));
                    $grid->display();
                ?>
            </div>
        </div>
    </body>
</html>