<?php
include_once '../../config/ConexionDB.php';

if ($_POST['nombre'] == '' || $_POST['nombre'] == ' ') {
    echo json_encode('error-nombre');
} elseif ($_POST['apellido'] == '' || $_POST['apellido'] == ' ') {
    echo json_encode('error-apellido');
} elseif ($_POST['fechaNa'] == '' || $_POST['fechaNa'] == ' ') {
    echo json_encode('error-fechaNa');
} elseif ($_POST['email'] == '' || $_POST['email'] == ' ') {
    echo json_encode('error-email');
} elseif ($_POST['password'] == '' || $_POST['password'] == ' ') {
    echo json_encode('error-password');
} elseif ($_POST['sexo'] == '' || $_POST['sexo'] == ' ') {
    echo json_encode('error-sexo');
} else {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNa = $_POST['fechaNa'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexo = $_POST['sexo'];
    $dateCreacion = date('Y-m-d H:i:s');

    /**
     * incriptacion de password
     */
    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

    $querycliente = "SELECT * FROM cliente";
    $cliente = mysqli_query($conexion, $querycliente);
    $row_cliente = mysqli_fetch_assoc($cliente);

    if ($email == $row_cliente['email']) {
        echo json_encode('error-cuenta');
    } else {

        if ($sexo == 'F') {
            $insertarcliene = "INSERT INTO `cliente`(`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES (NULL,'$nombre','$apellido','$fechaNa',3,'$email',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1,'$sexo','$password_encriptada','$dateCreacion',NULL,NULL,'user2.png')";
            $creacion = mysqli_query($conexion, $insertarcliene);
            if ($creacion) {
                echo json_encode('success');
            } else {
                echo json_encode('error-insertar');
            }
        } elseif ($sexo == 'M') {
            $insertarcliene = "INSERT INTO `cliente`(`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES (NULL,'$nombre','$apellido','$fechaNa',3,'$email',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1,'$sexo','$password_encriptada','$dateCreacion',NULL,NULL,'user.png')";
            $creacion = mysqli_query($conexion, $insertarcliene);
            if ($creacion) {
                echo json_encode('success');
            } else {
                echo json_encode('error-insertar');
            }
        }
    }
}
