<?php
    //Registrarse
    if($_SERVER['REQUEST_METHOD'] ==='POST'){
        require 'funciones.php';
        require 'vendor/autoload.php';

        $registrar = new Agroapp\Usuario;

        $_params = array(
            'nombre' => $_POST['nombre'],
            'contra'=>$_POST['contra'],
			'cedula'=>$_POST['cedula'],
			'departamento'=>$_POST['departamento'],
			'ciudad'=>$_POST['ciudad'],
			'direccion'=>$_POST['onedirection'],
			'correo'=>$_POST['email'],
            'celular' => $_POST['celular']
        );
    
        $nuevaousuario = $registrar->regis($_params);
    }
    //Inicio de sesion
    if($_SERVER['REQUEST_METHOD'] ==='GET'){
        $nombre_usuario=$_GET['nombre_usuario'];
        $clave=$_GET['clave'];

        require 'vendor/autoload.php';
        $usuario = new Agroapp\Usuario;
        $resultado = $usuario->login($nombre_usuario,$clave);

        if($resultado){
            session_start();
            $_SESSION['usuario_info']= array(
                'nombre_usuario'=>$resultado['nombre_usuario'],
                'estado'=>$resultado['estado']
            );
            header("Location:index.php");
        }else{
            print 'Digite bien su usuario, o contraseña';
        }

    }
?>