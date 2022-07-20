<?php
if (session_start()) {
} else {
    session_start();
}
include_once '../../config/ConexionDB.php';

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (is_array($datos)) {
    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fechaCreate = $datos['detalles']['update_time'];
    $fecha_nueva = date("Y-m-d H:i:s", strtotime($fechaCreate));
    $email = $datos['detalles']['payer']['email_address'];
    $description = $datos['detalles']['purchase_units'][0]['description'];
    $idTicket = $datos['detalles']['purchase_units'][0]['reference_id'];
    $id_cliente = $_SESSION['idCliente'];

    /**Codigo para generar codigo QR */

    require_once '../../Libraries/phpqrcode/qrlib.php';

    $queryPagoBoleto = "SELECT * FROM tickets WHERE idTicket =" . $idTicket;
    $Pago = mysqli_query($conexion, $queryPagoBoleto);
    $row_Pago = mysqli_fetch_assoc($Pago);


    $dir = '../../temp/';

    if (!file_exists($dir))
        mkdir($dir);

    $filename = $dir . 'QR_' . $row_Pago['N_Operacion'] . '.png';
    $archivo = 'QR_' . $row_Pago['N_Operacion'] . '.png';

    $tamanio = 10;
    $level = 'M';
    $frame = 3;
    $contenido = $row_Pago['N_Operacion'];

    QRcode::png($contenido, $filename, $level, $tamanio, $frame);
    // header('location http://localhost/EQ2-DSM32-INTEGRADORA1/user/procesos/pagar_boleto.php?operacion=' . $_GET['operacion']);
    // echo '<img src"'. $filename .'"/>';

    /**Fin de Creacion del codigo QR */

    $queryPago = "INSERT INTO `pago`(`id_pago`, `id_transaccion`, `fecha`, `status`, `email`, `id_cliente`, `total`, `idTicket`, `description`, `codigo_qr`) VALUES 
    (NULL,'$id_transaccion','$fecha_nueva','$status','$email','$id_cliente','$monto','$idTicket','$description','$archivo')";
    $pago = mysqli_query($conexion, $queryPago);
}
