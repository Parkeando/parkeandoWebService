<?php 
        include('database.php');
        $nombre = $_GET['nombre'];
        $conn = mysqli_connect($hostname, $host_user, $host_password, $database);
        $res =  mysqli_fetch_array(mysqli_query($conn,"SELECT ID_Marca FROM marcas WHERE Nombre= '$nombre'"));
        $ID_Marca = $res[0];
        if (isset($res)) {
            $respuesta['ID_Marca'] = $ID_Marca;
        }else{
            $respuesta['Error'];
        }

$conn = mysqli_connect($hostname, $host_user, $host_password, $database);
        $return_arr = array();
        $fetch = mysqli_query($conn,"SELECT * FROM modelos WHERE ID_Marca='$ID_Marca'");
        while ($row=mysqli_fetch_array($fetch,MYSQL_ASSOC)) {
            $row_array['Nombre'] = $row['Nombre'];
            array_push($return_arr, $row_array);
            }
            echo json_encode($return_arr);
?>