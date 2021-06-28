<?php
    header('Content-Type: application/json');
    include 'databaseConfig.php' ;
    $tblName = $_GET['tabla'];
    $tblClave = $_GET['clave'];
    //include 'DatabaseConfig.php' ;


    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);


    $Sql_Query = "SELECT* FROM $tblName";

    if(mysqli_query($con,$Sql_Query)){

    $result = mysqli_query($con,$Sql_Query);

    $json_clave_array = array();
    $json_clave_array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        if($tblClave == $row['codigo']){
            $json_clave_array[] = $row;
        }else {
            $json_array[] = $row;
        }
        
    }
    //print(json_encode($json_array[0]['codigo']));
    //echo json_encode($result);
    if($tblClave){
        echo json_encode($json_clave_array);
    }else{
        echo json_encode($json_array);
    }

    }
    else{

    echo("Error description: Query not sent" );

    }
    mysqli_close($con);
?>

