<?php 
date_default_timezone_set("America/Mexico_City");
  try {
     $PDO = new PDO('mysql:host=localhost; dbname=treninterurbano','root','');
     } catch (PDOException $e) {
         echo "Error!!".$e->getMessage();
    }
    $conexion = new mysqli("localhost", "root", "", "treninterurbano");

//    if ($conexion) {
//     echo "La conexion fue exitosa a la base de datos";
//    }else{
//     echo "No se pudo conectar a la base de datos";
//    }

//    mysqli_close($conexion);

// try {
//     $PDO = new PDO('mysql:209.209.40.86; dbname=treninterurbano; port=19102','admin','Ad0Ox082');
//     } catch (PDOException $e) {
//         // echo "Error!!".$e->getMessage();
//    }
   
//    $conexion = new mysqli("mysql-81893-0.cloudclusters.net", "admin", "Ad0Ox082", "treninterurbano",19102);

    // if ($conexion) {
    //  echo "La conexion fue exitosa a la base de datos";
    // }else{
    // echo "No se pudo conectar a la base de datos";
    // }

