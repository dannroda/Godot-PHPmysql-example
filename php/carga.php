<?php
    $db = new SQLite3('datos.db');
    $tblName = $_GET['tabla']; //Hay que ver de agarrar el nombre de la tabla desde godot
    $tblClave = $_GET['clave'];
    // $baseDatos = $_POST['data'];
    // $baseDatos = $_POST['data'];
    $baseDatos = file_get_contents('php://input');
    // $base = file_get_contents('php://input');
    echo json_encode($baseDatos);
    $j_obj = json_decode($baseDatos, true);
    echo $j_obj;
    $cq = "CREATE TABLE if not exists ". $tblName ." (
        id INT PRIMARY KEY,";
        foreach($j_obj as $j_arr_key => $value){
            $cq .= $j_arr_key . " VARCHAR(256),";
        }
        $cq = substr_replace($cq,"",-1);
        $cq .= ");";
        $result = $db->query($cq);


         $qi = "INSERT INTO $tblName (";

         reset($j_obj);
         $qi .= "";
         foreach($j_obj as $j_arr_key => $value){
             $qi .= $j_arr_key . ",";
         }

         $qi = substr_replace($qi,"",-1);
         $qi .= ") VALUES (";
         reset($j_obj);

         foreach($j_obj as $j_arr_key => $value){
             $qi .= "'" . $value . "',";

         }

         $qi = substr_replace($qi,"",-1);
          $qi .= ");";
 echo $cq;
 echo $qi;



?>