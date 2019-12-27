<?php
//Recibir los datos
	if($_SERVER['REQUEST_METHOD']=='POST'){


$opcion = $_POST['opcion'];

			include('database.php');

			switch ($opcion) {
				case 'register':
					
		    $nombre = $_POST['nombre'];
		   $email = $_POST['email'];
			$password = $_POST['password'];
//Encriptar y hashear
			$passHash = password_hash($password, PASSWORD_BCRYPT);
$conn = mysqli_connect($hostname, $host_user, $host_password, $database);
			
			$res = mysqli_query($conn, "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre','$email','$passHash')");
			
			$obID =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, nombre, email, password FROM usuarios WHERE nombre = '$nombre'"));
			$id= (int) $obID['id_usuario'];

			$res = mysqli_query($conn, "INSERT INTO cuenta (saldo, tarjeta, usuario, id_usuario) VALUES (0,'A_UN_NO_HAY_METODO_DE_PAGO','$nombre', '$id')");

			if(mysqli_query($conn,$res)){
				$respuesta['mensaje'] = "Usuario Registrado.";
				$respuesta['error'] = false;
			}
			else{
				$respuesta['mensaje'] = "Error servidor.";
				$respuesta['error1'] = true;

				$respuesta['error'] = mysqli_error($conn);
		 
			}
			mysqli_close($conn);
			
					break;


					case 'actualizar':
						  $indexNombre = $_POST['indexNombre']; //viejo nombre
						  $nombre = $_POST['nombre']; //Nuevo nombre
		  				  $email = $_POST['correo'];
		  				  $viejaPassword = $_POST['viejaPassword'];
						  $password = $_POST['password'];



						   $conn = mysqli_connect($hostname, $host_user, $host_password, $database);
						$resUser =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, nombre, email, password FROM usuarios WHERE nombre = '$indexNombre'"));


						$id= (int) $resUser['id_usuario'];
						$oldPass = $resUser['password'];


						if(password_verify($viejaPassword, $oldPass)){

							$passHash2 = password_hash($password, PASSWORD_BCRYPT);

							$actualizacionCuenta = mysqli_query($conn, "UPDATE cuenta SET usuario='$nombre' WHERE id_usuario = '$id' ");

						 $res = mysqli_query($conn, "UPDATE usuarios SET nombre='$nombre', email='$email', password='$passHash2' WHERE id_usuario = '$id'");
						 if(isset($res)){
							$respuesta['mensaje'] = "Usuario Actualizado.";
							$respuesta['error'] = false;

						 }else{
						 	$respuesta['mensaje'] = "Error Server.";
							$respuesta['error'] = true;
						 }

						} else{
							$respuesta['mensaje'] = "Error: Datos incorrectos";
							$respuesta['error'] = true;
						}



						break;

					case 'completarPerfil':
						 $user = $_POST['user']; 
						 $conn = mysqli_connect($hostname, $host_user, $host_password, $database);

						 $perfil =mysqli_fetch_array (mysqli_query($conn, "SELECT nombre, email, password FROM usuarios WHERE nombre = '$user'"));
						 if (isset($perfil)) {
						 	$respuesta['mensaje']= "Consulta exitosa";
						 	$respuesta['nombre']= $perfil['nombre'];
						 	$respuesta['email'] = $perfil['email'];

						 	$respuesta['error'] = false;

						 }else{
						 	$respuesta['mensaje']= "Consulta NO exitosa";
						 	$respuesta['error'] = true;
						 }


							

						break;

						case 'eliminarPerfil':
							$user = $_POST['user']; 
							$conn = mysqli_connect($hostname, $host_user, $host_password, $database);
							$del = mysqli_query($conn, "DELETE FROM usuarios WHERE nombre = '$user'");
							 if (isset($del)) {
						 	$respuesta['mensaje']= "Cuenta eliminada";
						 	$respuesta['error'] = false;

						 }else{
						 	$respuesta['mensaje']= "Error: Cuenta no eliminada";
						 	$respuesta['error'] = true;
						 }

							break;

					case 'login':
						$usuario2 = $_POST['nombre'];
						$password2 = $_POST['password'];


			$conn = mysqli_connect($hostname, $host_user, $host_password, $database);

			$resP =mysqli_fetch_array (mysqli_query($conn, "SELECT nombre, email, password FROM usuarios WHERE nombre = '$usuario2'"));

		
						
			if(isset($resP)){
					if (password_verify($password2, $resP['password'] )) {
						$respuesta['mensaje'] = "Bienvenido Usuario";
							$respuesta['nombre'] = $resP['nombre'];
							$respuesta['correo'] = $resP['email'];
							$respuesta['error'] = false;
					}else{
						$respuesta['mensaje'] = "password incorrectos.";
				$respuesta['error'] = true;
					}
			
			}
			else{
				$respuesta['mensaje'] = "password incorrectos.";
				$respuesta['error'] = true;
			}
			mysqli_close($conn);
			


			
			
			break;
						break;
				
				default:
					# code...
					break;
			}
					echo json_encode($respuesta);

}

?>
