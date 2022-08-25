<?php
    include 'databaseConfig.php' ;
    header('Content-Type: application/json');
    $baseDatos = file_get_contents('php://input');
    print_r(' [PHP: RECIBIDO] ');
     $tblName = $_GET['tabla']; //Hay que ver de agarrar el nombre de la tabla desde godot
    $tblClave = $_GET['clave'];
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    echo (mysqli_query($con, "SHOW COLUMNS FROM'" . $tblName . "' like '" . 'p0' . "'"));
     $j_obj = json_decode($baseDatos, true);
    $existe_tabla = false;
    if(!mysqli_num_rows( mysqli_query($con,"SHOW TABLES LIKE '" . $tblName . "'"))){ 
        $cq = "CREATE TABLE ". $tblName ." (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
        foreach($j_obj as $j_arr_key => $value){
            $cq .= $j_arr_key . " VARCHAR(256),";
        }
        $cq = substr_replace($cq,"",-1);
        $cq .= ")";
        print_r('
        [CREANDO TABLA]: ' . $cq);
        mysqli_query($con,$cq) or die(mysqli_error($con));
        $existe_tabla = true;
        reset($j_obj);
    }
    foreach($j_obj as $j_arr_key => $value){
    $result = mysqli_num_rows(mysqli_query($con,"SELECT NULL FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE table_name = '" . $tblName . "'
    AND table_schema = 'saberes'
    AND column_name = '" . $j_arr_key . "'")); 
    print_r('
    [VERIFICANDO EXISTENCIA]: ' . $result);
    if($result == 0){
        print_r('
        LA COSA FUNCIONA: ' . $j_arr_key);  
        $cq = "ALTER TABLE " . $tblName . " ADD " . $j_arr_key . " VARCHAR(256) NOT NULL default '0'";
                mysqli_query($con,$cq) or die(mysqli_error($con));
                print_r('
                [ACTUALIZANDO TABLA]: ' . $cq);
                //$cq .= ";";
            }
        }
        reset($j_obj);
    
    $qi = "INSERT INTO $tblName (";
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
    print_r('
    [CARGANDO DATOS]: ' . $qi);  
    $result = mysqli_query($con,$qi) or die(mysqli_error($con));
    print_r('
    [RESULTADO DB]: ' . $result);
    mysqli_close($con);

?>