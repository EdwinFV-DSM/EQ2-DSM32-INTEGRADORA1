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

$querycliente = 'SELECT * FROM cliente';
$cliente = mysqli_query($conexion, $querycliente);



/**Consulta a la tabla de rutas */

$queryrutas = 'SELECT * FROM rutas';
$rutas = mysqli_query($conexion, $queryrutas);
if ($_REQUEST['operacion']) {
    $querytickets = 'SELECT * FROM tickets WHERE N_Operacion =' . $_REQUEST['operacion'];
    $tickets = mysqli_query($conexion, $querytickets);
    $row_tickets = mysqli_fetch_assoc($tickets);

    $querycliente = 'SELECT * FROM cliente WHERE idCliente = '.$row_tickets['idCliente'];
    $cliente = mysqli_query($conexion, $querycliente); 
    $row_cliente = mysqli_fetch_assoc($cliente);
}


?>


<section class="modificar-boleto">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1>Modificacion de boleto</h1>
            <form class="row g-3 needs-validation" id="modificar-boleto" novalidate>
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Cliente</label>
                    <select name="cliente" id="" class="form-select" aria-label="Default select example">
                        <option value="<?php echo $row_cliente['idCliente']?>" selected><?php echo $row_cliente['nombre']?> <?php echo $row_cliente['apellidos']?></option>
                        <?php while ($row_cliente = mysqli_fetch_assoc($cliente)) { ?>
                            <option value="<?php echo $row_cliente['idCliente'] ?>"><?php echo $row_cliente['nombre'] ?> <?php echo $row_cliente['apellidos'] ?></option>
                        <?php }
                        mysqli_free_result($cliente); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Fecha de Creacion</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" name="fechaC" value="<?php echo $row_tickets['fechaC'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" name="fechaV" value="<?php echo $row_tickets['fechaV'] ?>">
                </div>
                <div class="col-md-6">
                    <label for="exampleInputPassword1" class="form-label">Costo</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="costo" value="<?php echo $row_tickets['costo'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Ruta</label>
                    <select name="ruta" id="" class="form-select" aria-label="Default select example">
                        <option value="" selected>Ruta</option>
                        <?php while ($row_cliente = mysqli_fetch_assoc($rutas)) { ?>
                            <option value="<?php echo $row_cliente['idRuta'] ?>"><?php echo $row_cliente['nombre'] ?></option>
                        <?php }
                        mysqli_free_result($rutas); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">No. Operacion</label>
                    <input name="operacion" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_tickets['N_Operacion'] ?>" readonly>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</section>


<?php include_once './../../includes/footer.php';
