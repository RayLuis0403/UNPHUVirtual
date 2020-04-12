<?php

    if($_POST && isset($_POST['functionname'])){

        include ('../metodos/engine.php');
        
        if($_POST['functionname'] == "saveEstudiante")
        {
            $estudiante=new asgClass("estudiante");
            $estudiante->Id = (isset($_POST['formData']['txtId']))?$_POST['formData']['txtId']:$estudiante->Id;
            $estudiante->Matricula = (isset($_POST['formData']['txtMatricula']))?$_POST['formData']['txtMatricula']:$estudiante->Matricula;
            $estudiante->Cedula = (isset($_POST['formData']['txtCedula']))?$_POST['formData']['txtCedula']:$estudiante->Cedula;
            $estudiante->Nombres = (isset($_POST['formData']['txtNombres']))?$_POST['formData']['txtNombres']:$estudiante->Nombres;
            $estudiante->Apellidos = (isset($_POST['formData']['txtApellidos']))?$_POST['formData']['txtApellidos']:$estudiante->Apellidos;
            $estudiante->Fecha_Nacimiento = (isset($_POST['formData']['txtFecha_Nacimiento']))?$_POST['formData']['txtFecha_Nacimiento']:$estudiante->Fecha_Nacimiento;
            $estudiante->Sexo = (isset($_POST['formData']['cbx_Sexo']))?$_POST['formData']['cbx_Sexo']:$estudiante->Sexo;
            $estudiante->Email = (isset($_POST['formData']['txtEmail']))?$_POST['formData']['txtEmail']:$estudiante->Email;
            $estudiante->Celular = (isset($_POST['formData']['txtCelular']))?$_POST['formData']['txtCelular']:$estudiante->Celular;
            $estudiante->Estado = (isset($_POST['formData']['cbx_Estado']))?$_POST['formData']['cbx_Estado']:$estudiante->Estado;
            $estudiante->Direccion = (isset($_POST['formData']['txtDireccion']))?$_POST['formData']['txtDireccion']:$estudiante->Direccion;
                    
            $estudiante->guardar();
                    
            if($estudiante->Id == "0" || $estudiante->Id == "")
            {
                $estudiante->Id = "0";
                $estudiante->Fecha_Ingreso = date("Y-m-d H:i:s");
            }
            else{
	            unset($estudiante->campos[array_search('Fecha_Ingreso', $estudiante->campos)]);
	            unset($estudiante->campos[array_search('Fecha_Ingreso', $estudiante->campos)]);
            }

            echo json_encode($estudiante->guardar());
            return;
        }

    }

?>