<?php 

require '../../config/ConexionDB.php';


if ($_POST) { 
    if ($_POST['cliente'] =='' || $_POST['cliente'] ==' ') {
        echo json_encode('error');
    }elseif($_POST['fechaC'] =='' || $_POST['fechaC'] ==' '){
        echo json_encode('error');
    }elseif ($_POST['fechaV'] =='' || $_POST['fechaV'] ==' ') {
        echo json_encode('error');
    }elseif ($_POST['costo'] =='' || $_POST['costo'] ==' ') {
        echo json_encode('error');
    }elseif ($_POST['ruta'] =='' || $_POST['ruta'] ==' ') {
        echo json_encode('error');
    }elseif ($_POST['horario'] =='' || $_POST['horario'] ==' ') {
        echo json_encode('error');
    }elseif ($_POST['operacion'] =='' || $_POST['operacion'] ==' ') {
        echo json_encode('error');
    }else{
        $cliente = $_POST['cliente'];
        $fechaC = $_POST['fechaC'];
        $fechaV = $_POST['fechaV'];
        $costo = $_POST['costo'];
        $ruta = $_POST['ruta'];
        $horario = $_POST['horario'];
        $operacion = $_POST['operacion'];
        $fecha_hora = date('Y-m-d H:i:s');
        $insertTicket = "INSERT INTO tickets VALUES (NULL,'$cliente', NULL,'$fechaC','$fechaV','$costo','$operacion','$ruta','$horario',NULL,NULL,'$fecha_hora');";
        $ticket = mysqli_query($conexion, $insertTicket);
        if ($ticket) {
            echo json_encode('success');
        }else{
            echo json_encode('error_insertar');
        }
    }
}