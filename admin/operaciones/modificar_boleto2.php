<?php 

require '../../config/ConexionDB.php';

/**Consulta para poder traer la fecha de creacion */

$query_date = "SELECT * FROM tickets";
$date = mysqli_query($conexion,$query_date);
$resultado_date = mysqli_fetch_assoc($date);


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
    }elseif ($_POST['operacion'] =='' || $_POST['operacion'] ==' ') {
        echo json_encode('error');
    }else{
        $cliente = $_POST['cliente'];
        $fechaC = $_POST['fechaC'];
        $fechaV = $_POST['fechaV'];
        $costo = $_POST['costo'];
        $ruta = $_POST['ruta'];
        $operacion = $_POST['operacion'];
        $creacion_ticket = $resultado_date['dateCreacion'];
        $fecha_hora = date('Y-m-d H:i:s');
        $insertTicket = "UPDATE `tickets` SET `idCliente`='$cliente',`matricula`= NULL,`fechaC`='$fechaC',`fechaV`='$fechaV',`costo`='$costo',`N_Operacion`='$operacion',`idRuta`='$ruta',`dateModificacion`='$fecha_hora',`dateEliminacion`=NULL WHERE N_Operacion = ".$operacion;
        $ticket = mysqli_query($conexion, $insertTicket);
        if ($ticket) {
            echo json_encode('success');
        }else{
            echo json_encode('error-insertar');
        }
    }
}