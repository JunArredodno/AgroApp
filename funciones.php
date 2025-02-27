<?php


function agregarProducto($resultado, $id, $cantidad = 1){
    $_SESSION['carrito'][$id] = array(
        'id' => $resultado['id'],
        'NombrePro' => $resultado['NombrePro'],
        'foto' => $resultado['foto'],
        'precio' => $resultado['precio'],
		'id_surtidor'=>$resultado['id_surtidor'],
        'cantidad' => $cantidad
   );
}


function actualizarProducto($id,$cantidad = FALSE){

    if($cantidad){
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    }else{
		$_SESSION['carrito'][$id]['cantidad']+=1;
	}
}


function calcularTotal(){

    $total = 0;
    if(isset($_SESSION['carrito'])){
        foreach($_SESSION['carrito'] as $indice => $value){
            $total += $value['precio'] * $value['cantidad'];
        }
    }
    return $total;

}

function cantidadProductos(){
    $cantidad = 0;
    if(isset($_SESSION['carrito'])){
        foreach($_SESSION['carrito'] as $indice => $value){
           $cantidad++;
        }
    }

    return $cantidad;
}

function correos($naildo,$compra){
	if($naildo){/*
		$maxi=count($naildo);
		if($maxi<2){
			$sql="select `correo` from `usuarios` where `id`=:id";
			$_array = array(
				":id" => $naildo
			);
			$resultado = $this->cn->prepare($sql);

			if($resultado->execute()){
				$to=$resultado['correo'];
				$mensaje="El usuario ".$to." te a omprado: ".$compra;
				mail($to,"Te han comprado un producto",$mensaje);
			}
			
		}else{
			require 'src/Usuario.php';
			$surtidor= new Agroapp\Usuario;
			$correos=$surtidor->mostrarAgricultor($naildo);
			
			$maximo=count($correos);
			$destinatario="";
			for($x=0;$x<$maximo;$x++){
				$item=$correos[$x];
				$destinatario=$destinatario.$item['correo']." ";
			}
			$to=$correos;
		}*/
	}
}

function surtidos($cantidadAgri, $surtidor){
    $datos1="";$correo1="";$correoF="";
    $datos2="";$correo2="";
    $datos3="";$correo3="";
    for($x =0; $x < $cantidadAgri; $x++){
        $iterador=$surtidor[$x];
        $name=$iterador['nombre_usuario'];
        $celu=$iterador['celular'];
        switch ($x) {
          case 0:
            $datos1=$name."-".$celu;
            $correo1=$iterador['correo'];
            break;            
          case 1:
            $datos2=$name."-".$celu;
            $correo2=$iterador['correo'];
            break;
          case 2:
            $datos3=$name."-".$celu;
            $correo3=$iterador['correo'];
            break;
        }
      }?>
    <label for="names">Seleccione un surtidor</label>
    <input type="text" multiple name="surtidores" id="nombres" list="agricultores" required size="14" />
    <datalist id="agricultores">
      <option value="<?php print $datos1; ?>"><?php print $correo1; ?></option>
      <option value="<?php print $datos2; ?>"><?php print $correo2; ?></option>
      <option value="<?php print $datos3; ?>"><?php print $correo3; ?></option>
    </datalist>
<?php   

} 
?>