<?php

require "../vendor/autoload.php";

$producto = NEW Agroapp\Productos;
			//Registrar
if($_SERVER['REQUEST_METHOD']==='POST'){
	if($_POST['accion']==='Registrar'){
		
		if(empty($_POST['nombre']))
			exit("Complete el nombre");
		
		if(empty($_POST['categoria_id']))
			exit("Escoja una categoria");
		
		if(!is_numeric($_POST['categoria_id']))
			exit("Digite bien el categoria");
		
		if(empty($_POST['precio']))
			exit("Falta el precio");
		
		if(!is_numeric($_POST['precio']))
			exit("Digite bien el precio");
		
		$_params=array(
			'NombrePro'=>$_POST['nombre'],
			'descripcion'=>$_POST['descripcion'],
			'foto'=>subirFoto(),
			'precio'=>$_POST['precio'],
			'categoria_id'=>$_POST['categoria_id'],
			'fecha'=>date('y-m-d')
		);
		$rpt= $producto->registrar($_params);
		
		if($rpt){
			header('Location: productos/index.php');
		}else{
			print('Error al registrar el producto');
		}
	}		//Actualizar
	if($_POST['accion']==='Actualizar'){
		
		if(empty($_POST['nombre']))
			exit("Complete el nombre");
		
		if(empty($_POST['categoria_id']))
			exit("Escoja una categoria");
		
		if(!is_numeric($_POST['categoria_id']))
			exit("Digite bien el categoria");
		
		if(empty($_POST['precio']))
			exit("Falta el precio");
		
		if(!is_numeric($_POST['precio']))
			exit("Digite bien el precio");
		
		$_params=array(
			'NombrePro'=>$_POST['nombre'],
			'descripcion'=>$_POST['descripcion'],
			'precio'=>$_POST['precio'],
			'categoria_id'=>$_POST['categoria_id'],
			'fecha'=>date('y-m-d'),
			'id'=>$_POST['id']
		);
		
		if(!empty($_POST['foto_temp'])){
			$_params['foto']=$_POST['foto_temp'];
		}
		
		if(!empty($_FILES['foto_temp'])){
			$_params['foto']=$subirFoto();
		}
		
		$rpt= $producto->actualizar($_params);
		
		if($rpt){
			header('Location: productos/index.php');
		}else{
			print('Error al Actualizar el producto');
		}
	}
}
	//Eliminar
if($_SERVER['REQUEST_METHOD']==='GET'){
	$id=$_GET['id'];
	
	$rpt= $producto->eliminar($id);
		
	if($rpt){
		header('Location: productos/index.php');
	}else{
		print('Error al eliminar el producto');
	}
}
function subirFoto(){
	$carpeta =__DIR__.'/../upload/';
	
	$archivo = $carpeta.$_FILES['foto']['name'];
	
	move_uploaded_file($_FILES['foto']['tmp_name'],$archivo);

    return $_FILES['foto']['name'];
}

?>