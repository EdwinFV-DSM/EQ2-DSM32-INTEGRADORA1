<?php
$pagina_modificacion = 0;
$pagina_admin = 0;
$video = 0;
$pagina = 0;
$nombre_pagina = "Settings";
require_once '../includes/header.php';
if (isset($_SESSION['login']) != 1) {
    //echo $_SESSION['login'];
    header('Location: ../login.php');
}
if ($_SESSION['idTUsuario'] == 1 || $_SESSION['idTUsuario'] == 2 || $_SESSION['idTUsuario'] == 3 || $_SESSION['idTUsuario'] == 4) {
    if ($_SESSION['status'] == 0) {
        $activo = 'Activo';
    } else {
        $activo = 'Inactivo';
    }
}
?>

<section class="settings">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
           
                <img src="<?= base_url ?>/uploads/<?php echo $_SESSION ['img'] ?> " style="width: 152px; padding: 4px; position: absolute;" alt="">
        

            <h1 style="text-align: center;">Settings</h1>
            <form class="row g-3" style="
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
            " enctype="multipart/form-data" id="formulario-settings" >
                <input type="file" name="imagen">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Nombre</label>
                    <input value="<?php echo $_SESSION ['nombre']?> "type="text" class="form-control" id="inputEmail4" value="<?php echo $row_cliente['nombre']; ?>" name="nombre">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Direccion</label>
                    <input <?php echo $_SESSION ['Direccion']?> type="text" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['apellidos']; ?>" name="apellidos">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input <?php echo $_SESSION ['Email']?> type="text" class="form-control" id="inputEmail4" value="<?php echo $row_cliente['email']; ?>" name="email">
                </div>
                <div class="col-md-3">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input <?php echo $_SESSION ['Password']?>  type="password" class="form-control" id="inputPassword4" value="<?php echo $row_cliente['telefono']; ?>" name="telefono">
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