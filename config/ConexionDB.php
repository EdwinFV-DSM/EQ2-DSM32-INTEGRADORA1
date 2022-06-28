<?php 
 try {
    $PDO = new PDO('mysql:host=localhost; dbname=treninterurbano','root','');
    } catch (PDOException $e) {
        echo "Error!!".$e->getMessage();
   }
   
   $conexion = new mysqli("localhost", "root", "", "treninterurbano");

   if ($conexion) {
    echo "La conexion fue exitosa a la base de datos";
   }else{
    echo "No se pudo conectar a la base de datos";
   }

   mysqli_close($conexion);