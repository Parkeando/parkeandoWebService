<?php 


if($_SERVER['REQUEST_METHOD']=='POST'){
$opcion = $_POST['opcion'];

			include('database.php');

			switch ($opcion) {
				case 'registrarCuenta':
					 $saldo =  $_POST['saldo'];
					 $usuario = $_POST['usuario'];
					 $tarjeta = $_POST['tarjeta'];
					 $conn = mysqli_connect($hostname, $host_user, $host_password, $database);


				$resP =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, nombre, email, password FROM usuarios WHERE nombre = '$usuario'"));

				$id= (int) $resP['id_usuario'];

		   		$consultarCuenta = mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE usuario = '$usuario'"));

		   		$saldoViejo = floatval ($consultarCuenta['saldo']);
		   		$saldoNuevo = floatval($saldo);
		   		$abono = $saldoViejo + $saldoNuevo;
				$res = mysqli_query($conn, "UPDATE cuenta SET saldo='$abono', tarjeta='$tarjeta', usuario='$usuario' WHERE usuario = '$usuario' ");
					 if(isset($res)){
				$respuesta['mensaje'] = "Saldo abonado";
				$respuesta['error'] = false;
				}else{

					$respuesta['mensaje'] = "Error saldo no abonado";
					$respuesta['error'] = true;
				}		
					mysqli_close($conn);
					break;
				case 'consultarSaldo':
					 $usuario = $_POST['usuario'];
					 $conn = mysqli_connect($hostname, $host_user, $host_password, $database);
					 $resP =mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE usuario = '$usuario'"));

					 if(isset($resP)){
						$respuesta['mensaje'] = $resP['saldo'];
						$respuesta['error'] = false;
				}else{

					$respuesta['mensaje'] = "Error saldo no abonado";
					$respuesta['error'] = true;
				}		
					break;
//Registra saldo con paypal ;)
				case 'registrarCuentaPaypal':
					 $saldo =  $_POST['saldo'];
					 $usuario = $_POST['usuario'];
					 $tarjeta = $_POST['tarjeta'];
					 $conn = mysqli_connect($hostname, $host_user, $host_password, $database);


				$resP =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, nombre, email, password FROM usuarios WHERE nombre = '$usuario'"));

				$id= (int) $resP['id_usuario'];

		   		$consultarCuenta = mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE usuario = '$usuario'"));

		   		$saldoViejo = floatval ($consultarCuenta['saldo']);
		   		$saldoNuevo = floatval($saldo);
		   		$abono = $saldoViejo + $saldoNuevo;
				$res = mysqli_query($conn, "UPDATE cuenta SET saldo='$abono', tarjeta='PAGO_CON_PAYPAL', usuario='$usuario' WHERE usuario = '$usuario' ");
					 if(isset($res)){
				$respuesta['mensaje'] = "Saldo abonado";
				$respuesta['error'] = false;
				}else{

					$respuesta['mensaje'] = "Error saldo no abonado";
					$respuesta['error'] = true;
				}		
					mysqli_close($conn);
					break;
				case 'consultarSaldo':
					 $usuario = $_POST['usuario'];
					 $conn = mysqli_connect($hostname, $host_user, $host_password, $database);
					 $resP =mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE usuario = '$usuario'"));

					 if(isset($resP)){
						$respuesta['mensaje'] = $resP['saldo'];
						$respuesta['error'] = false;
				}else{

					$respuesta['mensaje'] = "Error saldo no abonado";
					$respuesta['error'] = true;
				}		
					break;	
				
				default:
					# code...
					break;
			}

			echo json_encode($respuesta);



}



 ?>