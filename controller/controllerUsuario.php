<?php

    if($_POST){
        
        include ('../metodos/engine.php');
        $usuario=new asgClass("usuario");

        if(isset($_POST['txtId']))
        {
            $usuario->Id = (isset($_POST['txtId']))?$_POST['txtId']:$usuario->Id;
            $usuario->Nombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:$usuario->Nombre;
            $usuario->Apellidos = (isset($_POST['txtApellidos']))?$_POST['txtApellidos']:$usuario->Apellidos;
            $usuario->Email = (isset($_POST['txtEmail']))?$_POST['txtEmail']:$usuario->Email;
            $usuario->Clave = (isset($_POST['txtClave']))?md5($_POST['txtClave']):$usuario->Clave;
            $usuario->Tipo = (isset($_POST['cbx_Tipo']))?$_POST['cbx_Tipo']:$usuario->Tipo;
            $usuario->Estado = (isset($_POST['cbx_Estado']))?$_POST['cbx_Estado']:$usuario->Estado;
            
            if($_POST['txtId'] == "0" || $_POST['txtId'] == "")
            {   
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
    }
    else {
        
    }

?>