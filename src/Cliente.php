<?php

namespace Agroapp;

class Cliente{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }

    public function registrar($_params){
		$sql = "INSERT INTO `clientes`(`nombre`, `cedula`,  `departamento`, `ciudad`, `dirEntrega`, `correo`,`celular`, `comentario`) 
        VALUES (:nombre,:cedula,:departamento,:ciudad,:dirEntrega,:correo,:celular,:comentario)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
			":cedula"=>$_params['cedula'],
			":departamento"=>$_params['departamento'],
			":ciudad"=>$_params['ciudad'],
			":dirEntrega"=>$_params['dirEntrega'],
			":correo"=>$_params['correo'],
            ":celular" => $_params['celular'],
            ":comentario" => $_params['comentario']
        );

        if($resultado->execute($_array)){
            return $this->cn->lastInsertId();
		}
        return false;
    }


}