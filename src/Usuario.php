<?php

namespace Agroapp;

class Usuario{
    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;
		$this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }
    public function regis($_params){
		$sql = "INSERT INTO `usuarios`(`nombre_usuario`, `clave`, `cedula`,  `departamento`, `ciudad`, `dirEntrega`, `correo`,`celular`) 
        VALUES (:nombre,:clave,:cedula,:departamento,:ciudad,:dirEntrega,:correo,:celular)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":clave" => $_params['contra'],
			":cedula"=>$_params['cedula'],
			":departamento"=>$_params['departamento'],
			":ciudad"=>$_params['ciudad'],
			":dirEntrega"=>$_params['direccion'],
			":correo"=>$_params['correo'],
            ":celular" => $_params['celular']
        );

        if($resultado->execute($_array)){
            return $this->cn->lastInsertId();
		}
        return false;
    }

    public function login($nombre, $clave){
        
        $sql = "SELECT nombre_usuario FROM `usuarios` WHERE `nombre_usuario`= :nombre AND `clave`= :clave ";
        
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":nombre" => $nombre,
            ":clave" => $clave
        );

        if($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
}