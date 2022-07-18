<?php
if (session_start()) {
} else {
    session_start();
}

if ($_SESSION['idTUsuario'] != 1) {
} else {
    header('Location: ../user/panel.php');
}
$pagina = 0;
$pagina_admin = 1;
$pagina_modificacion = 0;
$video = 0;
require_once '../../includes/header.php';

$ticket = "SELECT * FROM tickets WHERE idTicket = " . $_GET['operacion'];
$tickets = mysqli_query($conexion, $ticket);
$row_ticket = mysqli_fetch_assoc($tickets);

$queryRuta = "SELECT * FROM rutas WHERE idRuta = " . $row_ticket['idRuta'];
$rutas = mysqli_query($conexion, $queryRuta);
$row_rutas = mysqli_fetch_assoc($rutas);

if ($row_ticket['idHorario'] == '') {
} else {
    $queryHorario = "SELECT * FROM horarios WHERE idHorario = " . $row_ticket['idHorario'];
    $Horarios = mysqli_query($conexion, $queryHorario);
    $row_Horarios = mysqli_fetch_assoc($Horarios);
}


$queryCliente = "SELECT * FROM cliente WHERE idCliente =" . $_SESSION['idCliente'];
$Cliente = mysqli_query($conexion, $queryCliente);
$row_Cliente = mysqli_fetch_assoc($Cliente);

$queryUsuario = "SELECT * FROM tipousuario WHERE idTUsuario =" . $row_Cliente['idTUsuario'];
$Usuario = mysqli_query($conexion, $queryUsuario);
$row_Usuario = mysqli_fetch_assoc($Usuario);


$total_sin_Descuento = $row_ticket['costo'];
$total_con_descuento;
$total_pagar;

if ($row_Usuario['idTUsuario'] == 2) {

    $total_con_descuento = ($total_sin_Descuento * 30) / 100;
    $total_con_descuento = number_format($total_con_descuento, 2);

    $alert_descuento = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>En Horabuena!</strong> Se te aplicara un descuento del 30% por ser estudiante.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
} else {
    $alert_descuento = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Lo Sentimos !</strong> No cuentas con descuento.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $total_con_descuento = '';
}


?>

<div class="pago-boleto">
    <div class="container">
        <div class="row">
            <div class="contenido-pago">
                <div class="ticket shadow-lg p-3 mb-5 bg-body rounded">
                    <h1 style="text-align: center;">Proceso de Pago</h1>
                    <div class="linea-pago"></div>
                    <div class="info-personal-cliente">
                        <p>
                            Cliente: <?php echo $_SESSION['nombre']; ?> <?php echo $_SESSION['apellidos']; ?> <br>
                            Usuario: <?php echo $row_Usuario['nombreUsuario']; ?><br>
                            No. Operacion: <?php echo $row_ticket['N_Operacion'] ?> <br>
                            Ruta: <?php echo $row_rutas['nombre'] ?> <br>

                            <?php
                            if ($row_ticket['idHorario'] == '') { ?>
                                Horario: No selecciono un horario<br>
                            <?php } else { ?>
                                Horario: <?php echo $row_Horarios['TiempoE'] ?><br>
                            <?php } ?>

                            Fecha de Creacion: <?php echo $row_ticket['fechaC'] ?><br>
                            Fecha de Vencimiento: <?php echo $row_ticket['fechaV'] ?><br>
                            Terminal de Inicio y Final: <?php echo $row_rutas['idTerminales'] ?><br>
                            Tipo de Servicio: Online<br>

                            <?php
                            if ($total_con_descuento == '') { ?>
                                Total a pagar sin descuento es: $<span><?php echo $total_sin_Descuento ?></span> MXN<br>
                            <?php } else { ?>
                                Total a pagar sin descuento es: $<span style="text-decoration:line-through;"><?php echo $total_sin_Descuento ?></span> MXN<br>
                                Total a pagar con descuento es: $<?php echo $total_con_descuento ?> MXN
                            <?php } ?>
                            <?php echo $alert_descuento ?>
                        </p>
                        <?php
                        if ($total_con_descuento == '') {
                            $total_pagar = $total_sin_Descuento; ?>
                            <h1> Total a Pagar: <span>$<?php echo $total_sin_Descuento ?> MXN</span></h1>
                        <?php } else {
                            $total_pagar = $total_con_descuento; ?>
                            <h1> Total a Pagar: <span>$<?php echo $total_con_descuento ?> MXN</span></h1>
                        <?php } ?>
                    </div>
                </div>
                <div class="botones-pago shadow-lg p-3 mb-5 bg-body rounded">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    paypal.Buttons({
        style: {
            label: 'pay',
            shape: 'pill',
            color: 'blue'
        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $total_pagar; ?>
                    }
                }]
            });
        },

        onApprove: function(data, actions){
            actions.order.capture().then(function (detalles){
                // console.log(detalles);
                Swal.fire(
                'Success',
                'Tu pago a sido realizado correctamente',
                'success'
            )
            });
        },

        onCancel: function(data) {
            Swal.fire(
                'Error',
                'No se pudo completar el pago',
                'error'
            )
        }
    }).render('#paypal-button-container');
</script>

<?php require_once '../../includes/footer.php' ?>