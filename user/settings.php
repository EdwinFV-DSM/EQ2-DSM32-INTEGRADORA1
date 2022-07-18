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
if ($_SESSION['idEscuela']) {
    $queryescuelas = 'SELECT nombre,img FROM escuelas WHERE idEscuela = ' . $_SESSION['idEscuela'];
    $escuelas = mysqli_query($conexion, $queryescuelas);
    $row_escuelas = mysqli_fetch_assoc($escuelas);

    $querycliente = 'SELECT * FROM cliente WHERE idEscuela = ' . $_SESSION['idEscuela'];
    $cliente = mysqli_query($conexion, $querycliente);
    $row_cliente = mysqli_fetch_assoc($cliente);
} else {
    $querycliente = 'SELECT * FROM cliente WHERE idCliente = ' . $_SESSION['idCliente'];
    $cliente = mysqli_query($conexion, $querycliente);
    $row_cliente = mysqli_fetch_assoc($cliente);
}




$queryTusuario = 'SELECT * FROM tipousuario WHERE idTUsuario = ' . $_SESSION['idTUsuario'];
$TUsuario = mysqli_query($conexion, $queryTusuario);
$row_TUsuario = mysqli_fetch_assoc($TUsuario);
?>

<section class="settings">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <?php if ($_SESSION['idEscuela']) { ?>
                <img src="<?php echo $row_escuelas['img'] ?> " style="width: 152px; padding: 4px; position: absolute;" alt="">
            <?php } ?>

            <h1 style="text-align: center;">Settings</h1>
            <form class="row g-3" style="
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
            ">
                <style>
                    .archivo {
                        width: 80px;
                        height: 80px;
                        overflow: hidden;
                    }

                    #file {
                        background-image: url("<?php echo $_SESSION['img']; ?>");
                        background-position-x: 50%;
                        background-position-y: 4px;
                        height: 144px;
                        background-size: 97px 87px;
                        padding-left: 33%;
                        display: flex;
                        background-repeat: no-repeat;
                        align-items: flex-start;
                        align-content: flex-end;
                        flex-wrap: nowrap;
                        flex-direction: row;
                        justify-content: center;
                        border-radius: 122px;
                    }

                    #file {
                        background-image: url(https://tinyurl.com/23gwpgek);
                        background-position-x: 50%;
                        background-position-y: 4px;
                        height: 144px;
                        background-size: 97px 87px;
                        padding-left: 33%;
                        display: flex;
                        background-repeat: no-repeat;
                        align-items: flex-start;
                        align-content: flex-end;
                        flex-wrap: nowrap;
                        flex-direction: row;
                        justify-content: center;
                        border-radius: 122px;
                    }

                    button,
                    input,
                    optgroup,
                    select,
                    textarea {
                        margin: 0;
                        font-family: inherit;
                        font-size: inherit;
                        line-height: inherit;
                        padding-block-start: 94px;
                    }
                </style>
                <input type="file" name="imagen" id="file">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row_cliente['nombre']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['apellidos']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row_cliente['email']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['telefono']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="inputCity" value="<?php echo $row_cliente['calle']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Num. Interior</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $row_cliente['numInt']; ?>">
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Num. Exterior</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $row_cliente['numExt']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Municipio</label>
                    <input type="text" class="form-control" id="inputCity" value="<?php echo $row_cliente['municipio']; ?>">
                </div>
                <div class="col-md-4">
                    <?php if ($_SESSION['idEscuela'] == '') { ?>
                        <label for="inputState" class="form-label">Instituto</label>
                        <input type="text" class="form-control" id="inputCity" value="No pertences a una institucion" disabled>
                    <?php } else { ?>
                        <label for="inputState" class="form-label">Instituto</label>
                        <input type="text" class="form-control" id="inputCity" value="<?php echo $row_escuelas['nombre'] ?>" title="<?php echo $row_escuelas['nombre'] ?>" disabled>
                    <?php } ?>
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $row_TUsuario['nombreUsuario'] ?>" disabled>
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="inputCity" value="<?php echo $row_cliente['fechaNac']; ?>">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputCity" value="<?php echo $row_cliente['password']; ?>">
                </div>
                <div class="col-2">
                    <label for="inputZip" class="form-label">Descuento</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $activo ?>" disabled>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</section>


<?php require_once '../includes/footer.php'; ?>