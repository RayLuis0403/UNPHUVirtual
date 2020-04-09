<?php

    if($_POST){
        

        if(isset($_POST['txtId']))
        {
            include ('../metodos/engine.php');
            $usuario=new asgClass("usuario");
            $usuario->Id = (isset($_POST['txtId']))?$_POST['txtId']:$usuario->Id;
            $usuario->Nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$usuario->Nombre;
            $usuario->Apellidos = (isset($_POST['txtApellidos']))?$_POST['txtApellidos']:$usuario->Apellidos;
            $usuario->Email = (isset($_POST['txtEmail']))?$_POST['txtEmail']:$usuario->Email;
            $usuario->Clave = (isset($_POST['txtClave']))?encrypt($_POST['txtClave']):$usuario->Clave;
            $usuario->Tipo = (isset($_POST['cbx_Tipo']))?$_POST['cbx_Tipo']:$usuario->Tipo;
            $usuario->Estado = (isset($_POST['cbx_Estado']))?$_POST['cbx_Estado']:$usuario->Estado;
            
            if($usuario->Id == "0" || $usuario->Id == "")
            {
                $usuario->Id = "0";
                $usuario->Fecha_Creacion = date("Y-m-d H:i:s");
            }
            else{
	            unset($usuario->campos[array_search('Fecha_Creacion', $usuario->campos)]);
            }

            if($usuario->guardar()){
                $script= "<script type='text/javascript'>alert('Usuario Guardado correctamente.')</script>";
                echo $script;
                
                $script= "<script type='text/javascript'>window.location = '../views/usuario.php';</script>";
                echo $script;
            }
            else {
                $script= "<script type='text/javascript'>alert('Usuario no se guardo.')</script>";
                echo $script;
            }
                
        }
        else if( isset($_POST['functionname']) ) 
        {
            if($_POST['functionname'] == 'validateLogin'){

                include ('../metodos/shortclass.php');
                //$usuario=new usuario();

                $user = (isset($_POST['txtUser']))?$_POST['txtUser']:"";
                $pwd = (isset($_POST['txtPassword']))?$_POST['txtPassword']:"";
                
                $validUser = false;
                $error = "";
                
                if(usuario::login($user, $pwd)){
                    $validUser = true;
                } else
                {
                    $error = "Usuario o contraseña invalido.";
                }

                $response = array( 
                    "validUser"=> $validUser, 
                    "error"=> $error); 
                    
                echo json_encode($response);
                
            }
        }

    }

?>