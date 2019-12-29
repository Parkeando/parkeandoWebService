<?php 


	if($_SERVER['REQUEST_METHOD']=='POST'){



		$usuario = $_POST['usuario'];

		include('database.php');
        $conn = mysqli_connect($hostname, $host_user, $host_password, $database);


		$obID =mysqli_fetch_array (mysqli_query($conn, "SELECT id_usuario, nombre, email, password FROM usuarios WHERE nombre = '$usuario'"));
		$id=  $obID['id_usuario'];
 		
      
        $fetch = mysqli_query($conn,"SELECT lugar, fecha FROM historial where id_usuario = '$id'");

       while ($datos = mysqli_fetch_array($fetch)) {


       		$respuesta[]= $datos;
       	
       		

       	
       }

   //   $datos = mysqli_fetch_array($fetch);

      // $respuesta['lugar']=  $datos;
	//mysqli_close($conn); 

       echo json_encode($respuesta);





}




 ?>