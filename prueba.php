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
include('database.php');
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
					mysqli_close($conn);


 ?>