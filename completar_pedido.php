<?php

session_start();

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    require 'funciones.php';
    require 'vendor/autoload.php';

    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        $cliente = new Agroapp\Cliente;
    
        $_params = array(
            'nombre' => $_POST['nombre'],
			'cedula'=>$_POST['cedula'],
			'correo'=>$_POST['correo'],
            'celular' => $_POST['celular'],
            'comentario' => $_POST['comentario']
        );
    
        $cliente_id = $cliente->registrar($_params);
    
        $pedido = new Agroapp\Pedido;
    
        $_params = array(
            'usuario_id'=>$cliente_id,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d')
        );
        
        $pedido_id =  $pedido->registrar($_params);

        foreach($_SESSION['carrito'] as $indice => $value){
            $_params = array(
                "pedido_id" => $pedido_id,
                "producto_id" => $value['id'],
                "precio" => $value['precio'],
                "cantidad" => $value['cantidad'],
            );

            $pedido->registrarDetalle($_params);
        }

        $_SESSION['carrito'] = array();

        header('Location: gracias.php');

    }

    

     




}