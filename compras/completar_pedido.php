<?php

session_start();

if($_SERVER['REQUEST_METHOD'] ==='POST'){

    require '../funciones.php';
    require '../vendor/autoload.php';
	
	$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
	$merchant_id = "508029";
	$account_id="512321";
	$referenceCode = "".time();
	$TX_VALUE = calcularTotal();
	$New_value = number_format($TX_VALUE, 2, '.', '');
	$currency = "COP";
	$firmacreada = md5("$ApiKey~$merchant_id~$referenceCode~$New_value~$currency");

    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
		
		//-------------------------------
        $cliente = new Agroapp\Cliente;
    
        $_params = array(
            'nombre' => $_POST['nombre'],
			'cedula'=>$_POST['cedula'],
			'departamento'=>$_POST['departamento'],
			'ciudad'=>$_POST['shippingCity'],
			'dirEntrega'=>$_POST['shippingAddress'],
			'correo'=>$_POST['buyerEmail'],
            'celular' => $_POST['celular'],
			'comentario'=>$_POST['description']
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

        /*header('Location: gracias.php');*/
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Finalizar pedido</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.php">Tienda Agr@pp</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
            <li>
              <a href="carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadProductos(); ?></span></a>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
        <div class="main-form">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend>¿Está seguro de que estos son sus datos?</legend>
							<form method="POST" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
								<input name="merchantId"      type="hidden"  value="<?php print $merchant_id ?>"   >
								<input name="accountId"       type="hidden"  value="<?php print $account_id ?>" >
								<input name="referenceCode"   type="hidden"  value="<?php print $referenceCode ?>" >
								<input name="amount"          type="hidden"  value="<?php print $New_value;?>"   >
								<input name="tax"             type="hidden"  value="0"  >
								<input name="taxReturnBase"   type="hidden"  value="0" >
								<input name="currency"        type="hidden"  value="<?php print $currency ?>" >
								<input name="signature"       type="hidden"  value="<?php print $firmacreada ?>"  >
								<input name="test"            type="hidden"  value="1" >
								<div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" placeholder="<?php print $_POST['nombre'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Cedula</label>
                                    <input type="number" class="form-control" name="cedula" placeholder="<?php print $_POST['cedula'] ?>">
                                </div>
								<div class="form-group">
									<label>Correo</label>
									<input type="email" class="form-control" name="buyerEmail" placeholder="<?php print $_POST['buyerEmail'] ?>" >
								</div>
								<input name="shippingCountry"    type="hidden"  value="CO"  >
								<div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text" class="form-control" name="departamento" placeholder="<?php print $_POST['departamento'] ?>" >
                               
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" name="shippingCity" placeholder="<?php print $_POST['shippingCity'] ?>" >
                                
                                    <label>Dirección de Envio</label>
                                    <input type="text" class="form-control" name="shippingAddress" placeholder="<?php print $_POST['shippingAddress'] ?>" >
                                </div>
								<div class="form-group">
                                    <label>Celular</label>
                                    <input type="number" class="form-control" name="celular" placeholder="<?php print $_POST['celular'] ?>" >
                                </div>
								<div class="form-group">
                                    <label>Descripcion</label>
									<input type="text" class="form-control" name="comentario" placeholder="<?php print $_POST['description'] ?>" readonly>	
								</div>
								
								<input name="description" type="hidden" value="<?php print $_POST['description'] ?>">
								
								<input name="responseUrl" type="hidden"  value="http://localhost/proyecto/agroapp/compras/gracias.php" >
								<input name="confirmationUrl" type="hidden"  value="http://localhost/proyecto/agroapp/src/Pago.php" >
								
								<button type="submit" class="btn btn-primary">Sí, estoy seguro</button>
								<!--input name="Submit" type="submit" value="Enviar"-->
							</form>
                    </fieldset>
                </div>
            </div>
        </div>
        
      

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
<?php $_SESSION['carrito'] = array(); ?>
  </body>
</html>