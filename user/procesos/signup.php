<?php 
include_once '../../config/ConexionDB.php';

if (isset($_REQUEST['email'])) {
    if (isset($_REQUEST['password'])) {
        $email = $_REQUEST['email'];
        $pass = $_REQUEST['password'];
        $query0 = 'SELECT * FROM cliente WHERE email="' . $email . '" AND password="' . $pass . '"';
        $result0 = mysqli_query($conexion, $query0);
        $conteo0 = $result0->num_rows;

        if($conteo0){
            echo json_encode('success');
            $querycliente = 'SELECT * FROM cliente WHERE email="' . $email . '"';
            $cliente = mysqli_query($conexion, $querycliente);
            $row = mysqli_fetch_assoc($cliente);
            session_start();
            $_SESSION['login'] = 1;
            $_SESSION['idCliente'] = $row['idCliente'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellidos'] = $row['apellidos'];
            $_SESSION['img'] = $row['img'];
            $_SESSION['idTUsuario'] = $row['idTUsuario'];
            $_SESSION['idEscuela'] = $row['idEscuela'];
            $_SESSION['status'] = $row['Status'];
            $_SESSION['sexo'] = $row['Sexo'];
         }else{
            echo json_encode('error');
        }
    }
}
