<?php

$pagina_modificacion = 0;
$pagina_admin = 0;
$video = 0;
$pagina = 0;
$nombre_pagina = "Settings";
require_once '../includes/header.php';
if (isset($_SESSION['login']) != 1) {
    //echo $_SESSION['login'];
    header('Location: login.php');
}

if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {
    if ($_SESSION['status'] == 0) {
        $activo = 'Activo';
    } else {
        $activo = 'Inactivo';
    }
}


    $queryescuelas = 'SELECT * FROM escuelas WHERE idEscuela = ' . $_SESSION['idEscuela'];
    $escuelas = mysqli_query($conexion, $queryescuelas);
    $row_escuelas = mysqli_fetch_assoc($escuelas);


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
            " enctype="multipart/form-data" id="formulario-settings">
                <input type="file" name="imagen" class="form-control" id="exampleInputPassword1">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Instituo</label>
                    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row_escuelas['Nombre']; ?>" name="nombre">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row_escuelas['email']; ?>" name="email">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="inputCity" value="<?php echo $row_escuelas['Direccion']; ?>" name="calle">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputCity" value="" name="password">
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Llenar el campo de password si es que desea cambiar la contraseña, de lo contrario no lo llene
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>