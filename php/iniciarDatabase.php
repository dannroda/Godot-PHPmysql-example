<?php
    include 'databaseConfig.php' ;
    $baseDatos = file_get_contents('php://input');
    $tblName = $_GET['tabla']; //Hay que ver de agarrar el nombre de la tabla desde godot
    $tblClave = $_GET['clave'];
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    //$tblName = "Tierra"; // es la tabla a usar
$j_obj = [
    'user' => $tblClave,
    'p0' => null,
    'p1' => null,
    'p2' => null,
    'p3' => null,
    'p4' => null,
    'p5' => null,
    'p6' => null,
    'p7' => null,
    'p8' => null,
    'p9' => null,
    'p10' => null,
    'p11' => null,
    'p12' => null,
    'p13' => null,
    'p14' => null,
    'p15' => null,
    'p16' => null,
    'p17' => null,
    'p18' => null
];
    

    //$j_obj = json_decode($baseDatos, true);
    print_r($j_obj);
    print_r(array_values($j_obj));
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
    $result = mysqli_query($con,$qi) or die(mysqli_error($con));
    mysqli_close($con);

?>