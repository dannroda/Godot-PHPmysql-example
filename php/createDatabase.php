<?php
    include 'databaseConfig.php' ;
    $baseDatos = file_get_contents('php://input');
    $tblName = $_GET['tabla']; //Hay que ver de agarrar el nombre de la tabla desde godot
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);

    echo $baseDatos ;
  
    $j_obj = json_decode($baseDatos, true);
    //echo($j_obj);
    echo('
        ');    
    if(!mysqli_num_rows( mysqli_query($con,"SHOW TABLES LIKE '" . $tblName . "'"))){ 
        $cq = "CREATE TABLE ". $tblName ." (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        foreach($j_obj as $j_arr_key => $value){
            if (gettype($j_arr_key) == int){
                echo $j_arr_key . " Entra siendo: " . gettype($j_arr_key) . "\n";
                $strnorm = "Pregunta" . $j_arr_key;
                echo "Ahora el entero es: " . $strnorm . "\n";
            } 
            else {
                $strnorm = $j_arr_key;
                echo "Ahora el string es: " . $strnorm . "\n";
            }
            echo $strnorm . " Sale siendo: " . gettype($strnorm) . "\n";

            $cq .= $strnorm . " VARCHAR(256),";
        }

        $cq = substr_replace($cq,"",-1);
        $cq .= ")";
        mysqli_query($con,$cq) or die(mysqli_error($con));
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