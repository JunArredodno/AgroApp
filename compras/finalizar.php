<?php
session_start();
require '../funciones.php';

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
                        <legend>Completar Datos</legend>
                        <?php 
                        if(!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info'])){
                        ?>
							<form method="POST" action="completar_pedido.php">
								<div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label>Cedula</label>
                                    <input type="number" class="form-control" name="cedula" required>
                                </div>
								<div class="form-group">
									<label>Correo</label>
									<input type="email" class="form-control" name="buyerEmail" required>
								</div>
								<input name="shippingCountry"    type="hidden"  value="CO"  >
								<div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text" class="form-control" name="departamento" required>
                               
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" name="shippingCity" required>
                                
                                    <label>Dirección de Envio</label>
                                    <input type="text" class="form-control" name="shippingAddress" required>
                                </div>
								<div class="form-group">
                                    <label>Celular</label>
                                    <input type="number" class="form-control" name="celular" required>
                                </div>
								<?php
                }else{ print "hello my baby, hello my honey"; }
									$c=0;$cadenaConcatenada="";
									foreach($_SESSION['carrito'] as $indice => $value){
										$c++;
										$descripcion[$c]=($value['cantidad']." libra(s) de ".$value['NombrePro']." \n");
										$cadenaConcatenada = $cadenaConcatenada.$descripcion[$c];
									}
                
									?>
								<input name="description" type="hidden" value="<?php print $cadenaConcatenada ?>">
								<button type="submit" class="btn btn-primary btn-block">Enviar</button>
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

  </body>
</html>
