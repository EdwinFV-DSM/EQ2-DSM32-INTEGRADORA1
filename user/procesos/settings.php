<?php
session_start();
include_once '../../config/ConexionDB.php';

if ($_SESSION['idEscuela']) {
    $queryescuelas = 'SELECT nombre,img FROM escuelas WHERE idEscuela = ' . $_SESSION['idEscuela'];
    $escuelas = mysqli_query($conexion, $queryescuelas);
    $row_escuelas = mysqli_fetch_assoc($escuelas);

    $querycliente = 'SELECT * FROM cliente WHERE idEscuela = ' . $_SESSION['idEscuela'];
    $cliente = mysqli_query($conexion, $querycliente);
    $row_cliente = mysqli_fetch_assoc($cliente);
} else {
    $querycliente = 'SELECT * FROM cliente WHERE idCliente = ' . $_SESSION['idCliente'];
    $cliente = mysqli_query($conexion, $querycliente);
    $row_cliente = mysqli_fetch_assoc($cliente);
}




$queryTusuario = 'SELECT * FROM tipousuario WHERE idTUsuario = ' . $_SESSION['idTUsuario'];
$TUsuario = mysqli_query($conexion, $queryTusuario);
$row_TUsuario = mysqli_fetch_assoc($TUsuario);

if (isset($_POST)) {
    $imagen = $_FILES['imagen']['name'];
    $idCliente = $_SESSION['idCliente'];

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $numInt = $_POST['numInt'];
    $numExt = $_POST['numExt'];
    $municipio = $_POST['municipio'];
    $fechaNac = $_POST['fechaNac'];
    $codigoPostal = $_POST['cp'];

    if ($_POST['password'] == '' || $_POST['password'] == ' ') {
        $password = $row_cliente['password'];
    }else {
        $password = $_POST['password'];
    }

    $password_encriptada = password_hash($password,PASSWORD_DEFAULT);

    $idEscuela = $_SESSION['idEscuela'];
    $idTUsuario = $_SESSION['idTUsuario'];
    $status = $_SESSION['status'];
    $sexo = $_SESSION['sexo'];
    $dateCreacion = $_SESSION['dateCreacion'];

    $dateModificacion = date('Y-m-d H:i:s');

    $alert;
    if (isset($imagen) && $imagen != "") {
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

        if (!((strpos($tipo, 'gif') || strpos($tipo, 'jpeg') || strpos($tipo, 'webp') || strpos($tipo, 'jpg')))) {
            echo json_encode('error-extension');
            // header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/user/settings.php');
        } else {
            $query = "UPDATE `cliente` SET `nombre`='$nombre',`apellidos`='$apellidos',`fechaNac`='$fechaNac',`idTUsuario`='$idTUsuario',`email`='$email',`telefono`='$telefono',`calle`='$calle',
         `numExt`='$numExt',`numInt`='$numInt',`municipio`='$municipio',`codigoPostal`='$codigoPostal',`idServicio`=1,`idEscuela`='$idEscuela',`Status`='$status',`Sexo`='$sexo',
         `password`='$password_encriptada',`dateCreacion`='$dateCreacion',`dateModificacion`='$dateModificacion',`dateEliminacion`=NULL,`img`='$imagen' WHERE idCliente =" . $idCliente;
            $resultado_update_cliente = mysqli_query($conexion, $query);
            if ($resultado_update_cliente) {
                move_uploaded_file($temp, '../../uploads/' . $imagen);
                echo json_encode('success');
                // header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/user/settings.php');
            } else {
                echo json_encode('error-server');
            }
        }
    } else {
        $imagen = $row_cliente['img'];
        $query = "UPDATE `cliente` SET `nombre`='$nombre',`apellidos`='$apellidos',`fechaNac`='$fechaNac',`idTUsuario`='$idTUsuario',`email`='$email',`telefono`='$telefono',`calle`='$calle',
        `numExt`='$numExt',`numInt`='$numInt',`municipio`='$municipio',`codigoPostal`='$codigoPostal',`idServicio`=1,`idEscuela`='$idEscuela',`Status`='$status',`Sexo`='$sexo',
        `password`='$password',`dateCreacion`='$dateCreacion',`dateModificacion`='$dateModificacion',`dateEliminacion`=NULL,`img`='$imagen' WHERE idCliente =" . $idCliente;
        $resultado_update_cliente = mysqli_query($conexion, $query);
        // var_dump($resultado_update_cliente);
        if ($resultado_update_cliente) {
            echo json_encode('sucess');
        }
    }
}