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

    <title>Tienda Agr@pp</title>

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
        
      </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="jumbotron">
			<?php

			$transactionState = $_REQUEST['transactionState'];		
			$processingDate=$_REQUEST['processingDate'];
			$buyerEmail=$_REQUEST['buyerEmail'];
			$transactionId = $_REQUEST['transactionId'];
			
			$ApiKey="4Vj8eK4rloUd272L48hsrarnUA";
			$merchant_id = $_REQUEST['merchantId'];
			$referenceCode = $_REQUEST['referenceCode'];
			$TX_VALUE = $_REQUEST['TX_VALUE'];
			$currency = $_REQUEST['currency'];
			$New_value = number_format($TX_VALUE, 1, '.', '');
			$firmacreada = md5("$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState");
			$firma = $_REQUEST['signature'];
			$reference_pol = $_REQUEST['reference_pol'];
			$cus = $_REQUEST['cus'];
			$extra1 = $_REQUEST['description'];
			$pseBank = $_REQUEST['pseBank'];
			$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
	
	
			if ($_REQUEST['transactionState'] == 4 ) {
				$estadoTx = "Transacción aprobada";
			}

			else if ($_REQUEST['transactionState'] == 6 ) {
				$estadoTx = "Transacción rechazada";
			}

			else if ($_REQUEST['transactionState'] == 104 ) {
				$estadoTx = "Error";
			}

			else if ($_REQUEST['transactionState'] == 7 ) {
				$estadoTx = "Pago pendiente";
			}

			else {
				$estadoTx=$_REQUEST['mensaje'];
			}


			if (strtoupper($firma) == strtoupper($firmacreada)) {
	
?>
	<p>Gracias por su compra</p>
	<h2>Resumen de la transacción</h2>
	<table>
	<tr>
	<td>Estado de la transacción</td>
	<td><?php echo $estadoTx; ?></td>
	</tr>
	<tr>
	<tr>
	<td>ID de la transacción</td>
	<td><?php echo $transactionId; ?></td>
	</tr>
	<tr>
	<td>Referencia de venta</td>
	<td><?php echo $reference_pol; ?></td>
	</tr>
	<tr>
	<td>Referencia de la transacción</td>
	<td><?php echo $referenceCode; ?></td>
	</tr>
	<tr>
	
	<?php
	if($pseBank != null) {
	?>
		<tr>
		<td>cus </td>
		<td><?php echo $cus; ?> </td>
		</tr>
		<tr>
		<td>Banco </td>
		<td><?php echo $pseBank; ?> </td>
		</tr>
	<?php
	}
	?>
	<tr>
	<td>Valor total</td>
	<td>$<?php echo number_format($TX_VALUE); ?></td>
	</tr>
	<tr>
	<td>Moneda</td>
	<td><?php echo $currency; ?></td>
	</tr>
	<tr>
	<td>Descripción</td>
	<td><?php echo ($extra1); ?></td>
	</tr>
	<tr>
	<td>Entidad:</td>
	<td><?php echo ($lapPaymentMethod); ?></td>
	</tr>
	</table>
	<p>
        <a href="../index.php">Regresar</a>
	</p>
<?php
}
else
{
?>
	<h1>Error validando la firma digital.</h1>
<?php
}
?>
  
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
