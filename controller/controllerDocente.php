<?php

    if($_POST && isset($_POST['functionname'])){
        

        include ('../metodos/engine.php');
        
        if($_POST['functionname'] == "saveDocente")
        {
            $docente=new asgClass("docente");
            $docente->Id = (isset($_POST['formData']['txtId']))?$_POST['formData']['txtId']:$docente->Id;
            $docente->Cedula = (isset($_POST['formData']['txtCedula']))?$_POST['formData']['txtCedula']:$docente->Cedula;
            $docente->Nombres = (isset($_POST['formData']['txtNombres']))?$_POST['formData']['txtNombres']:$docente->Nombres;
            $docente->Apellidos = (isset($_POST['formData']['txtApellidos']))?$_POST['formData']['txtApellidos']:$docente->Apellidos;
            $docente->Fecha_Nacimiento = (isset($_POST['formData']['txtFecha_Nacimiento']))?$_POST['formData']['txtFecha_Nacimiento']:$docente->Fecha_Nacimiento;
            $docente->Sexo = (isset($_POST['formData']['cbx_Sexo']))?$_POST['formData']['cbx_Sexo']:$docente->Sexo;
            $docente->Email = (isset($_POST['formData']['txtEmail']))?$_POST['formData']['txtEmail']:$docente->Email;
            $docente->Estado = (isset($_POST['formData']['cbx_Estado']))?$_POST['formData']['cbx_Estado']:$docente->Estado;
            $docente->Cargo = (isset($_POST['formData']['txtCargo']))?$_POST['formData']['txtCargo']:$docente->Cargo;
            $docente->Titulo = (isset($_POST['formData']['txtTitulo']))?$_POST['formData']['txtTitulo']:$docente->Titulo;
            $docente->Especialidad = (isset($_POST['formData']['txtEspecialidad']))?$_POST['formData']['txtEspecialidad']:$docente->Especialidad;
            $docente->Celular = (isset($_POST['formData']['txtCelular']))?$_POST['formData']['txtCelular']:$docente->Celular;
                    
            if($docente->Id == "0" || $docente->Id == "")
            {
                $docente->Id = "0";
                $docente->Fecha_Ingreso = date("Y-m-d H:i:s");
                
                $sql="SELECT COUNT(*) Total_Quarter FROM docente";
                $dt= new dataTable($sql);
                $numRows = 0;
                if($dt->getNumRows() > 0)
                {
                    $row = $dt->getRow(0);
                    $numRows = $row["Total_Quarter"];
                }
                $numRows = $numRows + 1;
                
                $codDocente = fn_lpad($numRows, 4, "0");

                $docente->Codigo = $codDocente;

            }
            else{
	            unset($docente->campos[array_search('Fecha_Ingreso', $docente->campos)]);
	            unset($docente->campos[array_search('Codigo', $docente->campos)]);
            }

            echo json_encode($docente->guardar());
            return;
        }

    }

?>