<?php

include_once '../../config/ConexionDB.php';

if ($_POST) {
    $imagen = $_FILES['imagen']['name'];

    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($nombre == "" || $nombre == ' '){
        echo json_encode('error-nombre');
    }elseif($direccion == "" || $direccion == ' '){
        echo json_encode('error-direccion');
    }elseif($email == "" || $email == ' '){
        echo json_encode('error-email');
    }elseif($password == "" || $password == ' '){
        echo json_encode('error-password');
    }elseif (isset($imagen) && $imagen != "") {
        $tipo = $_FILES['imagen']['type'];
        $temp = $_FILES['imagen']['tmp_name'];
        if (!((strpos($tipo, 'gif') || strpos($tipo, 'jpeg') || strpos($tipo, 'webp') || strpos($tipo, 'jpg')))) {
            echo json_encode('error-type');
        } else {
            $crearEscuela ="INSERT INTO `escuelas`(`Nombre`, `Direccion`, `email`, `password`, `img`) VALUES ('$nombre','$direccion','$email','$password','$imagen')";
            $queryEscuela = mysqli_query($conexion, $crearEscuela);

            if ($queryEscuela) {
                move_uploaded_file($temp, '../../uploads/' . $imagen);
                echo json_encode('success');
            }else{
                echo json_encode('error-server');
            }
        }
    }else{
        echo json_encode('error-imagen');
    }
}
