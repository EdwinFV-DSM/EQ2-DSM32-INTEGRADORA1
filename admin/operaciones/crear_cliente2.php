<?php

require '../../config/ConexionDB.php';


if ($_POST) {
    if ($_POST['nombre'] == '' || $_POST['nombre'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['apellidos'] == '' || $_POST['apellidos'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['fechaNac'] == '' || $_POST['fechaNac'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['TUsuario'] == '' || $_POST['TUsuario'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['email'] == '' || $_POST['email'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['phone'] == '' || $_POST['phone'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['direccion'] == '' || $_POST['direccion'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['cp'] == '' || $_POST['cp'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['municipio'] == '' || $_POST['municipio'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['password'] == '' || $_POST['password'] == ' ') {
        echo json_encode('error');
    } else {
        $nombre = $_POST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $fechaNac = $_POST['fechaNac'];
        $TUsuario = $_POST['TUsuario'];
        $email = $_POST['email'];
        $telefono = $_POST['phone'];
        $direccion = $_POST['direccion'];
        $cp = $_POST['cp'];
        $numExt = $_POST['numExt'];
        $numInt = $_POST['numInt'];
        $municipio = $_POST['municipio'];
        $password = $_POST['password'];
        $idServicio = 1;
        $status = 1;

        $fecha_hora_creacion = date('Y-m-d H:i:s');

        if ($_POST['sexo'] == 'F') {
            $sexoF = $_POST['sexo'];
            if ($_POST['escuela'] == 'NULL') {
                $crearCliente = "INSERT INTO `cliente` (`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES (NULL, '$nombre', '$apellidos', '$fechaNac', '$TUsuario', '$email', '$telefono', '$direccion', '$numExt', '$numInt', '$municipio', '$cp', '$idServicio', NULL, '$status', '$sexoF', '$password', '$fecha_hora_creacion', NULL, NULL, NULL);";
                $clienteCrear = mysqli_query($conexion, $crearCliente);
            } else {
                $idEscuela = $_POST['escuela'];
                $crearCliente = "INSERT INTO `cliente` (`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES (NULL, '$nombre', '$apellidos', '$fechaNac', '$TUsuario', '$email', '$telefono', '$direccion', '$numExt', '$numInt', '$municipio', '$cp', '$idServicio', '$idEscuela', '$status', '$sexoF', '$password', '$fecha_hora_creacion', NULL, NULL, NULL);";
                $clienteCrear = mysqli_query($conexion, $crearCliente);
            }


            if ($clienteCrear) {
                echo json_encode('success');
            } else {
                echo json_encode('error-insertar');
            }
        } elseif ($_POST['sexo'] == 'M') {
            $sexoM = $_POST['sexo'];
            if ($_POST['escuela'] == 'NULL') {
                $crearCliente = "INSERT INTO `cliente` (`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES (NULL, '$nombre', '$apellidos', '$fechaNac', '$TUsuario', '$email', '$telefono', '$direccion', '$numExt', '$numInt', '$municipio', '$cp', '$idServicio', NULL, '$status', '$sexoM', '$password', '$fecha_hora_creacion', NULL, NULL, NULL);";
                $clienteCrear = mysqli_query($conexion, $crearCliente);
            } else {
                $idEscuela = $_POST['escuela'];
                $crearCliente = "INSERT INTO `cliente` (`idCliente`, `nombre`, `apellidos`, `fechaNac`, `idTUsuario`, `email`, `telefono`, `calle`, `numExt`, `numInt`, `municipio`, `codigoPostal`, `idServicio`, `idEscuela`, `Status`, `Sexo`, `password`, `dateCreacion`, `dateModificacion`, `dateEliminacion`, `img`) VALUES (NULL, '$nombre', '$apellidos', '$fechaNac', '$TUsuario', '$email', '$telefono', '$direccion', '$numExt', '$numInt', '$municipio', '$cp', '$idServicio', '$idEscuela', '$status', '$sexoM', '$password', '$fecha_hora_creacion', NULL, NULL, NULL);";
                $clienteCrear = mysqli_query($conexion, $crearCliente);
            }

            if ($clienteCrear) {
                echo json_encode('success');
            } else {
                echo json_encode('error-insertar');
            }
        }
    }
}
