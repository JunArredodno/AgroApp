<?php
session_start();
require 'funciones.php';

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

    <title>Agroapp</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
  </head>

  <body>
    
    <!--Fixed navbar-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Tienda Agr@pp</a>
        </div>
     <!--                     Sistema de busqueda-->
      <form class="navbar-form navbar-left" method="POST" action="search.php" role="search">
        <div class="form-group">
          <input type="text" name="producto" class="form-control" placeholder="Buscar">
        </div>
        <button type="submit" class="btn btn-default">Enviar</button>
      </form>
      
      <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav pull-right">
          <li class="dropdown">
            <?php
              if(!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info'])){
            ?>
            <li>
            <a href="registrarse.php">Registrarse</a>
            <li>  
            <a href="inises.php">Iniciar Sesion <?php }else{ ?></a>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php print $_SESSION['usuario_info']['nombre_usuario']; }?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="panel/cerrar_session.php">Cerrar Sesion</a></li>
					</ul>
				  </li>
            <li>
			        <a href="compras/carrito.php" class="btn">CARRITO <span class="badge"><?php print cantidadproductos(); ?></span></a>
            </li> 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <?php
				require 'vendor/autoload.php';
				$producto = new Agroapp\Productos;
        //$agricultor= new Agroapp\Usuario;

       /*$surtidor=$agricultor->mostrarAgricultor();
       $cantidadAgri=count($surtidor);*/
        $info_productos = $producto->mostrar();
				$cantidad = count($info_productos);
				if($cantidad > 0){
					for($x =0; $x < $cantidad; $x++){
						$item = $info_productos[$x];
            ?>
              <div class="col-md-3">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <?php
                    switch($item['categoria_id']){
                      case 1:
                        print "frutas";
                        break;
                      case 2:
                        print "Verduras";
                        break;
                      case 3:
                        print "Hortalizas";
                        break;
                    }
                    ?>
                      <h1 class="text-center Productos-Disponibles"><?php print $item['NombrePro'] ?></h1>  
                    </div>
                    <div class="panel-body">
                      <?php
                          $foto = 'upload/'.$item['foto'];
                          if(file_exists($foto)){
                        ?>
                          <img src="<?php print $foto; ?>" class="img-responsive">
						  <p><?php print $item['descripcion']; ?></p>
              <!--<p>?php  surtidos($cantidadAgri, $surtidor);
              ?></p>-->
                      <?php }else{?>
                        <img src="assets/imagenes/not-found.jpg" class="img-responsive">
                      <?php }?>
                    </div>
                    <div class="panel-footer">
                        <a href="compras/carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
                          <span class="glyphicon glyphicon-shopping-cart"></span> Comprar
                        </a>
                    </div>
                  </div>
              
              
              </div>
          <?php
                }
            }else{?>
              <h4>Lo sentimos, actualmente no hay Stock</h4>
          <?php }?>
        </div>
      

    </div> <!-- Contactarnos -->

    <div id="contact" class="text-center">
  <div class="container">
    <div class="section-title text-center">
      <h2>Quejas, dudas, o reclamos:</h2>
      <hr>
      <p>Este es el servicio de quejas y reclamos; en caso de tener dudas con su pedido<br>
       inquietudes con respecto al uso de la pagina, o no haber recivido su pedido en <br>
       menos de 1 semana mandenos un mensaje.</p>
    </div>
    <div class="col-md-10 col-md-offset-1 contact-info">
      <div class="col-md-4">
        <h3>Dirección</h3>
        <hr>
        <div class="contact-item">
          <p>Villavicencio Meta,</p>
          <p>Vía a Puerto López, km. 2, margen izquierda</p>
        </div>
      </div>
      <div class="col-md-4">
        <h3>Horarios de atención</h3>
        <hr>
        <div class="contact-item">
          <p>Lunes-Sabado: 07:00 - 18:00</p>
          <p>Domingos: CERRADO</p>
        </div>
      </div>
      <div class="col-md-4">
        <h3>Info de contacto</h3>
        <hr>
        <div class="contact-item">
          <p>Núm: +57 321 306 6611</p>
          <p>Email: juan.arredondo@campusvirtual<br>.aunarvillavicencio.edu.co</p>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <h3>Dejanos tu mensaje aquí</h3>
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder="Nombre" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Mensaje" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-custom btn-lg">Enviar Mensaje</button>
      </form>
    </div>
  </div>
</div>

<!-- Footer Section 
<div id="footer">
  <div class="container text-center">
    <div class="col-md-8 col-md-offset-2">
      <div class="social">
        <ul>
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        </ul>
      </div>
      <p>&copy; 2023 Agr@pp. Diseñado por <a href="http://www.templatewire.com" rel="nofollow">Monalos Sender</a></p>
    </div>
  </div>
</div>-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
