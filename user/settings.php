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
$nombre_pagina = "Settings";
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
            " enctype="multipart/form-data" action="settings.php" method="POST">
                <input type="file" name="imagen">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row_cliente['nombre']; ?>" name="nombre">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['apellidos']; ?>" name="apellidos">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row_cliente['email']; ?>" name="email">
                </div>
                <div class="col-md-3">
                    <label for="inputPassword4" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['telefono']; ?>" name="telefono">
                </div>
                <div class="col-md-3">
                    <label for="inputPassword4" class="form-label">Codigo Postal</label>
                    <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['codigoPostal']; ?>" name="cp">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="inputCity" value="<?php echo $row_cliente['calle']; ?>" name="calle">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Num. Interior</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $row_cliente['numInt']; ?>" name="numInt">
                </div>
                <div class="col-md-2">
                    <label for="inputZip" class="form-label">Num. Exterior</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $row_cliente['numExt']; ?>" name="numExt">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Municipio</label>
                    <input type="text" class="form-control" id="inputCity" value="<?php echo $row_cliente['municipio']; ?>" name="municipio">
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
                    <input type="date" class="form-control" id="inputCity" value="<?php echo $row_cliente['fechaNac']; ?>" name="fechaNac">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputCity" value="<?php echo $row_cliente['password']; ?>" name="password">
                </div>
                <div class="col-2">
                    <label for="inputZip" class="form-label">Descuento</label>
                    <input type="text" class="form-control" id="inputZip" value="<?php echo $activo ?>" disabled>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="Guardar"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php 

if(isset($_POST['Guardar'])){
    $imagen = $_FILES['imagen']['name'];
    $idCliente = $_SESSION['idCliente'];

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $calle = $_POST['calle'];
    $numInt = $_POST['numInt'];
    $numExt = $_POST['numExt'];
    $municipio = $_POST['municipio'];
    $fechaNac = $_POST['fechaNac'];
    $password = $_POST['password'];
    $codigoPostal = $_POST['cp'];


    $idEscuela = $_SESSION['idEscuela'];
    $idTUsuario = $_SESSION['idTUsuario'];
    $status = $_SESSION['status'];
    $sexo = $_SESSION['sexo'];
    $dateCreacion = $_SESSION['dateCreacion'];

    $dateModificacion = date('Y-m-d H:i:s');

    $alert;
    if(isset($imagen) && $imagen != ""){
        $tipo = $_FILES['imagen']['type'];
        $temp  = $_FILES['imagen']['tmp_name'];

       if( !((strpos($tipo,'gif') || strpos($tipo,'jpeg') || strpos($tipo,'webp') || strpos($tipo,'jpg')))){
        $alert = "'<script>Swal.fire(
            'Error',
            'Solo se permite archivos jpeg, gif, webp',
            'error'
          )</script>'";
          header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/user/settings.php');
       }else{
         $query = "UPDATE `cliente` SET `nombre`='$nombre',`apellidos`='$apellidos',`fechaNac`='$fechaNac',`idTUsuario`='$idTUsuario',`email`='$email',`telefono`='$telefono',`calle`='$calle',
         `numExt`='$numExt',`numInt`='$numInt',`municipio`='$municipio',`codigoPostal`='$codigoPostal',`idServicio`=1,`idEscuela`='$idEscuela',`Status`='$status',`Sexo`='$sexo',
         `password`='$password',`dateCreacion`='$dateCreacion',`dateModificacion`='$dateModificacion',`dateEliminacion`=NULL,`img`='$imagen' WHERE idCliente =".$idCliente;
         $resultado_update_cliente = mysqli_query($conexion,$query);
         if($resultado_update_cliente){
              move_uploaded_file($temp,'../uploads/'.$imagen);
              $alert = "'<script>
              Swal.fire({
                icon: 'success',
                title: 'Se ha modificado correctamente',
                text: 'Los cambios se mostraran en el proximo inicio de sesion'
                
              })</script>'";
             header('location: http://localhost/EQ2-DSM32-INTEGRADORA1/user/settings.php');
         }else{
            $alert = "'<script>Swal.fire(
                'Error',
                'ocurrio un error en el servidor',
                'error'
              )</script>'";
         }
       }
    }else{
        $imagen = $row_cliente['img'];
        $query = "UPDATE `cliente` SET `nombre`='$nombre',`apellidos`='$apellidos',`fechaNac`='$fechaNac',`idTUsuario`='$idTUsuario',`email`='$email',`telefono`='$telefono',`calle`='$calle',
        `numExt`='$numExt',`numInt`='$numInt',`municipio`='$municipio',`codigoPostal`='$codigoPostal',`idServicio`=1,`idEscuela`='$idEscuela',`Status`='$status',`Sexo`='$sexo',
        `password`='$password',`dateCreacion`='$dateCreacion',`dateModificacion`='$dateModificacion',`dateEliminacion`=NULL,`img`='$imagen' WHERE idCliente =".$idCliente;
        $resultado_update_cliente = mysqli_query($conexion,$query);
        if($resultado_update_cliente){
             $alert = "'<script>
             Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Se ha modificado correctamente'
               
             })</script>'";
            }
    }
    echo $alert;
}

?>

<?php require_once '../includes/footer.php'; ?>