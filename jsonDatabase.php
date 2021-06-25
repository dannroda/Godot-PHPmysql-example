<?php
    header('Content-Type: application/json');
    include 'databaseConfig.php' ;
    $tblName = $_GET['tabla'];
    //include 'DatabaseConfig.php' ;


    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);


    $Sql_Query = "SELECT* FROM $tblName";

    if(mysqli_query($con,$Sql_Query)){

    $result = mysqli_query($con,$Sql_Query);

    $json_array = array();

    while($row = mysqli_fetch_assoc($result))
    {
        $json_array[] = $row;
    }

    echo json_encode($json_array);

    }
    else{

    echo("Error description: Query not sent" );

    }
    mysqli_close($con);
?>