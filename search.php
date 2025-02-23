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
<?php
    $produc=$_POST['producto'];
    require 'vendor/autoload.php';

    $productos= new Agroapp\Productos;
    $buscarPorduc=$productos->mostrar();
    $cantidad=count($buscarPorduc);
    ?>
    <div class="col-md-3">
      <div class="panel panel-default">
      <?php
      for($x=0;$x<$cantidad;$x++){
        $item=$buscarPorduc[$x];
        if($item['NombrePro']==$produc){
          ?><h1 class="text-center Productos-Disponibles"><?php print $item['NombrePro'] ?></h1>  
          </div>
          <div class="panel-body">
            <?php
              $foto = 'upload/'.$item['foto'];
              if(file_exists($foto)){
            ?>  <img src="<?php print $foto; ?>" class="img-responsive">
                <p><?php print $item['descripcion']; ?></p>
          </div><?php
              }else{
               ?><img src="assets/imagenes/not-found.jpg" class="img-responsive"><?php
              }?>
              <div class="panel-footer">
              <a href="compras/carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success btn-block">
                <span class="glyphicon glyphicon-shopping-cart"></span> Comprar
              </a>
          </div><?php
        }else{
          print("Por favor escriba la primera letra del producto en Mayuscula");
          die();
        }
      }?>
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
