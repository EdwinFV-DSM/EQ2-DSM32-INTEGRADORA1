<?php
if (session_start()) {
} else {
    session_start();
}
$pagina = 0;
$pagina_admin = 1;
$pagina_modificacion = 1;
$video = 0;
require_once './../../includes/header.php';
require '../../config/ConexionDB.php';





/**Consulta a la tabla de rutas */


if ($_REQUEST['operacion']) {
    $querytickets = 'SELECT * FROM tickets WHERE N_Operacion =' . $_REQUEST['operacion'];
    $tickets = mysqli_query($conexion, $querytickets);
    $row_tickets = mysqli_fetch_assoc($tickets);

    $querycliente = 'SELECT * FROM cliente WHERE idCliente = ' . $row_tickets['idCliente'];
    $cliente = mysqli_query($conexion, $querycliente);

    $queryrutas = 'SELECT * FROM rutas WHERE idRuta =' . $row_tickets['idRuta'];
    $rutas = mysqli_query($conexion, $queryrutas);

    /**Consulto ambas tablas para obtener todos los datos y validar que solo sea de un solo cliente la factura */
    $facturacion = 'SELECT * FROM facturas INNER JOIN tickets ON N_Operacion = '. $_REQUEST['operacion'];
    $facturas = mysqli_query($conexion, $facturacion);
    $row_facturas = mysqli_fetch_assoc($facturas);

    // echo $row_facturas['idTicket'];
    // echo $row_facturas['idCliente'];

    $facturacion_validacion = 'SELECT * FROM facturas WHERE idTicket = '. $row_facturas['idTicket'];
    $facturacion_validacion = mysqli_query($conexion, $facturacion_validacion);
    $row_facturas_validacion = mysqli_fetch_assoc($facturacion_validacion);

    // echo $row_facturas_validacion['status'];

    
}

?>


<section class="modificar-boleto">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1>Consulta del boleto <?php echo $row_tickets['N_Operacion'] ?></h1>
            <div class="row" style="padding-block-start: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col order-last">
                        <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Vencimiento</p>
                            <p><?php echo $row_tickets['fechaV'] ?></p>
                        </div>
                        <div class="col">
                        <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Creacion</p>
                            <p><?php echo $row_tickets['fechaC'] ?></p>
                        </div>
                        <div class="col order-first">
                        <p style="font-weight: bold;"><i class="bi bi-person-circle"></i> Cliente</p>
                            <?php while ($row_cliente = mysqli_fetch_assoc($cliente)) { ?>
                                <p><?php echo $row_cliente['nombre'] ?> <?php echo $row_cliente['apellidos'] ?></p>
                            <?php }
                            mysqli_free_result($cliente); ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col order-last">
                        <p style="font-weight: bold;"><i class="bi bi-currency-dollar"></i> Costo</p>
                            <p>$<?php echo $row_tickets['costo'] ?> MXN</p>
                        </div>
                        <div class="col">
                        <p style="font-weight: bold;">No. Operacion</p>
                            <p><?php echo $row_tickets['N_Operacion'] ?></p>
                        </div>
                        <div class="col order-first">
                        <p style="font-weight: bold;"><i class="fa fa-map-signs" aria-hidden="true"></i> Ruta</p>
                            <?php while ($row_rutas = mysqli_fetch_assoc($rutas)) { ?>
                                <p><?php echo $row_rutas['nombre'] ?></p>
                            <?php }
                            mysqli_free_result($rutas); ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col order-last">
                        <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Modificacion</p>
                            <?php if ($row_tickets['dateModificacion'] == '') {?>
                                <p>No se a Modificado</p>
                            <?php }else{ ?>
                            <p><?php echo $row_tickets['dateModificacion'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="col">
                        <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Eliminacion</p>
                            <?php if ($row_tickets['dateEliminacion'] == '') {?>
                                <p>No se a eliminado o deshabilitado</p>
                            <?php }else{ ?>
                                <p><?php echo $row_tickets['dateEliminacion'] ?></p>
                            <?php } ?>                            
                        </div>
                        <div class="col order-first">
                        <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Creacion</p>
                            <?php if ($row_tickets['dateCreacion'] == '') {?>
                                <p>No hay registro de creacion</p>
                            <?php }else{ ?>
                                <p><?php echo $row_tickets['dateCreacion'] ?></p>
                            <?php } ?>                                
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col order-last">
                            <p style="font-weight: bold;">Status de Facturacion</p>
                            <?php if ($row_facturas_validacion['status'] == 1) {?>
                                <p class="text-primary" style="font-weight: 700;"><i class="bi bi-file-earmark-check-fill"></i> Solicitada</p>
                            <?php }elseif($row_facturas_validacion['status'] == 2){ ?>
                            <p class="text-info" style="font-weight: 700;"><i class="bi bi-exclamation-circle-fill"></i> En proceso...</p>
                            <?php }elseif ($row_facturas_validacion['status'] == 3) {?>
                                <p class="text-success" style="font-weight: 700;"><i class="bi bi-check2"></i> Aprobada </p>
                           <?php }elseif($row_facturas_validacion['status'] == 4) {?>
                            <p class="text-danger" style="font-weight: 700;"><i class="bi bi-x-lg"></i> Rechazada </p>
                           <?php }else{?>
                            <p class="text-danger" style="font-weight: 700;"><i class="bi bi-x-lg"></i> No sea solicitado facturacion </p>
                           <?php } ?>
                        </div>
                        <div class="col">
                        <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Creacion de la Factura</p>
                            <?php if ($row_facturas_validacion['fechaC'] == '') {?>
                                <p>No sea solicitado facturacion</p>
                            <?php }else{ ?>
                                <p><?php echo $row_facturas_validacion['fechaC'] ?></p>
                            <?php } ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once './../../includes/footer.php';
