<?php

include_once '../../config/ConexionDB.php';

if ($_POST) {
    $imagen = $_FILES['imagen']['name'];

    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

    $dateCreacion = date('Y-m-d H:i:s');

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
            $crearEscuela ="INSERT INTO `escuelas`(`Nombre`, `Direccion`, `idTUsuario`, `email`, `password`, `img`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `status`) VALUES ('$nombre','$direccion',5,'$email','$password_encriptada','$imagen','$dateCreacion',NULL,NULL,0)";
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
