<?php
if (session_start()) {
} else {
    session_start();
}
if (isset($_SESSION['login']) == 1) {
    // echo $_SESSION['login'];
} else {
    header('Location: http://localhost/EQ2-DSM32-INTEGRADORA1/user/login.php');
}
$pagina = 0;
$pagina_admin = 0;
$pagina_modificacion = 1;
$video = 0;
$nombre_pagina = "Facturacion";
require_once './../../includes/header.php';
require '../../config/ConexionDB.php';






/**Consulta a la tabla de rutas */


if ($_REQUEST['operacion']) {
    $querytickets = 'SELECT * FROM tickets WHERE N_Operacion =' . $_REQUEST['operacion'];
    $tickets = mysqli_query($conexion, $querytickets);
    $row_tickets = mysqli_fetch_assoc($tickets);

    $querycliente = 'SELECT * FROM cliente WHERE idCliente = ' . $row_tickets['idCliente'];
    $cliente = mysqli_query($conexion, $querycliente);
    $row_cliente = mysqli_fetch_assoc($cliente);

    $queryrutas = 'SELECT * FROM rutas WHERE idRuta =' . $row_tickets['idRuta'];
    $rutas = mysqli_query($conexion, $queryrutas);

    /**Consulto ambas tablas para obtener todos los datos y validar que solo sea de un solo cliente la factura */
    $facturacion = 'SELECT * FROM facturas INNER JOIN tickets ON N_Operacion = ' . $_REQUEST['operacion'];
    $facturas = mysqli_query($conexion, $facturacion);
    $row_facturas = mysqli_fetch_assoc($facturas);

    // echo $row_facturas['idTicket'];
    // echo $row_facturas['idCliente'];

    $facturacion_validacion = 'SELECT * FROM facturas WHERE idTicket = ' . $row_facturas['idTicket'];
    $facturacion_validacion = mysqli_query($conexion, $facturacion_validacion);
    $row_facturas_validacion = mysqli_fetch_assoc($facturacion_validacion);

    // echo $row_facturas_validacion['status'];


    $TUsuario = "SELECT * FROM tipousuario WHERE idTUsuario =" . $row_cliente['idTUsuario'];
    $Usuario = mysqli_query($conexion, $TUsuario);
    $row_usuario = mysqli_fetch_assoc($Usuario);
}

?>



<div class="container">
    <div class="row">
        <section class="consulta-factura">
            <div class="contenido-ticket shadow-lg p-3 mb-5 bg-body rounded">
                <h1>Informacion del Ticket</h1>
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
                            <p><?php echo $row_cliente['nombre'] ?> <?php echo $row_cliente['apellidos'] ?></p>
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
                            <?php if ($row_tickets['dateModificacion'] == '') { ?>
                                <p>No se a Modificado</p>
                            <?php } else { ?>
                                <p><?php echo $row_tickets['dateModificacion'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Eliminacion</p>
                            <?php if ($row_tickets['dateEliminacion'] == '') { ?>
                                <p>No se a eliminado o deshabilitado</p>
                            <?php } else { ?>
                                <p><?php echo $row_tickets['dateEliminacion'] ?></p>
                            <?php } ?>
                        </div>
                        <div class="col order-first">
                            <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Creacion</p>
                            <?php if ($row_tickets['dateCreacion'] == '') { ?>
                                <p>No hay registro de creacion</p>
                            <?php } else { ?>
                                <p><?php echo $row_tickets['dateCreacion'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col order-last">
                            <p style="font-weight: bold;">Status de Facturacion</p>
                            <?php if ($row_facturas_validacion['status'] == 1) { ?>
                                <p class="text-primary" style="font-weight: 700;"><i class="bi bi-file-earmark-check-fill"></i> Solicitada</p>
                            <?php } elseif ($row_facturas_validacion['status'] == 2) { ?>
                                <p class="text-info" style="font-weight: 700;"><i class="bi bi-exclamation-circle-fill"></i> En proceso...</p>
                            <?php } elseif ($row_facturas_validacion['status'] == 3) { ?>
                                <p class="text-success" style="font-weight: 700;"><i class="bi bi-check2"></i> Aprobada </p>
                            <?php } elseif ($row_facturas_validacion['status'] == 4) { ?>
                                <p class="text-danger" style="font-weight: 700;"><i class="bi bi-x-lg"></i> Rechazada </p>
                            <?php } else { ?>
                                <p class="text-danger" style="font-weight: 700;"><i class="bi bi-x-lg"></i> No sea solicitado facturacion </p>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <p style="font-weight: bold;"><i class="bi bi-calendar-date-fill"></i> Fecha de Creacion de la Factura</p>
                            <?php if ($row_facturas_validacion['fechaC'] == '') { ?>
                                <p>No sea solicitado facturacion</p>
                            <?php } else { ?>
                                <p><?php echo $row_facturas_validacion['fechaC'] ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="datos-cliente shadow-lg p-3 mb-5 bg-body rounded">
                <h1>Datos del Cliente</h1>
                <p>
                    Nombre del Cliente: <?php echo $row_cliente['nombre'] ?> <?php echo $row_cliente['apellidos'] ?><br>
                    Correo Electronico: <?php echo $row_cliente['email'] ?><br>
                    Telefono: <?php echo $row_cliente['telefono'] ?> <br>
                    Tipo de Usuario: <?php echo $row_usuario['nombreUsuario'] ?><br>
                    Municipio: <?php echo $row_cliente['municipio'] ?> <br>
                    Codigo Postal: <?php echo $row_cliente['codigoPostal'] ?> <br>
                </p>
                <form class="row g-3 needs-validation" id="facturacion" novalidate>
                <div class="col-md-12">
                <label for="exampleInputPassword1" class="form-label">No. Operacion</label>
                    <input name="operacion" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_tickets['N_Operacion'] ?>" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom04" class="form-label">Status</label>
                        <select name="status" class="form-select" id="validationCustom04" required>
                            <option value="" selected>Choose...</option>
                            <option value="1">Solicitud</option>
                            <option value="2">En porceso</option>
                            <option value="3">Aprobada</option>
                            <option value="4">Rechazada</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid state.
                        </div>
                    </div>
                    <div class="col-12">
                        <center> <button class="btn btn-success" type="submit">Guardar Status</button></center>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>



<?php include_once './../../includes/footer.php';
