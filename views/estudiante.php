<?php  
	$titulo = "Registro de Estudiantes";
	$validateAdmin = true;
	
	include ("plantilla.php");
	include ("../metodos/engine.php");
    $estudiante=new asgClass("estudiante");
    
	if(isset($_GET['cod'])){
		$cod=(isset($_GET['cod']))?$_GET['cod']:0;
		$estudiante->Id=$cod+0;
        $estudiante->cargar();
    }
?>
<html>

<head>
    
    <script type="text/javascript" src="../Scripts/jquery.maskedinput.js"></script>
    
    <script type="text/javascript">
        var frmestudiante;
        
        $(document).ready(function(){

            frmestudiante = document.getElementById('frmestudiante');
            
            frmestudiante.onsubmit = saveDocente;

                $("#txtCedula").mask("999-9999999-9");
            $("#txtCelular").mask("999-999-9999");
        });
        
        function saveDocente(e){
            e.preventDefault();
            /*if(!checkForm()){
                return;
            }*/
            
            var formData= getFormData('frmestudiante');

            $("#btnSave"). prop("disabled", true);
            $("#btnCancel"). prop("disabled", true);

            jQuery.ajax({
                type: "POST",
                dataType: 'json',
                url: '../controller/controllerEstudiante.php',
                data: {functionname: 'saveEstudiante', formData: formData}, 
                success:function(dataResponse) {
                    
                    if(dataResponse && dataResponse.saved){

                        $("#btnSave").css('background-color','green');

                        notification("Estudiante guardado correctamente.", 'success');
                        setTimeout(function(){ window.location = './estudiante.php'; }, 2000);
                    }
                    else {
                        notification(dataResponse.error, 'warning');
                    }
                    
                    $("#btnSave"). prop("disabled", false);
                    $("#btnCancel"). prop("disabled", false);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log('xhr', xhr);
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
			<form class="uk-grid-small" uk-grid role="form" method='post' id='frmestudiante' >			
                <div class="uk-width-1-3@s "  style="display:none;">
                    <label  class="uk-form-label" for="txtId">Id</label>
                    <div class="uk-form-controls">
                        <input class="uk-input input-disabled" readonly  placeholder="" type='text' name='txtId' id='txtId' value="<?php  echo htmlentities($estudiante->Id); ?>"  />
                    </div>
                </div>			
                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtMatricula">Matricula</label>
                    <div class="uk-form-controls">
                        <input class="uk-input input-disabled" readonly  placeholder="" type='text' name='txtMatricula' id='txtMatricula' value="<?php  echo htmlentities($estudiante->Matricula); ?>"  />
                    </div>
                </div>			
                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtCedula">Cedula</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='text' name='txtCedula' id='txtCedula' value="<?php  echo htmlentities($estudiante->Cedula); ?>"  />
                    </div>
                </div>			
                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtNombres">Nombres</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='text' name='txtNombres' id='txtNombres' value="<?php  echo htmlentities($estudiante->Nombres); ?>"  />
                    </div>
                </div>			
                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtApellidos">Apellidos</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='text' name='txtApellidos' id='txtApellidos' value="<?php  echo htmlentities($estudiante->Apellidos); ?>"  />
                    </div>
                </div>		

                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtFecha_Nacimiento">Fecha Nacimiento</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='date' name='txtFecha_Nacimiento' id='txtFecha_Nacimiento' value="<?php  echo htmlentities($estudiante->Fecha_Nacimiento); ?>"  />
                    </div>
                </div>			
                    
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="cbx_Sexo">Sexo</label>
                    <div class="uk-form-controls">
                        <select class='uk-select'  name='cbx_Sexo' id='cbx_Sexo' style='visibility:visible; width:px;' >
                            <option style='visibility:hidden; height:1px;' value=''></option>
                            <option <?php if($estudiante->Sexo == 'Femenino') echo('selected=selected');?>   value='Femenino'>Femenino</option>
                            <option <?php if($estudiante->Sexo == 'Masculino') echo('selected=selected');?>   value='Masculino'>Masculino</option>
                        </select>
                    </div>
                </div>

                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtEmail">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='email' name='txtEmail' id='txtEmail' value="<?php  echo htmlentities($estudiante->Email); ?>"  />
                    </div>
                </div>		

                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtCelular">Celular</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='text' name='txtCelular' id='txtCelular' value="<?php  echo htmlentities($estudiante->Celular); ?>"  />
                    </div>
                </div>
                    
                <div class="uk-width-1-3@s">
                    <label class="uk-form-label" for="cbx_Estado">Estado</label>
                    <div class="uk-form-controls">
                        <select class='uk-select'  name='cbx_Estado' id='cbx_Estado' style='visibility:visible; width:px;' >
                            <option style='visibility:hidden; height:1px;' value=''></option>
                            <option <?php if($estudiante->Estado == 'Activo') echo('selected=selected');?>   value='Activo'>Activo</option>
                            <option <?php if($estudiante->Estado == 'Inactivo') echo('selected=selected');?>   value='Inactivo'>Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="uk-width-1-3@s">
                    <label  class="uk-form-label" for="txtDireccion">Direccion</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" placeholder="" type='text' name='txtDireccion' id='txtDireccion' value="<?php  echo htmlentities($estudiante->Direccion); ?>"  />
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
                $sql="select * from estudiante";
                $grid=new dataGrid(new dataTable($sql));
                $grid->noVisibles = array('Id', 'Clave');
                $grid->setRowAction('onclick','editar',array('Id'));
                $grid->display();
            ?>
        </div>
    </body>
</html>