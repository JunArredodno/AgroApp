<?Php
	$key="";
	$salt="";
	$mode="test";
	$success_url="https://localhost/proyecto/agroapp/gracias.php";
	$fail_url="https://localhost/proyecto/agroapp/fallo.php";
	$cancelled_url="https://localhost/proyecto/agroapp/eliminar_carrito.php";
	
	if($mode=='live'){
		$action='https://secure.payu.in/_payment';
	}else{
		$action='https://test.payu.in/_payment';
		$key="4Vj8eK4rloUd272L48hsrarnUA";
	}
	
?>