<?php
session_start();
require '../funciones.php';
$name=$_SESSION['usuario_info']['nombre_usuario'];
$cedula=$_SESSION['usuario_info']['cedula'];
$depar=$_SESSION['usuario_info']['departamento'];
$city=$_SESSION['usuario_info']['ciudad'];
$dirEntrega=$_SESSION['usuario_info']['dirEntrega'];
$correo=$_SESSION['usuario_info']['correo'];
$celuco=$_SESSION['usuario_info']['celular'];
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
                        <legend>Confirmar Datos</legend>
						
							<form method="POST" action="completar_pedido2.php">
								<div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" value="<?php print $name ?>" placeholder="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label>Cedula</label>
                                    <input type="number" class="form-control" name="cedula" value="<?php print $cedula ?>" placeholder="Cedula" required>
                                </div>
								<div class="form-group">
									<label>Correo</label>
									<input type="email" class="form-control" name="buyerEmail" value="<?php print $correo ?>" placeholder="Correo" required>
								</div>
								<input name="shippingCountry"    type="hidden"  value="CO"  >
								<div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text" class="form-control" name="departamento" value="<?php print $depar ?>" placeholder="Departamento" required>
                               
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" name="shippingCity" value="<?php print $city ?>" placeholder="Ciudad" required>
                                
                                    <label>Dirección de Envio</label>
                                    <input type="text" class="form-control" name="shippingAddress" value="<?php print $dirEntrega ?>" placeholder="Dirección de Envio" required>
                                </div>
								<div class="form-group">
                                    <label>Celular</label>
                                    <input type="number" class="form-control" name="celular" value="<?php print $celuco ?>" placeholder="Celular" required>
                                </div>
								<?php
									$precioF=0;
									$c=0;$cadenaConcatenada="";
									foreach($_SESSION['carrito'] as $indice => $value){
										$c++;
										$precio = ($value['precio'] * $value['cantidad']);
										$descripcion[$c]=($value['cantidad']." libra(s) de ".$value['NombrePro']." \n");
										
										$cadenaConcatenada = $cadenaConcatenada.$descripcion[$c];
										$precioF=$precioF+$precio;
									}
                
									?>
								<input name="description" type="hidden" value="<?php echo $cadenaConcatenada ?>">
								<input name="precio" type="hidden" value="<?php print $precioF ?>">
								<button type="submit" class="btn btn-primary btn-block">Confirmar</button>
							</form>
							<div class="row">
								<div class="pull-left">
									<a href="../index.php" class="btn btn-info">Seguir Comprando</a>
								</div>
							</div>
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

  </body>
</html>