<!DOCTYPE html>
<html lang="en">
<head>
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
          <a class="navbar-brand" href="index.php">Tienda Agr@pp</a>
        </div>
        
      </div>
    </nav>
<!--Formulario-->
    <div class="container" id="main">
        <div class="main-login">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center">Registrarse</h3>
                </div>
                <form action="sesion.php" method="POST">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <input type="text" class="form-control" name="nombre" placeholder="Nombre de usuario" >
                            <input type="password" class="form-control" name="contra" placeholder="Contraseña" >
                            <input type="text" class="form-control" name="cedula" placeholder="Cedula" >
                            <!--
                            Contraseña segura:
                            input type="password" name="clave" placeholder="contra" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos 1 número, 8 o mas caracteres, una letra mayuscula y minuscula" required
                            -->
                            <input type="text" class="form-control" name="departamento" placeholder="Departamento" >
                            <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" >
                            <input type="text" class="form-control" name="onedirection" placeholder="Direccion" >
                            <input type="email" class="form-control" name="email" placeholder="Correo" >
                            <input type="text" class="form-control" name="celular" placeholder="Número telefonico" >
                            <input type="submit" class="btn btn-block" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>