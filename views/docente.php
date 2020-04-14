<?php
    $titulo = "Registro de Docentes";
	$validateAdmin = true;
    include ('plantilla.php');
	include ("../metodos/engine.php");
    $docente = new asgClass("docente");

	if(isset($_GET['cod'])){
		$cod=(isset($_GET['cod']))?$_GET['cod']:0;
		$docente->Id=$cod+0;
        $docente->cargar();
    }
?>

<html>

    <head>
    
        <script type="text/javascript" src="../Scripts/jquery.maskedinput.js"></script>
        
		<script type="text/javascript">
            var frmdocente;
			
            $(document).ready(function(){

                frmdocente = document.getElementById('frmdocente');
                
                frmdocente.onsubmit = saveDocente;

					$("#txtCedula").mask("999-9999999-9");
				$("#txtCelular").mask("999-999-9999");
			});
            
            function saveDocente(e){
                e.preventDefault();
                /*if(!checkForm()){
                    return;
                }*/
                
                var formData= getFormData('frmdocente');

                $("#btnSave"). prop("disabled", true);
                $("#btnCancel"). prop("disabled", true);

                jQuery.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '../controller/controllerDocente.php',
                    data: {functionname: 'saveDocente', formData: formData}, 
                    success:function(dataResponse) {
                        
                        if(dataResponse && dataResponse.saved){

                            $("#btnSave").css('background-color','green');

                            notification("Docente guardado correctamente.", 'success');
                            setTimeout(function(){ window.location = './docente.php'; }, 2000);
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

		</script>
	</head>
    <body>
		<div class="col-md-12"> 	
			<h1>Registro de Docente</h1>

            <form class="uk-grid-small" uk-grid  role="form" method='post' id='frmdocente'>
            
                    <div class="uk-width-1-3@s" style="display:none;">
                        <label class="uk-form-label" for="txtId">Id</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  input-disabled" readonly type="text" name='txtId' id='txtId' value="<?php  echo htmlentities($docente->Id); ?>"  />
                        </div>
                    </div>
                
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label" for="txtCodigo">Codigo</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  input-disabled" readonly placeholder="" required type='text' name='txtCodigo' id='txtCodigo' value="<?php  echo htmlentities($docente->Codigo); ?>"  />
                        </div>
                    </div>
                
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label" for="txtCedula">Cedula</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" placeholder="" required type='text' name='txtCedula' id='txtCedula' value="<?php  echo htmlentities($docente->Cedula); ?>"  />
                        </div>
                    </div>
                
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label" for="txtNombres">Nombres</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" placeholder="" required type='text' name='txtNombres' id='txtNombres' value="<?php  echo htmlentities($docente->Nombres); ?>"  />
                        </div>
                    </div>
                
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label" for="txtApellidos">Apellidos</label>
                        <div class="uk-form-controls">
                            <input class="uk-input" placeholder="" required type='text' name='txtApellidos' id='txtApellidos' value="<?php  echo htmlentities($docente->Apellidos); ?>"  />
                        </div>
                    </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="txtFecha_Nacimiento">Fecha Nacimiento</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" required type='date' name='txtFecha_Nacimiento' id='txtFecha_Nacimiento' value="<?php  echo htmlentities($docente->Fecha_Nacimiento); ?>"  />
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="cbx_Sexo">Sexo</label>
                    <div class="uk-form-controls">
                        <select class='uk-select'  name='cbx_Sexo' id='cbx_Sexo' style='visibility:visible; width:px;' >
                            <option style='visibility:hidden; height:1px;' value=''></option>
                            <option <?php if($docente->Sexo == 'Femenino') echo('selected=selected');?>   value='Femenino'>Femenino</option>
                            <option <?php if($docente->Sexo == 'Masculino') echo('selected=selected');?>   value='Masculino'>Masculino</option>
                        </select>
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="txtEmail">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" required type='text' name='txtEmail' id='txtEmail' value="<?php  echo htmlentities($docente->Email); ?>"  />
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="txtCelular">Celular</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" required type='text' name='txtCelular' id='txtCelular' value="<?php  echo htmlentities($docente->Celular); ?>"  />
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="cbx_Estado">Estado</label>
                    <div class="uk-form-controls">
                        <select class='uk-select'  name='cbx_Estado' id='cbx_Estado' style='visibility:visible; width:px;' >
                            <option style='visibility:hidden; height:1px;' value=''></option>
                            <option <?php if($docente->Estado == 'Activo') echo('selected=selected');?>   value='Activo'>Activo</option>
                            <option <?php if($docente->Estado == 'Inactivo') echo('selected=selected');?>   value='Inactivo'>Inactivo</option>
                        </select>
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="txtCargo">Cargo</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" required type='text' name='txtCargo' id='txtCargo' value="<?php  echo htmlentities($docente->Cargo); ?>"  />
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="txtTitulo">Titulo</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" required type='text' name='txtTitulo' id='txtTitulo' value="<?php  echo htmlentities($docente->Titulo); ?>"  />
                    </div>
                </div>
                
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="txtEspecialidad">Especialidad</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" required type='text' name='txtEspecialidad' id='txtEspecialidad' value="<?php  echo htmlentities($docente->Especialidad); ?>"  />
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
                $sql="select * from docente";
                $grid=new dataGrid(new dataTable($sql));
                $grid->noVisibles = array('Id');
                $grid->setRowAction('onclick','editar',array('Id'));
                $grid->display();
            ?>
        </div>
        
    </body>
</html>