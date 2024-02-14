<?php
  session_start();
  if(!isset($_SESSION['usuario_info']) OR empty($_SESSION['usuario_info'])){
    header("location: ../index.php");
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

    <title>Agroapp</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
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
          <a class="navbar-brand" href="../dashboard.php">Tienda Agr@pp</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav pull-right">
				<li>
					<a href="../pedidos/index.php" class="btn">Pedidos</a>
				</li>
				<li class="active">
					<a href="index.php" class="btn">Productos</a>	
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Cerrar Sesion</a></li>
					</ul>
				</li>
			</ul>
		</div>
      </div>
    </nav>
	
    <div class="container" id="main">
        <div class="row">
			<div class="col-md-12">
				<div class="pull-right">
					<a href="form_registrar.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<fieldset>
					<legend>Listado de Productos</legend>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Nombre</th>
								<th>Categoria</th>
								<th>Precio</th>
								<th class="text-center">Foto</th>
							</tr>
						</thead>
						<tbody>
						<?php
							require('../../vendor/autoload.php');
							$producto=new Agroapp\Productos;
							
							$info_producto= $producto->mostrar();
							$cantidad=count($info_producto);
							
							if($cantidad>0){
								$c=0;
								for($x=0;$x<$cantidad;$x++){
									$c++;
									$item=$info_producto[$x];
						?>
							<tr>
								<td><?php print $c ?></td>
								<td><?php print $item['NombrePro'] ?></td>
								<td><?php print $item['Nombre'] ?></td>
								<td><?php print $item['precio'] ?></td>
								<td class="text-center">
									<?php 
										$foto='../../upload/'.$item['foto'];
										if(file_exists($foto)){
									?>
									<img src="<?php print $foto; ?>" width="50%">
										<?php }else{ ?>
											Error 404
										<?php } ?>
								</td>
								<td class="text-center">
									<a href="../acciones.php?id=<?php print $item['id']?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
									<a href="form_actualizar.php?id=<?php print $item['id']?>" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Actualizar</a>
								</td>
							</tr>
							<?php
								}
								}else{
							?>
							<tr>
								<td colspan="6">No hay registros</td>
							</tr>
								<?php } ?>
						</tbody>
					</table>
				</fieldset>
			</div>
		</div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

  </body>
</html>