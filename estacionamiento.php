<?php 


//Recibir los datos
	if($_SERVER['REQUEST_METHOD']=='POST'){





			$opcion = $_POST['opcion'];

			include('database.php');

			switch ($opcion) {
				case 'consultarEstacionamiento':
					
					$estacionamiento = $_POST['estacionamiento'];

					$conn = mysqli_connect($hostname, $host_user, $host_password, $database);

						 $entrada =mysqli_fetch_array (mysqli_query($conn, "SELECT nombre FROM estacionamiento WHERE qrEntrada= '$estacionamiento'"));

						 $salida =mysqli_fetch_array (mysqli_query($conn, "SELECT nombre FROM estacionamiento WHERE qrSalida = '$estacionamiento'"));


						 if (isset($entrada)) {
						 	$respuesta['mensaje']= "Usted esta Entrando";
						 	$respuesta['lugar'] =  $entrada['nombre'];
						 	$respuesta['error'] = false;

						 } elseif (isset($salida)) {
						 	$respuesta['mensaje']= "Usted esta Saliendo";
						 		$respuesta['lugar'] =  $entrada['nombre'];
						 	$respuesta['error'] = false;
						 }
						 else{
						 	$respuesta['mensaje']= "QR incorrecto";
						 	$respuesta['error'] = true;
						 }

						mysqli_close($conn);
					break;

					case 'descontarSaldo':
					$usuario = $_POST['usuario'];
					$estacionamiento = $_POST['estacionamiento'];
					$horaEntrada = $_POST['horaEntrada'];
					$horaSalida = $_POST['horaSalida'];

					$conn = mysqli_connect($hostname, $host_user, $host_password, $database);

					$obSaldo =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, saldo FROM cuenta WHERE usuario= '$usuario'"));

					$id = (int) $obSaldo['id_usuario'];
					$saldo = floatval($obSaldo['saldo']);

					$obCuota =mysqli_fetch_array (mysqli_query($conn, "SELECT id_estacionamiento, nombre, cuota FROM estacionamiento WHERE qrEntrada= '$estacionamiento'"));

					$idEsta = $obCuota['id_estacionamiento'];

					$cuota = floatval($obCuota['cuota']);

					$nombreEstaci = $obCuota['nombre'];


					if ($saldo <= 0 || $saldo < $cuota ) {
						$respuesta['mensaje'] = "Saldo Insuficiente";
						$respuesta['error'] = true;
					}else{
						$updateSaldo = $saldo - $cuota;

					$insercion = mysqli_query($conn, "INSERT INTO usuarioEstacionamiento (id_usuario, horaEntrada, horaSalida, id_estacionamiento ) VALUES ('$id', '$horaEntrada', '$horaSalida', '$idEsta' ) ");	

					$insercionHistorial = mysqli_query($conn, "INSERT INTO historial (lugar, id_usuario, id_estacionamiento) VALUES ('$nombreEstaci', '$id', '$idEsta') ");

					
					$res = mysqli_query($conn, "UPDATE cuenta SET saldo='$updateSaldo' WHERE usuario = '$usuario' ");

					if (isset($res)) {
						$respuesta['mensaje']= "Se cobra la 1era hora";

						$obHoras =mysqli_fetch_array (mysqli_query($conn, "SELECT horaEntrada, horaSalida FROM usuarioEstacionamiento  WHERE id_usuario= '$id'"));



						$respuesta['horaEntrada'] = $obHoras['horaEntrada'];
						$respuesta['horaSalida'] = $obHoras['horaSalida'];
						$respuesta['error'] = false;
					}else{
						$respuesta['mensaje']= "Cobro no iniciado ";
						$respuesta['error'] = true;
					} 

					}

						break;

					case 'consultarTiempo':
							$usuario = $_POST['usuario'];
							$conn = mysqli_connect($hostname, $host_user, $host_password, $database);
							
							$obID =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario FROM usuarios WHERE  nombre = '$usuario'"));


							$id= (int) $obID['id_usuario'];

							$obHora = mysqli_fetch_array (mysqli_query($conn, "SELECT horaEntrada, horaSalida FROM usuarioEstacionamiento WHERE  id_usuario = '$id'"));

							if (isset($obID)) {
									$respuesta['mensaje'] = "La hora es: ";
								$respuesta['horaEntrada'] = $obHora['horaEntrada'];
								$respuesta['horaSalida'] = $obHora['horaSalida'];
								$respuesta['error'] = false;
							}else{
								$respuesta['mensaje'] = "No se puede obtener hora";
								$respuesta['error'] = true;
							}

							break;
							case 'descontarSaldoSalida':
							$usuario = $_POST['usuario'];

							$estacionamiento = $_POST['estacionamiento'];
							$horaSalida = $_POST['horaSalida'];
							$conn = mysqli_connect($hostname, $host_user, $host_password, $database);
							$obID =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario FROM usuarios WHERE  nombre = '$usuario'"));
							$id= (int) $obID['id_usuario'];

							$obTiempo= mysqli_fetch_array (mysqli_query($conn, "SELECT horaEntrada, horaSalida FROM usuarioEstacionamiento WHERE  id_usuario = '$id'"));
							$tiempoEntradaBD = $obTiempo['horaEntrada'];
							$tiempoSalidaBD = $obTiempo['horaSalida'];

						

							//Separo el string
							$array = explode(":", $tiempoSalidaBD); //tiempo de salida estimado en al bd
							$arraySystem = explode(":", $horaSalida); //hora de salida del carro final 
							//Obtengo la hora del string

							//Si la hora que salio el carro es menor o igual a la hora

							if ($arraySystem <= $array) {
								
								$respuesta['mensaje']= "Saliste vuelta pronto";
								$respuesta['error']= false;
							}else{
								

									$arrayTiempoEntradaBD = explode(":", $tiempoEntradaBD);

									$horaEntradaFinal = $arrayTiempoEntradaBD['0'].$arrayTiempoEntradaBD['1'];

									$horaSalidaFinal = $arraySystem['0'].$arraySystem['1'];

									//Calculo la cantidad de horas extras
									$resta = $horaSalidaFinal - $horaEntradaFinal;

									$arrayResta =  str_split($resta);
									//En resultado ya definitivamente almaceno el la cantidfad  de horas que se tardo el usuario
									$resultado = $arrayResta['0'];

									$cuota= mysqli_fetch_array (mysqli_query($conn, "SELECT cuota FROM estacionamiento WHERE  qrSalida = '$estacionamiento'"));

									$pago = $cuota['cuota'] * $resultado;
//////////////////////

									$saldo= mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE  id_usuario = '$id'"));
								//operacion donde lo que tiene que pagar se le descontara a su saldo.

									$nuevoSaldo = $saldo['saldo'] - $pago;


									
									//Si no hay saldo retornar el siguiente mensaje :(
									if ($nuevoSaldo <= 0) {
												$respuesta['mensaje']= "Saldo insuficiente";
												$respuesta['error']= true;
									}else{


									$respuesta['mensaje']= "Saldo actualizado";
										$actSaldo = mysqli_query($conn, "UPDATE cuenta SET saldo='$nuevoSaldo' WHERE id_usuario = '$id' ");
										$deleteMonitoreo = mysqli_query($conn, "DELETE FROM usuarioEstacionamiento WHERE id_usuario= '$id'");
										$respuesta['status'] = "Tu nuevo Saldo es de: ". $nuevoSaldo;
										$respuesta['tiempo'] = "Tu tiempo de demora fue de: ". $resultado;
												$respuesta['error']= true;
									}

/*
										if (isset($actSaldo)) {
											 	$respuesta['mensaje']= $nuevoSaldo;
												$respuesta['error']= true;
										}*/
										

								




							}




								break;


				default:
					# code...
					break;
			}

		echo json_encode($respuesta);




}








 ?>