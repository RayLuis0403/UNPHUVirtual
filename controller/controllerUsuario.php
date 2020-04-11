<?php

    if($_POST && isset($_POST['functionname'])){
        

        include ('../metodos/engine.php');
        if($_POST['functionname'] == "saveUsuario")
        {
            $usuario=new asgClass("usuario");
            $usuario->Id = (isset($_POST['formData']['txtId']))?$_POST['formData']['txtId']:$usuario->Id;
            $usuario->Nombre = (isset($_POST['formData']['txtNombre']))?$_POST['formData']['txtNombre']:$usuario->Nombre;
            $usuario->Apellidos = (isset($_POST['formData']['txtApellidos']))?$_POST['formData']['txtApellidos']:$usuario->Apellidos;
            $usuario->Email = (isset($_POST['formData']['txtEmail']))?$_POST['formData']['txtEmail']:$usuario->Email;
            $usuario->Clave = (isset($_POST['formData']['txtClave']))?encrypt($_POST['formData']['txtClave']):$usuario->Clave;
            $usuario->Tipo = (isset($_POST['formData']['cbx_Tipo']))?$_POST['formData']['cbx_Tipo']:$usuario->Tipo;
            $usuario->Estado = (isset($_POST['formData']['cbx_Estado']))?$_POST['formData']['cbx_Estado']:$usuario->Estado;
            
            if($usuario->Id == "0" || $usuario->Id == "")
            {
                $usuario->Id = "0";
                $usuario->Fecha_Creacion = date("Y-m-d H:i:s");
            }
            else{
	            unset($usuario->campos[array_search('Fecha_Creacion', $usuario->campos)]);
            }

            echo json_encode($usuario->guardar());
            return;
        }
        else if( isset($_POST['functionname']) ) 
        {
            if($_POST['functionname'] == 'validateLogin'){

                $userEmail = (isset($_POST['txtUser']))?$_POST['txtUser']:"";
                $pwd = (isset($_POST['txtPassword']))?$_POST['txtPassword']:"";
                
                $validUser = false;
                $error = "";
                
                $response = usuario::login($userEmail, $pwd);
                 
                echo json_encode($response);
                
            }
            else if($_POST['functionname'] == 'getUser'){
                
	            include_once('../metodos/shortclass.php');
                $currentUser = obtenerUsuario();
                
                $isLogged = false;
                if($currentUser || $currentUser->Tipo){
                    $isLogged = true;
                }

                $response = array( 
                    "isLogged"=> $isLogged, 
                    "user"=> $currentUser); 
                
                echo json_encode($response);
            }
        }

    }

?>