<?php

/**
 * 
 * 
 * Validacion de si existe la sesion en la carpeta temp,
 * si no hay una sesion creada la crea, lo cual esta validacion se 
 * ejecuta desde antes para dar acceso al panel.
 * 
 * 
 */
if (session_start()) {
} else {
    session_start();
}
$pagina = 0;
$pagina_admin = 1;
$pagina_modificacion = 1;
$video = 0;

/**
 * 
 * Se manda a llamar la conexion y la cabecera aunque ya la conexion la traemos desde la cabecera
 * pero la incluimos para no tener ningun error.
 * 
 */
require_once './../../includes/header.php';
require '../../config/ConexionDB.php';

/**
 * 
 * En esta parte se realiza una consulta a la tabla de cliente donde validamos que la idCliente
 * sea igual al numero que recibimos por metodo post para poder traer todos los datos de este cliente
 * para poder modificar sus datos.
 * 
 */

$querycliente = 'SELECT * FROM cliente WHERE idCliente =' . $_REQUEST['operacion'];
$cliente = mysqli_query($conexion, $querycliente);
$row_cliente = mysqli_fetch_assoc($cliente);


/**
 * 
 * En esta parte se hace una segunda consulta pero ahora a la tabla de tipousuario 
 * para poder extraer el nombre al igual que su id para poder modificar su rol 
 * dentro del sistema.
 * 
 */

$queryTUsuario = "SELECT * FROM tipousuario ";
$TUsuario = mysqli_query($conexion, $queryTUsuario);


/**
 * 
 * Esta es la tercera consulta donde consultamos la tabla de escuelas donde traemos 
 * todas las escuelas que existen actualmente en la base de datos,despues en el select se hace
 * un ciclo while para poder sacar todas las escuelas y mostrarlas por pantalla.
 * 
 */

$queryEscuela = "SELECT * FROM escuelas";
$Escuelas = mysqli_query($conexion, $queryEscuela);

?>
<section class="modificar-boleto">
    <div class="container">
        <div class="row shadow-lg p-3 mb-5 bg-body rounded">
            <h1>Modificacion de Cliente</h1>
            <form class="row g-3 needs-validation" id="modificar-cliente" novalidate>
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['nombre']; ?>" name="nombre">
                </div>
                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['apellidos']; ?>" name="apellidos">
                </div>
                <div class="col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="exampleInputPassword1" name="fechaNac" value="<?php echo $row_cliente['fechaNac'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Tipo de Usuario</label>
                    <select name="TUsuario"  class="form-select" aria-label="Default select example">
                        <?php while ($row_TUsuario = mysqli_fetch_assoc($TUsuario)) { ?>
                            <option value="<?php echo $row_TUsuario['idTUsuario'] ?>"><?php echo $row_TUsuario['nombreUsuario'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="email" value="<?php echo $row_cliente['email'] ?>">
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label">Telefono</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="phone" value="<?php echo $row_cliente['telefono'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Direccion</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" name="direccion" value="<?php echo $row_cliente['calle'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">Codigo Postal</label>
                    <input name="cp" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['codigoPostal'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">Numero Exterior</label>
                    <input name="numExt" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['numExt'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">Numero Interior</label>
                    <input name="numInt" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['numInt'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">Municipio</label>
                    <input name="municipio" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['municipio'] ?>">
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">Unidad Academica</label>
                    <?php
                    if ($row_cliente['idEscuela'] == '' || $row_cliente['idEscuela'] == 0) { ?>
                        <input name="escuela" type="text" class="form-control" id="exampleInputPassword1" value="No perteneces a una escuela">
                    <?php } else {
                    ?>
                        <select name="escuela"  class="form-select" aria-label="Default select example">
                            <?php while ($row_Escuelas = mysqli_fetch_assoc($Escuelas)) { ?>
                                <option value="<?php echo $row_Escuelas['idEscuela'] ?>"><?php echo $row_Escuelas['Nombre'] ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                </div>
                <div class="col-md-3">
                    <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $row_cliente['password'] ?>">
                </div>

                <div class="col-md-3" style="display: flex; flex-wrap: wrap; flex-direction: column; align-items: stretch; justify-content: center; align-content: center;">
                    <label for="exampleInputPassword1" class="form-label">Sexo</label>
                    <div class="checkbox">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="sexo" value="M">
                            <label class="form-check-label" for="inlineCheckbox1">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="sexo" value="F">
                            <label class="form-check-label" for="inlineCheckbox2">Femenino</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</section>


<?php include_once './../../includes/footer.php';
