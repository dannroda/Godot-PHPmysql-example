<?php
    include 'databaseConfig.php' ;
    $baseDatos = file_get_contents('php://input');
    $tblName = $_GET['tabla']; //Hay que ver de agarrar el nombre de la tabla desde godot
    $tblClave = $_GET['clave'];
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

    $j_obj = json_decode($baseDatos, true);
    if(!mysqli_num_rows( mysqli_query($con,"SHOW TABLES LIKE '" . $tblName . "'"))){ 
        $cq = "CREATE TABLE ". $tblName ." (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        foreach($j_obj as $j_arr_key => $value){
            $cq .= $j_arr_key . " VARCHAR(256),";
        }
        $cq = substr_replace($cq,"",-1);
        $cq .= ")";
        mysqli_query($con,$cq) or die(mysqli_error());
    }


    $qi = "INSERT INTO $tblName (";
    reset($j_obj);

    foreach($j_obj as $j_arr_key => $value){
        $qi .= $j_arr_key . ",";
    }  

    $qi = substr_replace($qi,"",-1);
    $qi .= ") VALUES (";
    reset($j_obj);

    foreach($j_obj as $j_arr_key => $value){
        $qi .= "'" . mysqli_real_escape_string($con,$value) . "',";
    }

    $qi = substr_replace($qi,"",-1);
    $qi .= ")";
    $result = mysqli_query($con,$qi) or die(mysqli_error());
    mysqli_close($con);

?>