<?php 
/*
$password=123;
include('database.php');

			$conn = mysqli_connect($hostname, $host_user, $host_password, $database);

			$resP =mysqli_fetch_array (mysqli_query($conn, "SELECT password FROM usuarios WHERE nombre = 'Alfonso'"));
			echo $resP['password'];


$hash = '$2y$10$.JLmeMjzmBurIsB.dOKdL..CZQKhbiuGw9e5wfBsYuJy6GZFzt70C';

if (password_verify($password, $hash)) {

	echo "Seguro";
}
else{
	echo "nell";
}
*/
/*

					  $saldo = (int) "123";
					 $usuario = "David";
					 $tarjeta = "1234566778";
					 $conn = mysqli_connect($hostname, $host_user, $host_password, $database);


					$resP =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, nombre, email, password FROM usuarios WHERE nombre = 'David'"));

					$id= (int) $resP['id_usuario'];
					 $res = mysqli_query($conn, "INSERT INTO cuenta (saldo, tarjeta, usuario, id_usuario) VALUES ('$saldo','$tarjeta','$usuario', '$id')");
					 if(isset($res)){
				echo "bien";
				}else{
					echo "mal";
					
				}		
					mysqli_close($conn);*/


						//$estacionamiento = $_POST['estacionamiento'];
include('database.php');
					$conn = mysqli_connect($hostname, $host_user, $host_password, $database);

					$obTiempo= mysqli_fetch_array (mysqli_query($conn, "SELECT horaEntrada, horaSalida FROM usuarioEstacionamiento WHERE  id_usuario = 42"));

				$horaEntrada =	$obTiempo['horaEntrada'] ;
				$horaSalida =	$obTiempo['horaSalida'];
$cuota= mysqli_fetch_array (mysqli_query($conn, "SELECT cuota FROM estacionamiento WHERE  qrSalida = 'plazaComercial@parkeandoSalida'"));


					$hora = "00:22:34";
					$hora2 = "23:22:34";	

$datetime1 = date_create($horaEntrada);
$datetime2 = date_create($horaSalida);
$interval = date_diff($datetime1, $datetime2);
$resultado =  $interval->format('%H'); //total de horas
$pago = $cuota['cuota'] * $resultado;


$pagofloat = floatval($pago);

$saldo= mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE  id_usuario = 42"));
			$saldoViejo = floatval($saldo['saldo']);

			$nuevoSaldo = $saldoViejo - $pagofloat;


//echo $resultado. "<br>";


if ($resultado == 0) {
	$pago = $cuota['cuota'] * 1;


$pagofloat = floatval($pago);

$saldo= mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE  id_usuario = 42"));
			$saldoViejo = floatval($saldo['saldo']);

			$nuevoSaldo = $saldoViejo - $pagofloat;


echo "el if ".$nuevoSaldo. "<br>";


if($nuevoSaldo <= 0){
	echo "Saldo insufiencte";
}else{
	echo "saldo suficiente";
}

}else{
	$pago = $cuota['cuota'] * $resultado;


$pagofloat = floatval($pago);

$saldo= mysqli_fetch_array (mysqli_query($conn, "SELECT saldo FROM cuenta WHERE  id_usuario = 42"));
			$saldoViejo = floatval($saldo['saldo']);

			$nuevoSaldo = $saldoViejo - $pagofloat;


echo "Segunda condicion". $pago. "<br>";
}

/*
if ($datetime1 < $datetime2){

echo "cool";
}else{
	echo "mal";
}*/
			//	echo $horaEntadaFinal;






 ?>