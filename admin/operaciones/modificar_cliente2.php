<?php

require '../../config/ConexionDB.php';

/**Consulta para poder traer la fecha de creacion */

$query_date = "SELECT * FROM cliente";
$date = mysqli_query($conexion, $query_date);
$resultado_date = mysqli_fetch_assoc($date);


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
    } elseif ($_POST['numExt'] == '' || $_POST['numExt'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['numInt'] == '' || $_POST['numInt'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['municipio'] == '' || $_POST['municipio'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['escuela'] == '' || $_POST['escuela'] == ' ') {
        echo json_encode('error');
    } elseif ($_POST['password'] == '' || $_POST['password'] == ' ') {
        echo json_encode('error');
    } else {

        $nombre = $_POST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $fechaNac = $_POST['fechaNac'];
        $TUsuario = $_POST['TUsuario'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $direccion = $_POST['direccion'];
        $cp = $_POST['cp'];
        $numExt = $_POST['numExt'];
        $numInt = $_POST['numInt'];
        $municipio = $_POST['municipio'];
        $escuela = $_POST['escuela'];
        $password = $_POST['password'];
        $idServicio = 1;

        $idCliente = $_REQUEST['operacion'];

        $creacion_cliente = $resultado_date['dateCreacion'];

        $fecha_hora_modificacion = date('Y-m-d H:i:s');

        if ($_POST['sexo'] == 'F') {
           $sexoF = $_POST['sexoF'];
           $actualizarCliente = "UPDATE `cliente` SET `img`=NULL,`nombre`='$nombre',`apellidos`='$apellidos',`fechaNac`='$fechaNac',`idTUsuario`='$TUsuario',`email`='$email',`telefono`='$phone',
           `calle`='$direccion',`numExt`='$numExt',`numInt`='$numInt',`municipio`='$municipio',`codigoPostal`='$cp',`idServicio`='$idServicio',`idEscuela`='$escuela',`Status`= NULL,
           `Sexo`='$sexoF',`password`='$password',`dateCreacion`='$creacion_cliente',`dateModificacion`='$fecha_hora_modificacion',`dateEliminacion`=NULL WHERE idCliente = " . $idCliente;
           $Actulizacion = mysqli_query($conexion, $actualizarCliente);

           if ($Actulizacion) {
               echo json_encode('success');
           } else {
               echo json_encode('error-insertar');
           }

        }elseif ($_POST['sexo'] == 'M') {
            $sexoM = $_POST['sexoM'];
            $actualizarCliente = "UPDATE `cliente` SET `img`=NULL,`nombre`='$nombre',`apellidos`='$apellidos',`fechaNac`='$fechaNac',`idTUsuario`='$TUsuario',`email`='$email',`telefono`='$phone',
           `calle`='$direccion',`numExt`='$numExt',`numInt`='$numInt',`municipio`='$municipio',`codigoPostal`='$cp',`idServicio`='$idServicio',`idEscuela`='$escuela',`Status`= NULL,
           `Sexo`='$sexoM',`password`='$password',`dateCreacion`='$creacion_cliente',`dateModificacion`='$fecha_hora_modificacion',`dateEliminacion`=NULL WHERE idCliente = " . $idCliente;
           $Actulizacion = mysqli_query($conexion, $actualizarCliente);

           if ($Actulizacion) {
               echo json_encode('success');
           } else {
               echo json_encode('error-insertar');
           }
        }
    }
}
