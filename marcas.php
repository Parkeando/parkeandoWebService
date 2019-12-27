<?php   
        include('database.php');
        $conn = mysqli_connect($hostname, $host_user, $host_password, $database);
        $return_arr = array();
        $fetch = mysqli_query($conn,"SELECT * FROM marcas");

        while ($row=mysqli_fetch_array($fetch,MYSQL_ASSOC)) {
            $row_array['ID_Marca'] = $row['ID_Marca'];
            $row_array['Nombre'] = $row['Nombre'];

            array_push($return_arr, $row_array);
            }
            echo json_encode($return_arr);

?>