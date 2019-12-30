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

					
					//$res = mysqli_query($conn, "UPDATE cuenta SET saldo='$updateSaldo' WHERE usuario = '$usuario' ");

					if (isset($insercionHistorial)) {
						$respuesta['mensaje']= "Ingreso exitoso";

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
							$horaSalida = $_POST['horaSalida']; //LA HORA EN LA QUE SALDRAS REALMENTE :)
							$conn = mysqli_connect($hostname, $host_user, $host_password, $database);
							$obID =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario FROM usuarios WHERE  nombre = '$usuario'"));
							$id= (int) $obID['id_usuario'];

							$obTiempo= mysqli_fetch_array (mysqli_query($conn, "SELECT horaEntrada, horaSalida FROM usuarioEstacionamiento WHERE  id_usuario = '$id'"));
							$tiempoEntradaBD = $obTiempo['horaEntrada']; // LA HORA DE ENTRADA ESTIMADA EN LA BD 
							$tiempoSalidaBD = $obTiempo['horaSalida']; //LA HORA DE SALIDA ESTIMADA EN LA BD

							
							//convertir que esta en cadena a horas para poder ser comparadas o restadas 

							
										$horaDelaBD = date_create($tiempoEntradaBD);
										$horaSalidaReal  = date_create($horaSalida);


							// si la hora que realmente salio el carro es menor que la horaEntrada insertada en la base de datos toma en cuenta 10 min gratis por lo que solo retorna un mensaje de salida
							if ($horaSalidaReal < $horaDelaBD) {
									$respuesta['mensaje']= "Saliste vuelva pronto tu hora de salida fue".$horaSalida. "No hay cargos a tu saldo. ";
									$deleteMonitoreo = mysqli_query($conn, "DELETE FROM usuarioEstacionamiento WHERE id_usuario= '$id'");

								$respuesta['error']= false;
								//$deleteMonitoreo = mysqli_query($conn, "DELETE FROM usuarioEstacionamiento WHERE id_usuario= '$id'");
								
							}else{

								// Si no es asi procederas a cobrar la respectiva hora conveniente y despues abrir


								// calcular la diferencia de hora 

									$horaDelaBD = date_create($tiempoEntradaBD);
										$horaSalidaReal  = date_create($horaSalida);
								

							$cuota= mysqli_fetch_array (mysqli_query($conn, "SELECT cuota FROM estacionamiento WHERE  qrSalida = '$estacionamiento'"));

							$interval = date_diff($horaDelaBD, $horaSalidaReal);
							$totalDeHoras  =  $interval->format('%H');
						//	
							//Consultar saldo
						$saldo= mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE  id_usuario = '$id'"));

							if ($totalDeHoras == 0) {
								$pago = $cuota['cuota'] * 1;
								$pagofloat = floatval($pago);
								$saldoViejo = floatval($saldo['saldo']);
								$nuevoSaldo = $saldoViejo - $pagofloat;


								if ($nuevoSaldo < 0 ) {
									$respuesta['mensaje']= "Saldo insuficiente" ;
												$respuesta['error']= true;

								}else{

									$actSaldo = mysqli_query($conn, "UPDATE cuenta SET saldo='$nuevoSaldo' WHERE id_usuario = '$id' ");
										$deleteMonitoreo = mysqli_query($conn, "DELETE FROM usuarioEstacionamiento WHERE id_usuario= '$id'");
											$respuesta['status'] = "Tu nuevo Saldo es de: ". $nuevoSaldo;
										$respuesta['tiempo'] = "Tu tiempo de demora fue de: ". 1;
									$respuesta['mensaje']= "Saldo actualizado" ;
												$respuesta['error']=  true;


								}
					
								
							}else{
								// ya cuando cumple mas o igual a 1 hrs
								$pago = $cuota['cuota'] * $totalDeHoras;
								$pagofloat = floatval($pago);
								$saldoViejo = floatval($saldo['saldo']);
								$nuevoSaldo = $saldoViejo - $pagofloat;


								$actSaldo = mysqli_query($conn, "UPDATE cuenta SET saldo='$nuevoSaldo' WHERE id_usuario = '$id' ");
										$deleteMonitoreo = mysqli_query($conn, "DELETE FROM usuarioEstacionamiento WHERE id_usuario= '$id'");
										$respuesta['status'] = "Tu nuevo Saldo es de: ". $nuevoSaldo;
										$respuesta['tiempo'] = "Tu tiempo de demora fue de: ". $totalDeHoras;
											

								$respuesta['mensaje']= "Saldo actualizado";
												$respuesta['error']= true;



							}

								

								/*	if (isset($saldo)) {

										
										$respuesta['mensaje']= "Saldo insuficiente";
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