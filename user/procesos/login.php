<?php
include_once '../../config/ConexionDB.php';

session_start();
if (isset($_REQUEST['email'])) {
    if (isset($_REQUEST['password'])) {
        $email = $_REQUEST['email'];
        $pass = $_REQUEST['password'];
        $query0 = "SELECT * FROM cliente WHERE email = '$email'";
        $result0 = mysqli_query($conexion, $query0);
        $conteo0 = $result0->num_rows;

        if ($conteo0) {
            $querycliente = "SELECT * FROM cliente WHERE email= '$email'";
            $cliente = mysqli_query($conexion, $querycliente);
            $row = mysqli_fetch_assoc($cliente);
            if (password_verify($pass, $row['password'])) {
                echo json_encode('success');
                $querycliente = "SELECT * FROM cliente WHERE email='$email'";
                $cliente = mysqli_query($conexion, $querycliente);
                $row = mysqli_fetch_assoc($cliente);
                $_SESSION['login'] = 1;
                $_SESSION['idCliente'] = $row['idCliente'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellidos'] = $row['apellidos'];
                $_SESSION['img'] = $row['img'];
                $_SESSION['idTUsuario'] = $row['idTUsuario'];
                $_SESSION['idEscuela'] = $row['idEscuela'];
                $_SESSION['status'] = $row['Status'];
                $_SESSION['sexo'] = $row['Sexo'];
                $_SESSION['dateCreacion'] = $row['dateCreacion'];
            }else if($pass == $row['password']){
                echo json_encode('success');
                $querycliente = "SELECT * FROM cliente WHERE email='$email'";
                $cliente = mysqli_query($conexion, $querycliente);
                $row = mysqli_fetch_assoc($cliente);
                $_SESSION['login'] = 1;
                $_SESSION['idCliente'] = $row['idCliente'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['apellidos'] = $row['apellidos'];
                $_SESSION['img'] = $row['img'];
                $_SESSION['idTUsuario'] = $row['idTUsuario'];
                $_SESSION['idEscuela'] = $row['idEscuela'];
                $_SESSION['status'] = $row['Status'];
                $_SESSION['sexo'] = $row['Sexo'];
                $_SESSION['dateCreacion'] = $row['dateCreacion'];
            } else {
                echo json_encode('error');
            }
        } else {
            $query0 = "SELECT * FROM escuelas WHERE email = '$email'";
            $result0 = mysqli_query($conexion, $query0);
            $conteo0 = $result0->num_rows;
            if ($conteo0) {
                $querycliente = "SELECT * FROM escuelas WHERE email= '$email'";
                $cliente = mysqli_query($conexion, $querycliente);
                $row = mysqli_fetch_assoc($cliente);
                if (password_verify($pass, $row['password'])) {
                    echo json_encode('success');
                    $querycliente = "SELECT * FROM escuelas WHERE email='$email'";
                    $cliente = mysqli_query($conexion, $querycliente);
                    $row = mysqli_fetch_assoc($cliente);
                    $_SESSION['login'] = 1;
                    $_SESSION['idCliente'] = $row['idCliente'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['apellidos'] = $row['apellidos'];
                    $_SESSION['img'] = $row['img'];
                    $_SESSION['idTUsuario'] = $row['idTUsuario'];
                    $_SESSION['idEscuela'] = $row['idEscuela'];
                    $_SESSION['status'] = $row['Status'];
                    $_SESSION['sexo'] = $row['Sexo'];
                    $_SESSION['dateCreacion'] = $row['dateCreacion'];
                }else if($pass == $row['password']){
                    echo json_encode('success');
                    $querycliente = "SELECT * FROM cliente WHERE email='$email'";
                    $cliente = mysqli_query($conexion, $querycliente);
                    $row = mysqli_fetch_assoc($cliente);
                    $_SESSION['login'] = 1;
                    $_SESSION['idCliente'] = $row['idCliente'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['apellidos'] = $row['apellidos'];
                    $_SESSION['img'] = $row['img'];
                    $_SESSION['idTUsuario'] = $row['idTUsuario'];
                    $_SESSION['idEscuela'] = $row['idEscuela'];
                    $_SESSION['status'] = $row['Status'];
                    $_SESSION['sexo'] = $row['Sexo'];
                    $_SESSION['dateCreacion'] = $row['dateCreacion'];
                } else {
                    echo json_encode('error');
                }
            }
        }
    }
}
