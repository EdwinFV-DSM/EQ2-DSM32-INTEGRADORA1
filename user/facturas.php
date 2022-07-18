<?php
if (session_start()) {
} else {
    session_start();
}
if (isset($_SESSION['login']) != 1) {
    //echo $_SESSION['login'];
    header('Location: login.php');
}
if ($_SESSION['status'] == 0) {
    $activo = 'Activo';
} else {
    $activo = 'Inactivo';
}
$pagina_modificacion = 0;
$pagina_admin = 0;
$video = 0;
$pagina = 0;
require_once '../includes/header.php';

if ($_SESSION['idTUsuario'] == 2) {
    $queryTUsuairo = 'SELECT * FROM tipousuario WHERE idTUsuario =' . $_SESSION['idTUsuario'];
    $TUsuario = mysqli_query($conexion, $queryTUsuairo);
    $row_TUsuario = mysqli_fetch_assoc($TUsuario);
}

$queryCliente = 'SELECT * FROM cliente WHERE idCliente =' . $_SESSION['idCliente'];
$Cliente = mysqli_query($conexion, $queryCliente);
$row_Cliente = mysqli_fetch_assoc($Cliente);




?>

<section class="settings">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1 style="text-align: center;">Facturacion</h1>
            <div class="cabecera-factura" style=" display: flex; align-items: center; justify-content: space-between; align-content: center; flex-wrap: nowrap; flex-direction: row;">
                <div class="parte-izquierda" style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: flex-start; align-items: flex-start; align-content: space-around;">
                    <img src="<?= base_url ?>/assets/img/Innovative Transport S.A de C.V (1).png" alt="" style="width: 68px">
                    <p style="margin: 0; padding-left: 12px;"> Innovative Transport S.A de C.V<br>
                        Metepec, Estado de México, 52156</p>
                </div>
                <div class="parte-derecha">
                    <p>Web: InnovativeTransport.mx</p>
                    <p>Email: InnovativeTransport@gmail.com</p>
                    <p>Tel: +52 722-109-0131</p>
                </div>
            </div>
            <div class="linea"></div>
            <div class="contenido-factura">
                <div class="cabecera-contenido">
                    <h1>Factura</h1>
                    <p>Fecha: <?php echo date("Y-m-d"); ?><br>
                        Factura: #
                        <?php $suma = 0;
                        for ($i = 0; $i < 55; $i++) {
                            $aleatorio = rand(1, 10000);
                            // echo $aleatorio;
                            $suma = $aleatorio + $suma;
                        }
                        ?><?php echo $suma ?>
                    </P>
                </div>
                <div class="contenido-principal">
                    <div class="container">
                        <div class="row">
                            <div class="col order-last">

                            </div>
                            <div class="col">
                                <p>
                                    Enviar a: <?php echo $_SESSION['nombre']; ?> <?php echo $_SESSION['apellidos']; ?>.<br>
                                    Tipo: <?php echo $row_TUsuario['nombreUsuario'] ?>.<br>
                                    Lugar de envio: <?php echo $row_Cliente['email'] ?>.<br>
                                    Telefono: <?php echo $row_Cliente['telefono'] ?>.
                                </p>
                            </div>
                            <div class="col order-first">
                                <p>
                                    Facturar a: <?php echo $_SESSION['nombre']; ?> <?php echo $_SESSION['apellidos']; ?>.<br>
                                    Tipo: <?php echo $row_TUsuario['nombreUsuario'] ?>.<br>
                                    Lugar: Estado de México.<br>
                                    Telefono: <?php echo $row_Cliente['telefono'] ?>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabla-facturacion">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No. Operacion</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">IVA</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once '../includes/footer.php'; ?>